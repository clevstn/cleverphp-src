<?php
// +------------------------------------------------------------------------------------
// | Desc: Common Function
// + -----------------------------------------------------------------------------------
// | By: PhpStorm 
// +------------------------------------------------------------------------------------
// | Date: 2020/5/5 
// + -----------------------------------------------------------------------------------
// | Author: cleverstone
// +------------------------------------------------------------------------------------

if (!function_exists('throw_error')) {

    /**
     * Throwing a user exception.
     *
     * @param string $errorStr
     * @throws \clever\exception\UserException
     * @author cleverstone
     */
    function throw_error($errorStr = '')
    {
        throw new \clever\exception\UserException($errorStr);
    }
}

if (!function_exists('curl_req')) {

    /**
     * Curl is commonly encapsulated.
     *
     * @param string $url URL
     * @param string $errorStr 失败时的错误信息
     * @param string $method 请求动作
     * @param array $data 数据
     * @param string $contentType 请求类型
     * @param int $timeOut 响应超时时间
     * @return false|string
     * @throws \clever\exception\UserException
     * @author cleverstone
     */
    function curl_req($url, &$errorStr, $method = 'GET', array $data = [], $contentType = 'URLENCODED', $timeOut = 10)
    {
        $ch = curl_init($url);
        switch (strtoupper($method)) {
            case 'POST':
                switch (strtoupper($contentType)) {
                    case 'URLENCODED':
                        $head = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                        $param = http_build_query($data);
                        break;
                    case 'XML':
                        $head = 'Content-Type: text/xml; charset=UTF-8';
                        $param = data2xml($data);
                        break;
                    case 'JSON':
                        $head = 'Content-Type: application/json; charset=UTF-8';
                        $param = json_encode($data);
                        break;
                    default:
                        throw_error('Unsupported request Content-Type. ');
                }

                curl_setopt($ch, CURLOPT_HTTPHEADER, [$head]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
                curl_setopt($ch, CURLOPT_POST, 1);
                break;
            case 'GET':
                break;
            default:
                throw_error('Unsupported request methods. ');
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $errorStr = curl_error($ch);
            return false;
        }

        return $result;
    }
}

if (!function_exists('data2xml')) {
    /**
     * Into xml.
     *
     * @param array|object $data 需要转换的数据
     * @return string
     * @author cleverstone
     */
    function data2xml($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        $xml = '';
        foreach ($data as $key => $val) {
            if (is_null($val)) {
                $xml .= "<{$key}/>\r\n";
            } else {
                if (!is_numeric($key)) {
                    $xml .= "<{$key}>";
                }

                $xml .= (is_array($val) || is_object($val)) ? data2xml($val) : $val;
                if (!is_numeric($key)) {
                    $xml .= "</{$key}>\r\n";
                }
            }
        }

        return "<xml>\r\n{$xml}</xml>";
    }
}