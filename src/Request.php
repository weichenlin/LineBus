<?php

namespace AZnC\LineBusType76;

/**
 * wrap HTTP request from Line Webhook
 * the value is static so we are safe when this class has multiple instance
 *
 * @package AZnC\LineBusType76
 */
class Request
{
    /**
     * @var string
     */
    protected static $signature;

    /**
     * @var string
     */
    protected static $requestBody;

    public function getSignature()
    {
        if (!self::$signature) {
            $headers = getallheaders();
            self::$signature = $headers['X-Line-Signature'];
        }

        return self::$signature;
    }

    public function getRequestBody()
    {
        if (!self::$requestBody) {
            self::$requestBody = stream_get_contents(fopen('php://input', 'r'));
        }

        return self::$requestBody;
    }
}
