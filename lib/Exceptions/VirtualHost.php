<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenius
 * Date: 9/17/13
 * Time: 1:53 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Exceptions;

class VirtualHost extends \Exception
{
    function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}


