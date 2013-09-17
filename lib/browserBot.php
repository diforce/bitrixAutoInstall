<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenius
 * Date: 9/14/13
 * Time: 3:35 PM
 * To change this template use File | Settings | File Templates.
 */

class browserBot
{
    public $i = 0;
    protected $cookies = array();
    function sendRequest($url, $post)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getPostStr($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        if($this->cookies)
            curl_setopt($ch, CURLOPT_COOKIE, $this->getCookieStr());
        $content = curl_exec($ch);

        $ex = explode("\r\n\r\n", $content, 2);
        $header = $this->parseHeader($ex[0]);

        if(isset($header['cookies']))
        {
            $this->addCookie($header['cookies']);
        }

        file_put_contents("log/log".$this->i, $ex[1]);

        $this->i++;
        return $content;
    }

    function addCookie($arr)
    {
        $this->cookies = array_merge($this->cookies, $arr);
    }

    function getPostStr($arr)
    {
        $str = "";
        foreach($arr as $key => $val)
        {
            $str .= $key."=".urlencode($val)."&";
        }

        $str = substr($str, 0, strlen($str)-1);
        return $str;
    }

    function parseHeader($content)
    {
        $data = array();
        $ex = explode("\n", $content);
        foreach($ex as $str)
        {
            $e = explode(":", $str);
            if(isset($e[1]))
                $data[trim($e[0])] = trim($e[1]);
        }

        if(isset($data['Set-Cookie']))
        {
            $e = explode(";", $data['Set-Cookie'], 2);
            foreach($e as $val)
            {
                $val = explode("=", $val);
                if(isset($val[1]))
                    $data['cookies'][trim($val[0])] = trim($val[1]);
            }
        }

        return $data;


    }

    function getCookieStr()
    {
        $str = "";
        foreach($this->cookies as $key => $val)
        {
            $str .= $key."=".$val."; ";
        }

        $str = substr($str, 0, strlen($str)-2);
        return $str;
    }

    function getCookie($name)
    {
        return $this->cookies[$name];
    }
}