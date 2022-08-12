<?php

namespace App\Libraries;



class RequestHandler
{

    public static function get_data($response)
    {
        $header      = explode(';', $response->getHeader('Content-Type')[0]);
        $contentType = $header[0];
        if ($contentType == 'application/json') {
            $contents = $response->getBody()->getContents();
            $data     = json_decode($contents);
            if (json_last_error() == JSON_ERROR_NONE) {
                return $data;
            }
            return $contents;
        }

        return false;
    }

    public static function is_connected()
    {
        $response = null;
        system("ping -c 1 google.com", $response);
        if ($response == 0) {
            return true;
        } else {
            return 0;
        }
    }
}
