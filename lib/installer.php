<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenius
 * Date: 9/16/13
 * Time: 2:22 PM
 * To change this template use File | Settings | File Templates.
 */

class Installer
{
    function run($instruction)
    {
        $browserBot = new browserBot();
        foreach($instruction as $postData)
        {
            foreach($postData as $key => $val)
            {
                if(preg_match_all("!#(.*?)#!is", $val, $matches))
                {
                    foreach($matches[1] as $val)
                    {
                        $ex = explode(".", $val, 2);
                        if($ex[0] == "cookies")
                        {
                            if($browserBot->getCookie($ex[1]))
                            {
                                $postData[$key] = str_replace("#".$ex[0].".".$ex[1]."#", $browserBot->getCookie($ex[1]), $postData[$key]);
                            }
                        }
                    }
                }
            }

            $browserBot->sendRequest("http://test_diforce/", $postData);
        }
    }
}