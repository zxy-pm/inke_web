<?php


namespace app\util;


class Net
{
    public static function posturl($url,array $data)
    {
//   $headerArray =array(
//       "Content-type:application/json;charset='utf-8'",
//       "Accept:application/json"
//   );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $output = json_decode($output, true);
        if(!$output) return false;
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $output['c'] = $httpCode;
        curl_close($curl);
        return $output;
    }
}