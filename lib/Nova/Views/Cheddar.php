<?php
/**
 * Nova Templating class
 *
 * Set the view files to rendered and display them to the user
 *
 * @copyright  2014 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

class Cheddar {

    public function replaceVariables(&$view, $variables){

        $view = preg_replace_callback('/(\\{)(\\{)((?:[a-zA-Z]*))(\\})(\\})/',
            function($match) use($variables){
                return $variables[$match[3]];
            }, $view);

    }

    public function parse($view, $variables){

        $this->replaceVariables($view, $variables);

        return $view;
    }
}