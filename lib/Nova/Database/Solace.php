<?php

/**
 * Solace is Nova's built in Query Builder
 *
 * This class provides functionality for many common database functions. Solace utilizes the PDO class
 * to provide sanitization and validation across all queries. Solace is effectively the gateway between the models
 * and PDO, building the query and passing the built SQL back and forth between the two.
 *
 * @copyright  2014 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

class Solace extends Db {

//---------------------------------------------------------------------------------
// Initialize the variables here so we can return an object from every function.
//---------------------------------------------------------------------------------

    /**
     * @var array
     */
    protected $_select = array();

    /**
     * @var array
     */
    protected $_distinct = array();

    /**
     * @var array
     */
    protected $_from = array();

    /**
     * @var array
     */
    protected $_innerJoin = array();

    /**
     * @var array
     */
    protected $_leftJoin = array();

    /**
     * @var array
     */
    protected $_rightJoin = array();

    /**
     * @var array
     */
    protected $_fullJoin = array();

    /**
     * @var array
     */
    protected $_where = array();

    /**
     * @var array
     */
    protected $_like = array();

    /**
     * @var array
     */
    protected $_andWhere = array();

    /**
     * @var array
     */
    protected $_orWhere = array();

    /**
     * @var array
     */
    protected $_in = array();

    /**
     * @var array
     */
    protected $_between = array();

    /**
     * @var array
     */
    protected $_orderBy = array();

    /**
     * @var array
     */
    protected $_union = array();

    /**
     * @var array
     */
    protected $_limit = array();

    /**
     * @var array
     */
    protected $_dropTable = array();

    /**
     * @var array
     */
    protected $_dropIndex = array();

    /**
     * @var array
     */
    protected $_dropDatabase = array();

    /**
     * @var array
     */
    protected $_truncateTable = array();

    /**
     * @var array
     */
    protected $_createTable = array();

    /**
     * @var array
     */
    protected $_addColumn = array();

    /**
     * @var array
     */
    protected $_dropColumn = array();



    /**
     * Access to the PDO functions
     */
    public function __construct()
    {
        parent::__construct();
        $this->pdo = new Db();
    }

