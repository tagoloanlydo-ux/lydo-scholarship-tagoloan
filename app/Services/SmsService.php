<?php

namespace App\Services;

class SmsService
{
    /**
     * Send SMS using qproxy API
     *
     * @param string $mobile
     * @param string $message
     * @return bool
     */
    public function sendSms($mobile, $message)
    {
        $send_data = [];

        $send_data['mobile'] = $mobile;
        $send_data['message'] = $message;
        $send_data['token'] = '79c86f1d1e497f5febc0ec9763f7e4b5';
        $parameters = json_encode($send_data);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://app.qproxy.xyz/api/sms/v1/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [];
        $headers = array(
            "Content-Type: application/json"
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $get_sms_status = curl_exec($ch);
        curl_close($ch);

        // Assuming success if no curl error, you can parse $get_sms_status for better error handling
        return $get_sms_status !== false;
    }
}
