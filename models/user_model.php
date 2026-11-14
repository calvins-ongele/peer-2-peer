<?php
class User_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gameDetails($url = null) {
        if ($url) { 
            $game = $this->_get('games', 'game_url', [$url], 0)[1];
            if (empty($game)) return; 
            
            $sql = "SELECT players.*, choice_details, is_winning_choice, username
                        FROM players
                        LEFT JOIN users u ON u.id = player_user_id
                        LEFT JOIN choices c ON c.id = players.answer_chosen
                        WHERE players.game_id = ?
                    ";
            $players = $this->_query($sql, [ $game['id'] ])[1]??[];//$this->_get('players', 'game_id', [ $game['id'] ])[1];

            $me = $this->me();

            // is it my game
            if ($game['game_type'] === 'private') { //public should be open to anyone
                if ($game['created_by'] !== $me['id'] ) { //I dont own it
                    // check if I play at least
                    $iplay = array_filter($players, fn($r)=>($r['player_user_id']??'')===$me['id'] );
                    if (count($iplay) === 0) return; // I dont play nor was invited
                }
            }

            return [
                'game'=>$game,
                'players'=>$players,
                'choices'=>$this->_get('choices', 'game_id', [ $game['id'] ])[1]
            ];
        }
        return [];
    }

    public function allGames() {
        $count = "(select count(*) from players p2 where p2.game_id = g.id )"; 
        $sql = "SELECT g.*,pl.answer_chosen as answer_chosen, choice_details, $count as total_players, is_winner, player_accepted_invitation
                    FROM games g
                    LEFT JOIN players pl ON pl.game_id = g.id
                    LEFT JOIN choices c ON pl.answer_chosen = c.id
                    WHERE g.created_by = ?
                    OR EXISTS (
                        SELECT 1
                        FROM players p
                        WHERE p.game_id = g.id
                            AND p.player_user_id = ? AND p.player_accepted_invitation != 'rejected'
                    )
        ";
        $games = $this->_query("$sql {$this->pagination()}", [Session::get('userid'),Session::get('userid') ] )[1] ?? [];
        if (empty($games)) return; 

        return [
            'games'=>$games,
            'count'=>$this->_query("$sql ", [Session::get('userid'),Session::get('userid') ] )[0]
        ];
    }

    public function getTrnxHistory() {
        $cols = 'user_id';
        $values = [Session::get('userid')];
        if ( in_array( ($_GET['type']??''), ['cr', 'dr']) ) {
            $cols .= ', dr_cr';
            $values[$_GET['type']];
        }

        $history = $this->_get('transaction_history LEFT JOIN games ON game_url=game', $cols, $values, 1, "{$this->pagination()}" )[1];

        return [
            'data'=>$history,
            'count'=>$this->_get('transaction_history', $cols, $values, 1  )[0]
        ];
    }

    public function summariesCals() {  
        $count = "(select count(*) from players p2 where p2.game_id = g.id )"; 
        $sql = "SELECT SUM(stake_cost) AS locked_amount, $count as totalActiveGames
                    FROM games g
                    JOIN players pl ON pl.game_id = g.id 
                    WHERE pl.player_accepted_invitation = 'accepted' 
                    AND (g.status = 'in_progress' OR g.status = 'pending' OR g.status = 'disputed' )
                    AND player_user_id = ? 
                     
        ";
        $locked = $this->_query("$sql ", [Session::get('userid')  ] )[1][0] ?? [];

         
        $sql = "SELECT SUM(stake_cost) AS amountWon 
                    FROM games g
                    JOIN players pl ON pl.game_id = g.id 
                    WHERE pl.player_accepted_invitation = 'accepted' 
                    AND (g.status = 'completed' OR g.status = 'overriden_by_admin'   )
                    AND player_user_id = ? AND is_winner = 1
                     
        ";
        $winnings = $this->_query("$sql ", [Session::get('userid')  ] )[1][0] ?? [];

        return ['locked'=>$locked, 'winnings'=>$winnings ];
    }

    
    public function depositRequest($uuid = '') {
        return $this->_get('deposit_request', 'uuid', [$uuid],0)[1];
    }

    
    public function getPyament($uuid = '') {
        $data = $this->_get('deposit_request', 'uuid,status', [$uuid, 'completed'], 0)[1];

        if (empty($data)) CustomFunctions::locate('/master/balance');
        return $data;
    }

    public function sendPayment($uuid = '') {
            $apiKey = NOWPAYMENTS_API;
            $paymentUrl = "https://api.nowpayments.io/v1/payment";
            $id = $uuid;

            $data = $this->_get('deposit_request ', 'uuid', [$id] , 0)[1];
            if (empty($data)) {
                return ("<p style='color:red; background:light-gray; padding:10px; border-radius:1' ><strong>Error:</strong> Invalid payment id </p>");
            }

            $network =  'ERC20'; //for now
            $depositCoint = trim(strtoupper(str_replace(['*', '-'], ['', ''], $data['coin'])) .$network );
 
            $payload = [  
                "price_amount" => $data['amount'], // Amount in USD
                "price_currency" => 'USD',
                "pay_currency" => $depositCoint, // Paying with BTC
                "ipn_callback_url" => "https://{$_SERVER['SERVER_NAME']}/callback/nwp-hook",
                "order_id" => $id,
                "order_description" => "Deposit",
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $paymentUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "x-api-key: $apiKey",
                "Content-Type: application/json"
            ]);

            $response = curl_exec($ch); 

            $result = json_decode($response, true);
            $output = '
                        <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h3>Payment Details</h3>
                        </div>
                        <div class="card-body text-centexr"> ';
                        
            file_put_contents("logs/payments.log", "PAYMENT Resonse:: $response\n", FILE_APPEND);

            if (isset($result["pay_address"]) && isset($result["pay_amount"])) {
                
                $this->_update('deposit_request', 'wallet_address, now_order_id',  'payment_id', [$result['pay_address'] ??'', $result['payment_id'], $id] ) ;

            $until = str_replace('T','', explode('.', $result['valid_until'])[0] );
                // $output .= "<h3 class='mb-4'>Payment Details </h3> "; 
                $output .= "<div>
                            <div class='mydisp'>
                                <span>Coin:</span>
                                <span>{$depositCoint}</span></div><hr> </div>";
                
                $output .= "<div><div class='mydisp'>
                            <span>Amount:</span>
                                <span>{$result['pay_amount']} {$depositCoint}</span></div><hr> </div>";
                $output .= "<div><div class='mydisp'>
                            <span>Address: </span>
                            <span style='cursor:pointer;' onclick=\"copy('{$result['pay_address']}')\" class='paddress'>{$result['pay_address']} <img style='height:20px' src='/public/assets/system/copy.png'></span> 
                            </div><hr> </div>";
                $output .= "<div><div class='mydisp'><span>Order ID: </span><span id='orderid'>{$result['order_id']}</span></div><hr> </div>";
                $output .= "<div><div class='mydisp'><span>Expires: </span><span>{$until}</span></div><hr> </div>";
                $output .= "<div><div class='mydisp'><span>QR Code: </span><span><img  class='qr-code img-fluid' src='https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={$result["pay_address"]}'></span></div><hr> </div>";

            } else {
                if (isset($result['message'])) $output .= "<p>{$result['message']}</p>";
                else
                $output .= "Error: <p>" . json_encode($result). "</p>";
            }

            return $output .= "</div></div>";
        } 









}
