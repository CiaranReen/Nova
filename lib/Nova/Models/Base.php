<?php
/**
 * Base Model class
 *
 *
 * @copyright  2014 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

class Models_Base extends Database_Solace {

    /**
     * Construct the Database object for use with all child models
     */
    public function __construct()
    {
        $this->db = new Database_Solace();
    }
}