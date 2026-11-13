<?php
class Mail_cron_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function run() {
        $emailData = $this->_get('mail_queues', 'status', ['pending'], 0, 'order by id asc')[1];
        if (!empty($emailData)) {
            if (CustomFunctions::validEmail($emailData['email']))
                $this->sendTheEmail(
                    title:$emailData['subject']??'',
                    recipient:$emailData['email'],
                    body:$emailData['msg']
                );

            $this->_update('mail_queues', 'status', 'id', ['sent', $emailData['id']]);
        }
    }



}
