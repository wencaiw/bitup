<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/26
 * Time: 下午2:49
 */

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BTHttp {
    static final public function request($url, $method, array $data, $timeout, $add_header = array()) {
        try {
            $timeout = (isset($timeout) && is_int($timeout)) ? $timeout : 20;
            $ch = curl_init();
            /*支持SSL 不验证CA根验证*/
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            /*重定向跟随*/
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_REFERER, "BTPhp");
            //当 HTTP 状态码大于等于 400，TRUE 将将显示错误详情。 默认情况下将返回页面，忽略 HTTP 代码
            //curl_setopt($ch, CURLOPT_FAILONERROR, 1);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            if (!empty($timeout)) {
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            } else {
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            }
            //设置 CURLINFO_HEADER_OUT 选项之后 curl_getinfo 函数返回的数组将包含 cURL
            //请求的 header 信息。而要看到回应的 header 信息可以在 curl_setopt 中设置
            //CURLOPT_HEADER 选项为 true
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLINFO_HEADER_OUT, false);

            $header = array("Content-Type:application/json;charset=utf-8;", "Connection: keep-alive;");
            $methodIgnoredCase = strtolower($method);
            switch ($methodIgnoredCase) {
                case "oauth_github_post":
                    $header = array("Content-Type:application/json;charset=utf-8;",
                        "Connection: keep-alive;",
                        "Accept: application/json");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_POST, true);
                    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); //POST数据
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //POST数据
                    curl_setopt($ch, CURLOPT_URL, $url);
                    break;
                case "raw_post":
                    $header = array("Content-Type:application/json", "Accept-Charset:utf-8", "Connection: keep-alive");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_POST, true);
                    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); //POST数据
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //POST数据
                    curl_setopt($ch, CURLOPT_URL, $url);
                    break;
                case "post":
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, $add_header));
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //POST数据
                    curl_setopt($ch, CURLOPT_URL, $url);
                    break;
                case "delete":
                    curl_setopt($ch, CURLOPT_URL, $url."?para=".urlencode(json_encode($data)));
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;
                case "new_delete":
                    curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($data));
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;
                case "put":
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, $add_header));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //POST数据
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_URL, $url);
                    break;
                case "get":
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, $add_header));
                    curl_setopt($ch, CURLOPT_URL, $url."?para=".urlencode(json_encode($data)));
                    break;
                case "new_get":
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, $add_header));
                    curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($data));
                    break;
                case "raw_get":
                    curl_setopt($ch, CURLOPT_URL, $url);
                    break;
                case "oauth_github_get":
                    $header = array("User-Agent: BeeCloud");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    break;
                default:
                    throw new Exception('不支持的HTTP方式');
            }

            $result = curl_exec($ch);
            if (curl_errno($ch) > 0) {
                throw new Exception(curl_error($ch));
            }
            curl_close($ch);
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}