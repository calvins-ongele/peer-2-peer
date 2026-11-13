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









}
