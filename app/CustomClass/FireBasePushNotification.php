<?php

namespace App\CustomClass;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;

class FireBasePushNotification
{
    private $url = 'https://fcm.googleapis.com/v1/projects/blade-260d6/messages:send';
    private $scope = "https://www.googleapis.com/auth/firebase.messaging";
    private $token;

    public function __construct()
    {
        $credentials = new ServiceAccountCredentials($this->scope, [
            "type" => "service_account",
            "project_id" => "blade-260d6",
            "private_key_id" => "3e5b6a6015fc8ff0ec0d40892290b18babba7d35",
            "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQC1Rmax01P0h1s7\nC4ICR8Ono8vyS20Ba1odsj9SKoG+0srsk3mVoClp/zEYOQ/WP7Nm4RYSPO+acAIK\n/fkwpPwybTqLNPcxd3FPEXFHnkKSLPfGtB8qmfgN2aDvjuCJ5TcQdp6Ca2c3QXvY\nkypOIYGnF0BdQHYB6vlYylHy4YLlTVFVRYujqcDHVHPeeFa1DaFO8AdYZj1Sv7NC\n8cgpoNOjF9SmqRyBeRjdeW2cfK4OSA4iSHOPwcruULEC+WRwFOWDwQl+c6F95kxo\nx61tnykpGhv4ACMYZBq9sW9hw6vRxW0rvXDlAWMXQcRri08WNTnwcrkSPz6Mish5\nTcBDvkpBAgMBAAECggEAUzhx1vuE1IL7kBzVX8SgfyrEa4TTE068fVuilE8tZ3SQ\ncpG1xMpVmPLuEAfKTHrMGtQE9PSCr2zykydLqlhj66aXtObpAQ2ruDfywIVYXJFG\nYzO4By/OYFVj+/alAMl5QRaj6I30QbrPZ3sQdfQN+K7E/sqkIndEZ83iV1XOaQQS\n3PeiwDhhTk4maauiPD6UOgybZw8z6SYMTf09ECkfvgB7OXJMfMC0loAumlQZzqyf\nD7nJor0T0IuzG8FkswOqNzkZjS107v7R5jFnv3seyQ6FOgxlFvEDaUCiQTAs3+96\n5EFWvEUi+S04dthjt4icMofapkKR6UYymaT0PynazQKBgQDi9v+5l77yABLgpU8q\necpjff+09PA62h/HvP95pGYIXRmwSao73IVQL29ALiKI38ovDfI4S1U8zZi17zuh\n064mwj+cN5ACKrAyVQNX0udQdkrm1smdcTgerQIobTS+KzDtzMCERMlIaDQMHi/y\nsX6mYxeTPBLg6AVVHnCOkOb/SwKBgQDMdxRpwdTKlhSrNfG0pLHtNVNIPZNFbD60\naY6X4x8BbhEOC7DhE+3Xiu9bd5HMmZHK3CNwtKfbF4IHwniFeQcbGe7xl7rW5CiO\nlg6zWGCUVHRMcnciun59dmwdMBTLZNbS8gHTTIVEZiqx6V91EbVcpzJHeGoew9c6\nd6cSTPdJIwKBgDzOW9jHNNr09hnFcB47HuPk39sFPE8oHReQJQnb55IaD0XRlpAP\nFpBTBQU21v3ApxRQMjKuzBlMI7uqalmCssejhxM9N5G9ChOR/yFKWbqO1qZdqQpL\nSPO++jMGfvjr7WHoVzOYkiyZ7kfI1qO4teux5KEHmS80OimBzDoFzD1dAoGAJ4Gu\nwQyByC8diUNgE45rDrFqCSBUr2pN52Ap/DEXUZhp1TPvFl5aa3Zd72d4FXdq0y6b\n7nAJquys5EDwNqH+/H6TS70Mje8B4yMdbgvahW6YFhlb6artO+LA2xbqPa6bT6ER\nNzmm2mN/RmcYWa91QpTPwz2CC7W9hX+PGZsjgM8CgYA6ho8A2ksPGz+Hzdj/m3Cu\nQ2ZFB2K5s69iqa25meu2w3p61jZIaI8O1btkyeqS5oIG92he6rv2gKtahdRdgeLX\nBfJ1017peLqmS274WRO7MCzyZwfDfBPlQO4ia9GVG5FF+pD1UTDZ/FCugdYyeM/p\nUBBc1bJWsgrpVpmrRxUJ6g==\n-----END PRIVATE KEY-----\n",
            "client_email" => "firebase-adminsdk-4fbh3@blade-260d6.iam.gserviceaccount.com",
            "client_id" => "114348859780256697647",
            "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-4fbh3%40blade-260d6.iam.gserviceaccount.com",
            "universe_domain" => "googleapis.com"
        ]);

        $this->token = $credentials->fetchAuthToken(HttpHandlerFactory::build());
    }

    public function to($device, $body, $title = "My favorite App")
    {
        $data = [
            'token' => $device,
            'title' => $title,
            'body' => $body
        ];

        return $this->send($data);
    }

    public function toMultiple(array $devices, $body, $title = "My favorite App")
    {
        foreach ($devices as $device) {
            $data = [
                'token' => $device,
                'title' => $title,
                'body' => $body
            ];
            $this->send($data);
        }
    }

    public function toTopic($topic, $body, $title = "My favorite App")
    {
        $data = [
            'topic' => $topic,
            'title' => $title,
            'body' => $body
        ];

        return $this->sendToTopic($data);
    }

    private function sendToTopic($data)
    {
        $headers = [
            'Authorization: Bearer ' . $this->token['access_token'],
            'Content-Type: application/json'
        ];

        $fields = [
            'message' => [
                'topic' => $data['topic'],
                'notification' => [
                    'title' => $data['title'],
                    'body' => $data['body']
                ]
            ]
        ];

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function send($data)
    {
        $headers = [
            'Authorization: Bearer ' . $this->token['access_token'],
            'Content-Type: application/json'
        ];

        $fields = [
            'message' => [
                'token' => $data['token'],
                'notification' => [
                    'title' => $data['title'],
                    'body' => $data['body']
                ]
            ]
        ];

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