//---------------------------------------------------
// Main SQL functions
//---------------------------------------------------

    /**
     * Select portion of Solace QB
     * @param       $fields
     * @return      string
     */
    public function select($fields = '*')
    {
        $this->reset_values();
        $this->_select = "SELECT " . $fields;
        return $this;
    }

    /**
     * Select Distinct portion of Solace QB
     *
     * @param       string $fields
     * @return      $this
     */
    public function distinct($fields = '*')
    {
        $this->reset_values();
        $this->_distinct = "SELECT DISTINCT " . $fields;
        return $this;
    }

    /**
     * From portion of Solace QB
     *
     * @param       array $table
     * @return      $this
     */
    public function from($table = array())
    {
        foreach ($table as $key=>$value)
        {
            //Is an alias set?
            if ($value != '')
            {
                $this->_from = 'FROM ' . $key . ' AS ' . $value;
            }
            else
            {
                $this->_from = 'FROM ' . $key;
            }
        }

        return $this;
    }

    /**
     * Where portion of Solace QB
     *
     * @param       $column
     * @param       $field
     * @return      $this
     */
    public function where($column, $field = false)
    {
        if ($field !== false)
        {
            //Encaps in single quotes
            $encapsField = '\'' . $field . '\'';

            $newWhere = str_replace('?', $encapsField, $column);

            $this->_where = 'WHERE ' . $newWhere;
        }

        return $this;
    }

    /**
     * And portion of Solace QB
     *
     * @param       $column
     * @param       $field
     * @return      $this
     */
    public function andWhere($column, $field)
    {
        //Encaps in single quotes
        $encapsField = '\'' . $field . '\'';

        $newWhere = str_replace('?', $encapsField, $column);

        $this->_andWhere = 'AND ' . $newWhere;

        return $this;
    }

    /**
     * Or Where portion of Solace QB
     *
     * @param       $column
     * @param       $field
     * @return      $this
     */
    public function orWhere($column, $field)
    {
        //Encaps in single quotes
        $encapsField = '\'' . $field . '\'';

        $newWhere = str_replace('?', $encapsField, $column);

        $this->_orWhere = 'OR ' . $newWhere;

        return $this;
    }

    /**
     * In portion of Solace QB
     *
     * @param $in
     * @return $this
     */
    public function in($in)
    {
        $this->_in = ' IN (' . $in . ')';
        return $this;
    }

    /**
     * Between portion of Solace QB
     *
     * @param $value1
     * @param $value2
     * @return $this
     */
    public function between($value1, $value2)
    {
        $this->_between = ' BETWEEN ' . $value1 . ' AND ' . $value2;
        return $this;
    }

    /**
     * Inner join portion of the Solace QB
     * @param       array $joinTable
     * @param       $joinColumn
     * @return      string
     */
    public function innerJoin(array $joinTable, $joinColumn)
    {
        foreach ($joinTable as $key => $value)
        {
            //Is an alias set?
            if ($value != '')
            {
                $joinTableSql = 'INNER JOIN ' . $key . ' AS ' . $value;
            }
            else
            {
                $joinTableSql = 'INNER JOIN ' . $value;
            }
        }

        $this->_innerJoin = $joinTableSql . ' ON ' . $joinColumn;

        return $this;
    }

    /**
     * Left join portion of Solace QB
     *
     * @param       array $joinTable
     * @param       $joinColumn
     * @return      $this
     */
    public function leftJoin(array $joinTable, $joinColumn)
    {
        foreach ($joinTable as $key => $value)
        {
            //Is an alias set?
            if ($value != '')
            {
                $joinTableSql = 'LEFT JOIN ' . $key . ' AS ' . $value;
            }
            else
            {
                $joinTableSql = 'LEFT JOIN ' . $value;
            }
        }

        $this->_leftJoin = $joinTableSql . ' ON ' . $joinColumn;

        return $this;
    }

    /**
     * Right join portion of Solace QB
     *
     * @param       array $joinTable
     * @param       $joinColumn
     * @return      $this
     */
    public function rightJoin(array $joinTable, $joinColumn)
    {
        foreach ($joinTable as $key => $value)
        {
            //Is an alias set?
            if ($value != '')
            {
                $joinTableSql = 'RIGHT JOIN ' . $key . ' AS ' . $value;
            }
            else
            {
                $joinTableSql = 'RIGHT JOIN ' . $value;
            }
        }

        $this->_rightJoin = $joinTableSql . ' ON ' . $joinColumn;

        return $this;
    }

    /**
     * Full Outer Join portion of Solace QB
     *
     * @param       array $joinTable
     * @param       $joinColumn
     * @return      $this
     */
    public function fullJoin(array $joinTable, $joinColumn)
    {
        foreach ($joinTable as $key => $value)
        {
            //Is an alias set?
            if ($value != '')
            {
                $joinTableSql = 'FULL OUTER JOIN ' . $key . ' AS ' . $value;
            }
            else
            {
                $joinTableSql = 'FULL OUTER JOIN ' . $value;
            }
        }

        $this->_fullJoin = $joinTableSql . ' ON ' . $joinColumn;

        return $this;
    }

    /**
     * Order By portion of Solace QB
     *
     * @param       $column
     * @param       $order
     * @return      $this
     */
    public function orderBy($column, $order)
    {
        $this->_orderBy = 'ORDER BY ' . $column . ' ' . $order;
        return $this;
    }

    /**
     * Like portion of Solace QB
     *
     * @param       $pattern
     * @return      $this
     */
    public function like($pattern)
    {
        $this->_like = ' LIKE ' . $pattern;
        return $this;
    }

    /**
     * Union portion of Solace QB
     *
     * @param       $columns1
     * @param       $table1
     * @param       $columns2
     * @param       $table2
     * @return      $this
     */
    public function union($columns1, $table1, $columns2, $table2)
    {
        $this->_union = 'SELECT ' . $columns1 . ' FROM ' . $table1 . ' UNION SELECT ' .
            $columns2 . ' FROM ' . $table2;
        return $this;
    }

    /**
     * Limit portion of Solace QB
     *
     * @param       $number
     * @return      $this
     */
    public function limit($number)
    {
        $this->_limit = 'LIMIT ' . $number;
        return $this;
    }

    public function groupBy($column)
    {
        $this->_groupBy = 'GROUP BY ' . $column;
        return $this;
    }


    /**
     * Insert a new record into the db
     *
     * @param       $data
     * @param       $tableName
     * @return      bool
     */
    public function insertRecord($data, $tableName)
    {
        //Values
        $values = '';
        foreach ($data as $value)
        {
            $values .= '' . $this->db->pdo->quote($value) . ', ';
        }
        $values = substr($values, 0, -2);

        //Columns
        $columns = '';
        foreach ($data as $key => $value)
        {
            $columns .= '`' . $key . '`, ';
        }

        $columns = substr($columns, 0, -2);

        $insertSql = $this->insert($tableName, $columns, $values);

        $query = $this->db->pdo->prepare($insertSql);
        $query->execute();

        return true;
    }

    /**
     * Insert into portion for Solace QB
     *
     * @param       $tableName
     * @param       $columns
     * @param       $values
     * @return      string
     */
    public function insert($tableName, $columns, $values)
    {
        return ('INSERT INTO `'. $tableName .'` (' . $columns . ') VALUES (' . $values. ');');
    }


    /**
     * Update a record into the db
     *
     * @param       $data
     * @param       $tableName
     * @param       $where
     * @return      bool
     */
    public function updateRecord($data, $tableName, $where)
    {
        //Columns and values
        $setSql = '';
        foreach ($data as $key => $value)
        {
            $setSql .= '`' . $key . '` = ' . $this->db->pdo->quote($value) . ', ';
        }

        $setSql = substr($setSql, 0, -2);

        $insertSql = $this->update($tableName, $setSql, $where);

        $query = $this->db->pdo->prepare($insertSql);

        $query->execute();

        return true;
    }


    /**
     * Update portion of the Solace QB
     *
     * @param       $tableName
     * @param       $setSql
     * @param       $where
     * @return      string
     */
    public function update($tableName, $setSql, $where)
    {
        return ('UPDATE `'. $tableName .'` SET ' . $setSql . ' WHERE `id` = \'' . $where . '\';');
    }


    /**
     * Find a row based on the PK.
     *
     * @param       $id
     * @param       null $table
     * @return      mixed
     */
    public function find($id, $table = null)
    {
        $sql = $this->select()
                    ->from(array('' . $table . '' => ''))
                    ->where('id = ?', $id);
        $query = $this->prepare($sql);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fetches all rows from a specified table
     *
     * @param       $table
     * @return      array
     */
    public function fetchAll($table)
    {
        $sql = $this->select()
                    ->from(array('' . $table . '' => ''));
        $query = $this->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete a record from the specified table
     *
     * @param       $id
     * @param       $table
     * @return      bool
     */
    public function delete($id, $table)
    {
        $sql = $this->db->pdo->prepare('DELETE FROM ' . $table . ' WHERE id = ' . $id);
        $sql->execute();
        return true;
    }

    /**
     * Get the last inserted ID in thd DB
     *
     * @param       null $seqname
     * @return      string
     */
    public function lastInsertId($seqname = NULL)
    {
        return $this->db->pdo->lastInsertId();
    }

    /**
     * Because Solace returns an object, we need to convert this into a string
     * before we pass it through to PDO
     *
     * @param       object $sql
     * @param       null $options
     * @return      PDOStatement|void
     */
    final public function prepare($sql, $options = null)
    {
        $preparedSql = array();
        //echo '<pre>'; var_dump($sql); die();

        // If the passed sql is not an array or object then we discard it
        if (is_object($sql))
        {
            foreach ($sql as $stmt)
            {
                if (!is_array($stmt) && $stmt != null)
                {
                    $preparedSql[] = $stmt;
                }
            }
        }
        else
        {
            return false;
        }

        // Pop the object off the end of the array
        array_pop($preparedSql);

        // Turn the remaining array elements into one long string
        $preparedSql = implode(' ', $preparedSql);

        // Trim the whitespace off the end
        $preparedSql = rtrim($preparedSql);

        // If the calling method skips over its model then $this->pdo is not set
        // but $this->db->pdo is
        if (isset($this->db->pdo))
        {
            return $this->db->pdo->prepare($preparedSql);
        }
        else
        {
            return $this->pdo->prepare($preparedSql);
        }
    }

    /**
     * Function for raw SQL queries
     *
     * @param       $sql
     * @return      PDOStatement
     */
    public function rawSql($sql)
    {
        return $this->pdo->prepare($sql);
    }

    /**
     * Drop a table
     *
     * @param       $table
     * @return      $this
     */
    public function dropTable($table)
    {
        $this->_dropTable = 'DROP TABLE ' . $table;
        return $this;
    }

    /**
     * Drop an index
     *
     * @param $table
     * @param $index
     * @return $this
     */
    public function dropIndex($table, $index)
    {
        $this->_dropIndex = 'ALTER TABLE ' . $table . ' DROP INDEX ' . $index;
        return $this;
    }

    /**
     * Drop a database
     *
     * @param $database
     * @return $this
     */
    public function dropDatabase($database)
    {
        $this->_dropDatabase = 'DROP DATABASE ' . $database;
        return $this;
    }

    /**
     * Truncate a table
     *
     * @param $table
     * @return $this
     */
    public function truncateTable($table)
    {
        $this->_truncateTable = 'TRUNCATE TABLE ' . $table;
        return $this;
    }

    /**
     * Add a column to a table
     *
     * @param $table
     * @param $column
     * @param $datatype
     * @return $this
     */
    public function addColumn($table, $column, $datatype)
    {
        $this->_addColumn = 'ALTER TABLE ' . $table . 'ADD ' . $column . ' ' . $datatype;
        return $this;
    }

    /**
     * Drop a column from a table
     *
     * @param $table
     * @param $column
     * @return $this
     */
    public function dropColumn($table, $column)
    {
        $this->_dropColumn = 'ALTER TABLE ' . $table . ' DROP COLUMN ' . $column;
        return $this;
    }

    /**
     * Modify a table column
     *
     * @param $table
     * @param $column
     * @param $datatype
     */
    public function modifyColumn($table, $column, $datatype)
    {
        $this->_modifyColumn = 'ALTER TABLE ' . $table . ' MODIFY COLUMN ' . $column . ' ' . $datatype;
    }

    /**
     * Set the auto increment of a PK
     *
     * @param $table
     * @param $increment
     * @return $this
     */
    public function setAutoIncrement($table, $increment)
    {
        $this->_autoIncrement = 'ALTER TABLE ' . $table . ' AUTO_INCREMENT=' . $increment;
        return $this;
    }

    /**
     * Create a table
     *
     * @param $table
     * @return $this
     */
    public function createTable($table)
    {
        $this->_createTable = 'CREATE TABLE ' . $table;
        return $this;
    }

    /**
     * Function to insert current time into field
     *
     * @return bool|string
     */
    public function NOW()
    {
        return (date("Y-m-d H:i:s"));
    }


    /**
     * Reset the QB values
     * This function is needed to instantiate multiple objects in the same function, alternatively
     * Write one, query the database, save to controller var, reset object, repeat
     */
    protected function reset_values()
    {
        $this->_select      = null;
        $this->_distinct    = null;
        $this->_from        = null;
        $this->_where       = null;
        $this->_andWhere    = null;
        $this->_orWhere     = null;
        $this->_in          = null;
        $this->_between     = null;
        $this->_innerJoin   = null;
        $this->_leftJoin    = null;
        $this->_rightJoin   = null;
        $this->_orderBy     = null;
        $this->_like        = null;
        $this->_limit       = null;
        $this->_union       = null;
    }

}