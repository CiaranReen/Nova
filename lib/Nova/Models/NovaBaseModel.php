<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:01
 */

class NovaBaseModel extends Solace {

    /**
     * Construct the Database object for use with all child models
     */
    public function __construct()
    {
        $this->db = new Solace();
    }
}