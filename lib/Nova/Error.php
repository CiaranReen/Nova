<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 12:06
 * This is the error for the Nova framework */

namespace Nova\Error;

class Error
{
    public function display_error($message)
    {
        die($message);
    }

    public function display_404()
    {

    }


}