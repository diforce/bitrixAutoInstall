<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenius
 * Date: 9/14/13
 * Time: 2:20 AM
 * To change this template use File | Settings | File Templates.
 */

class bitrixInstaller extends Installer
{
    function mkHost($domain)
    {
        $arr = array();
        exec("sudo mkhost ".$domain." > /dev/null &", $arr, $result);
    }

    function unpackDist($path)
    {
        $zip = new ZipArchive();
        if($zip->open('files/distributions/bitrix/start_encode_php5.zip'))
        {
            $zip->extractTo($path);
            $zip->close();
            exec("sudo chmod 777 -R ".$path);
            return true;
        }
    }
}