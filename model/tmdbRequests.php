<?php

class tmdbRequests {

    public static function getCurrent() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.covidtracking.com/v1/us/current.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $dResponse = json_decode($response, true);
        $dResponse = $dResponse[0];
        if (array_key_exists('error', $dResponse)) {
            $apiErr = $dResponse['message'];
        } else {
            
        }
        $err = curl_error($curl);
        if ($err !== '') {
            var_dump($err);
        }
        curl_close($curl);
        return $dResponse;
    }

}
