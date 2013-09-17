<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenius
 * Date: 9/16/13
 * Time: 11:49 PM
 * To change this template use File | Settings | File Templates.
 */

class InstructionLoader
{
    static function getInstruction($name)
    {
        $filename = "files/instructions/".$name.".php";
        if(file_exists($filename))
        {
            include $filename;
            return $steps;
        }

        return false;
    }
}