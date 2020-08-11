<?php

namespace App\Services;

use Carbon\Carbon;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Storage;

class NotificationService
{
    public function html2userids($html) {
        if(!preg_match_all("/\<span.*?data-mention=\\\"(\d+)\\\".*?\>/m", $html, $matches, PREG_SET_ORDER)) {
            return [];
        }

        return array_map(function($match) {
            return $match[1];
        }, $matches);
    }

    public function sendToUsers($users, $data) {
        foreach($users as $user) {
            $this->send($user, $data);
        }
    }

    public function send($user_id, $data)
    {
        if($user_id == NULL)
            return false;

        Bildirim::create([
            'user_id' => $user_id,
            'data' => json_encode($data),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $ch = curl_init("http://localhost:5000/send?user_id=" . $user_id);
        $str = json_encode($data);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($str))
        );

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}
