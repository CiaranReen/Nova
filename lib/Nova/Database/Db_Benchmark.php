<?php
/**
 * Provides functions for running benchmarks against DB queries.
 *
 * Created by PhpStorm.
 * User: ciaran
 * Date: 24/06/14
 * Time: 11:52
 */

class Db_Benchmark extends Solace
{

    public function __construct()
    {
        parent::__construct();
        $this->solace = new Solace();
    }

    public function getTime($query)
    {
        $start = microtime(true);
        $this->solace->prepare($query);
        $end = microtime(true);

        print 'Query took ' . number_format($end - $start, 4) . ' to complete';
    }
}