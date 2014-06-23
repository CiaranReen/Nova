<?php

/**
 * Paginator for Nova
 *
 *
 * @author      Ciaran Reen
 * @copyright   2014 Nova Framework
 * @license     http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version     Release: @package_version@
 * @link        http://novaframework.com/package/PackageName
 * @since       Class available since Release 0.0.1
 */

class Pagination
{
    /**
     * @var int
     */
    public $resultsPerPage = 10;

    /**
     * @var
     */
    public $totalNumberOfResults = 100;

    /**
     * @var bool
     */
    protected $usePageNumbers = true;

    /**
     * @var int
     */
    protected $startPage = 1;

    /**
     * @var
     */
    public $baseUrl;

    /**
     * @var array
     */
    public $pages = array();

    /**
     * @var
     */
    public $data;

    /**
     * @param int $resultsPerPage
     * @return $this
     */
    public function setResultsPerPage($resultsPerPage)
    {
        $this->resultsPerPage = $resultsPerPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getResultsPerPage()
    {
        return $this->resultsPerPage;
    }

    /**
     * @param mixed $totalNumberOfResults
     * @return $this
     */
    public function setTotalNumberOfResults($totalNumberOfResults)
    {
        $this->totalNumberOfResults = $totalNumberOfResults;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalNumberOfResults()
    {
        return $this->totalNumberOfResults;
    }

    /**
     * @param boolean $usePageNumbers
     * @return $this
     */
    public function setUsePageNumbers($usePageNumbers)
    {
        $this->usePageNumbers = $usePageNumbers;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getUsePageNumbers()
    {
        return $this->usePageNumbers;
    }

    /**
     * Create the paginator. This returns a paginator object with all the requested options and the data to be displayed
     *
     * @param $data
     * @return array
     */
    public function create($data)
    {
        //Using page numbers?
        if ($this->usePageNumbers == true)
        {
            //Get the total number of pages and round up
            $totalPages = $this->totalNumberOfResults / $this->resultsPerPage;
            $totalPages = ceil($totalPages);

            //Generate the page links
            for ($i=$this->startPage; $i<=$totalPages; $i++)
            {
                $this->pages[] = '<a href="' . $this->baseUrl . '?page=' . $i . '">' . $i . '</a>';
            }

            $lastPageLink = $i - 1;

            //Get the first and last page and add to the array
            $firstPage = '<a href="' .$this->baseUrl . '?page=' . $this->startPage . '">First</a>';
            $lastPage = '<a href="' .$this->baseUrl . '?page=' . $lastPageLink . '">Last</a>';

            array_unshift($this->pages, $firstPage);
            array_push($this->pages, $lastPage);

            //Is the page set? Make sure it's greater than 1
            if (isset($_GET['page']) && $_GET['page'] > 1)
            {
                //Get the current amount of results per page
                $currentPageResults = ($this->resultsPerPage * $_GET['page']) - $this->resultsPerPage;

                if (count($data) > $currentPageResults)
                {
                    //Take the current array and slice it at the appropriate points
                    $data = array_slice($data, $currentPageResults, $this->resultsPerPage);
                }
            }
            //Page 1
            else
            {
                //Just generate the first N elements of the array
                while (count($data) > $this->resultsPerPage)
                {
                    array_pop($data);
                }
            }
            $this->data = $data;

            return $this;
        }
    }
}