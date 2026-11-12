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
        $this->chuckoffAmount( ($final_amount/USD_2_KES_RATE), $this->me($data['user_id']) );

    }
    public function mpesawithdrawalfeedback() {
        
        $rawInput = file_get_contents("php://input");
        $data = json_decode($rawInput,1) ?? [];
        $uuid = $data['cl']['user_id'] ?? 0;

        $data = $this->_get("deposit_request", "uuid ", [ $uuid ], 0)[1];
        if (empty($data)) die;

        $this->chuckoffAmount( $data['amount']??0, $this->me($data['user_id']), $uuid, 'mpesa payment', 'sub' );


    }









}
