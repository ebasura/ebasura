<?php

class PhilSMSApi {
    private $apiUrl = "https://app.philsms.com/api/v3/sms";
    private $bearerToken;

    public function __construct($bearerToken) {
        $this->bearerToken = $bearerToken;
    }

    private function sendRequest($url, $method = 'GET', $data = null) {
        $headers = [
            'Authorization: Bearer ' . $this->bearerToken,
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST' && $data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception('Request Error: ' . curl_error($ch));
        }

        curl_close($ch);
        return json_decode($response, true);
    }

    public function sendSms($recipient, $senderId, $message, $type = 'plain') {
        $url = $this->apiUrl . '/send';
        $data = [
            'recipient' => $recipient,
            'sender_id' => $senderId,
            'type' => $type,
            'message' => $message
        ];
        return $this->sendRequest($url, 'POST', $data);
    }

    public function getSmsStatus($smsId) {
        $url = $this->apiUrl . '/' . $smsId;
        return $this->sendRequest($url, 'GET');
    }

    public function getAllSms() {
        return $this->sendRequest($this->apiUrl, 'GET');
    }
}

// Usage Example:
try {
    $bearerToken = '944|9Szci3KSbDkuxNGOzsL9nRycelhylzLoidyCNf4u';
    $philSms = new PhilSMSApi($bearerToken);

    // Send SMS
//    $response = $philSms->sendSms('639568104939', 'PhilSMS', 'This is a test message');
//    print_r($response);

    // Get SMS Status
    $smsId = '3434276538109';
    $status = $philSms->getSmsStatus($smsId);
    print_r($status);

    // Get All SMS
    $allSms = $philSms->getAllSms();
    print_r($allSms);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
