<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rajaongkir {
    private $api_key = 'ISI_API_KEY_ANDA_DI_SINI';
    private $base_url = 'https://api.rajaongkir.com/starter/'; // Gunakan 'pro' jika Anda akun berbayar

    public function kirim_request($url, $data = null) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array("key: " . $this->api_key),
        ));
        
        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_POST, true);
        }

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}