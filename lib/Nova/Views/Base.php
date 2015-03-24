<?php
/**
 * Base View class
 *
 * Set the view files to rendered and display them to the user
 *
 * @copyright  2014 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

class Views_Base
{

    public function __construct() {}

    //Build the view from the given url
    public function render($name)
    {
        require_once 'app/views/layout/header.phtml';
        require_once 'app/views/' . $name;
        require_once 'app/views/layout/footer.phtml';
    }
}