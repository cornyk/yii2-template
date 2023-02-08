<?php

namespace app\utils;

use GuzzleHttp\Client;
use Yii;

class RequestUtil
{
    /**
     * 发出请求
     * @param string $url
     * @param string $method
     * @param array $data
     * @param float $timeout
     * @param int $retry
     * @return string|null
     */
    public static function send(string $url, string $method = 'GET', array $data = [], float $timeout = 5.0, int $retry = 3): ?string
    {
        $requestClient = new Client([
            'timeout' => $timeout,
        ]);

        $responseData = null;
        for ($i = 0; $i < $retry; $i++) {
            $logString = "URL: {$url}, METHOD: {$method}, DATA: " . json_encode($data, JSON_UNESCAPED_UNICODE) . ", TIMEOUT: {$timeout}, RETRY: " . ($i+1);

            try {
                $response = $requestClient->request($method, $url, $data);
            } catch (\Throwable $e) {
                $errorInfo = $e->getMessage();
                Yii::error("FAILED SEND REQUEST: {$logString}, ERROR INFO: {$errorInfo}" , 'sendRequest');
                continue;
            }

            $responseStatusCode = $response->getStatusCode();
            if ($responseStatusCode == 200) {
                $responseData = $response->getBody()->getContents();
                Yii::info("SUCCESS SEND REQUEST: {$logString}, STATUS_CODE: 200, RESPONSE_DATA: {$responseData}" , 'sendRequest');
                break;
            } else {
                Yii::error("FAILED SEND REQUEST: {$logString}, STATUS_CODE: {$responseStatusCode}" , 'sendRequest');
            }
        }
        return $responseData;
    }
}
