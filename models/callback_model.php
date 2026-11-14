<?php
class Callback_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function paypaldepositfeedback() {
        $rawInput = file_get_contents("php://input");
        $data = json_decode($rawInput,1) ?? [];

        $amount_orig = $data['cl']['actually_paid_usd'] ?? 0;
        $amount_to_be_paid = $data['cl']['amount_usd'] ?? 0;
        $final_amount = $amount_to_be_paid;

        if ($amount_to_be_paid < $amount_orig) { //just in case a lower amount was paid 
            $final_amount = $amount_orig;
        } 

        $this->_update('users', 'user_balance', 'id', [$final_amount, $data['user_id'] ]);
        $this->chuckoffAmount($final_amount, $this->me($data['user_id']) );

    }

    public function mpesadepositfeedback() {
        $rawInput = file_get_contents("php://input");
        $data = json_decode($rawInput,1) ?? [];

        $amount_orig = $data['cl']['actually_paid_usd'] ?? 0;
        $amount_to_be_paid = $data['cl']['amount_usd'] ?? 0;
        $final_amount = $amount_to_be_paid;

        if ($amount_to_be_paid < $amount_orig) { //just in case a lower amount was paid 
            $final_amount = $amount_orig;
        } 

        $this->_update('users', 'user_balance', 'id', [$final_amount, $data['user_id'] ]);
        $this->chuckoffAmount( ($final_amount/USD_2_KES_RATE), $this->me($data['user_id']),action:'add',purpose:'Mpesa Deposit' );

    }
    public function mpesawithdrawalfeedback() {
        
        $rawInput = file_get_contents("php://input");
        $data = json_decode($rawInput,1) ?? [];
        $uuid = $data['cl']['user_id'] ?? 0;

        $data = $this->_get("deposit_request", "uuid ", [ $uuid ], 0)[1];
        if (empty($data)) die;

        $this->chuckoffAmount( $data['amount']??0, $this->me($data['user_id']), orderUuid:$uuid, purpose:'mpesa payment', action:'sub' );


    }



    
        public function hookCallBack() {

            $secretKey = NOWPAYMENTS_API;

            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);
            file_put_contents("logs/payments.log", "$payload\n", FILE_APPEND);

            if (!$data) {
                http_response_code(400);
                exit("Invalid request");
            }

            $receivedHmac = $_SERVER['HTTP_X_NOWPAYMENTS_SIG'] ?? '';
            $calculatedHmac = hash_hmac('sha512', $payload, $secretKey);

            if ($receivedHmac !== $calculatedHmac) {
                http_response_code(403);
                // exit("Invalid signature"); //TODO: activate later
            }

            $orderId = $data['order_id'];
            $paymentStatus = $data['payment_status'];

            if ($paymentStatus === "waiting") {
                file_put_contents("logs/payments.log", "Payment for $orderId is waiting\n", FILE_APPEND);
            } elseif ($paymentStatus === "finished") {
                file_put_contents("logs/payments.log", "Payment for $orderId completed\n", FILE_APPEND);
            } elseif ($paymentStatus === "failed") {
                file_put_contents("logs/payments.log", "Payment for $orderId failed\n", FILE_APPEND);
            } 

            $paymentId = $data["payment_id"] ?? "N/A";
            $orderId = $data["order_id"] ?? "N/A";
            $payAddress = $data["pay_address"] ?? "N/A";
            $payAmount = $data["pay_amount"] ?? "N/A";
            $payCurrency = strtoupper($data["pay_currency"] ?? "N/A");
            $priceAmount = $data["price_amount"] ?? "N/A";
            $priceCurrency = strtoupper($data["price_currency"] ?? "N/A");
            $paymentStatus = ucfirst($data["payment_status"] ?? "N/A");
            $expirationDate = $data["valid_until"] ?? "N/A";

            if ($paymentStatus !== "finished") {
                http_response_code(200);
                exit("IPN received but payment not completed yet");
            }

            $user = $this->_get('deposit_request', 'payment_id, status', [$orderId, 0], 0)[1];
            if (empty($user)) die(1);
            $coinid = $this->_get('currencies', "symbol", [$this->_settings()['default_currency']])[1];

            try { 
                $this->_insert("user_wallets:IGNORE","user_id, currency_id",[
                    $user['user_ID'], $coinid['id']
                ]);
            } catch(Exception $e) {}

            $this->_update('deposit_request', 'status, data', 'payment_id', [1, json_encode($data), $orderId]);

            $previousAmount = $this->_get('user_wallets', "user_id, currency_id", [$user['user_id'], $coinid['id'] ],0)[1]['balance'];
            $this->_update('user_wallets', "balance", "user_id, currency_id", [$previousAmount + $priceAmount, $user['user_id'], $coinid['id']] );

            //$this->_update('users', 'user_balance', 'user_ID', 
            //[ $this->_get('users','user_ID',[$user['user_id']],0)[1]['user_balance'] + $priceAmount ]);
            $content = "
                    <h3>A new deposit just happened</h3>
                    <p>A new client by {$user['user_full_name']} just registered. Please loging and see.</p>
                    ";
            $body = "
                    <p> Dear {$user['user_full_name']},br>Your deposit was successfully received. Log in and happy trading.</p>
                    ";
            $this->sendTheEmail("Deposit Received", "{$user['user_email']}", $body); 

            http_response_code(200);
            echo "IPN received";
    
        }







}
