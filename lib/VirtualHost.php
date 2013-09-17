<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenius
 * Date: 9/17/13
 * Time: 1:30 AM
 * To change this template use File | Settings | File Templates.
 */

class VirtualHost
{
    protected static $path = "/etc/apache2";
    static function add($name, $dir)
    {
        $availablePath = self::$path."/sites/available";
        $filename = time();
        while(file_exists($availablePath."/".$filename))
        {
            if(!isset($ex))
                $ex = explode("_", $filename);

            if(isset($ex[1]))
            {
                $ex[1]++;
            }
            $filename = implode("_", $ex);
        }
        $vHTemplate = file_get_contents("files/templates/virtualHost.xml");
        $arr = array(
            "vhost" => $name,
            "dir"   => $dir
        );

        foreach($arr as $key => $val)
        {
            $vHTemplate = str_replace("#".$key."#", $val, $vHTemplate);
        }


        if(file_put_contents($availablePath."/".$filename, $vHTemplate))
        {

        }

        return $filename;
    }
}