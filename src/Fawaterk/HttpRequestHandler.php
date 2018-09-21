<?php

namespace Fawaterk;

class HttpRequestHandler
{
    /**
     * @var string $apiUrl
     */
    private $apiUrl = "https://app.fawaterk.com/api/invoice";

    /**
     * Send the request to the API
     */
    public function send( array $data )
    {
        $data = json_encode($data);
        
        $ch = curl_init($this->apiUrl);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );

        $curlResult = curl_exec($ch);

        return json_decode($curlResult);
    }
}
