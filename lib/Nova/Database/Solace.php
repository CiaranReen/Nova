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
     * @var
     */
    protected $_select;

    /**
     * @var
     */
    protected $_from;

    /**
     * @var
     */
    protected $_where;

    /**
     * @var
     */
    protected $_andWhere;

    /**
     * @var
     */
    protected $_innerJoin;

    /**
     * @var
     */
    protected $query;

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
    function select($fields = '*')
    {
        $this->_select = "SELECT " . $fields;
        return $this;
    }

    /**
     * From portion of Solace QB
     *
     * @param       array $table
     * @return      $this
     */
    function from($table = array())
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
     * @param $column
     * @param $field
     * @return $this
     */
    function where($column, $field)
    {
        //Encaps in single quotes
        $encapsField = '\'' . $field . '\'';

        $newWhere = str_replace('?', $encapsField, $column);

        $this->_where = 'WHERE ' . $newWhere;

        return $this;
    }

    /**
     * And portion of Solace QB
     *
     * @param       $column
     * @param       $field
     * @return      $this
     */
    function andWhere($column, $field)
    {
        //Encaps in single quotes
        $encapsField = '\'' . $field . '\'';

        $newWhere = str_replace('?', $encapsField, $column);

        $this->_andWhere = 'AND ' . $newWhere;

        return $this;
    }

    /**
     * Inner join portion of the Solace Query Handler
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
                $joinTableSql = ' INNER JOIN ' . $value . ' AS ' . $key;
            }
            else
            {
                $joinTableSql = ' INNER JOIN ' . $value;
            }
        }

        $this->_innerJoin = $joinTableSql . ' ON ' . $joinColumn;

        return $this;
    }


    /**
     * Insert a new record into the db
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
            $values .= '\'' . $value . '\', ';
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

        $query = $this->pdo->prepare($insertSql);
        $query->execute();

        return true;
    }

    /**
     * Insert into portion for Solace QB
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
            $setSql .= '`' . $key . '` = \'' . $value . '\', ';
        }

        $setSql = substr($setSql, 0, -2);

        $insertSql = $this->update($tableName, $setSql, $where);

        $query = $this->pdo->prepare($insertSql);
        $query->execute();

        return true;
    }


    /**
     * Update portion of the Solace QB
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

        return $query->fetch();
    }

    /**
     * Fetches all rows from a specified table
     * @param       $table
     * @return      array
     */
    final public function fetchAll($table)
    {
        $sql = $this->select()
                    ->from(array('' . $table . '' => ''));

        $query = $this->prepare($sql);

        return $query->fetchAll();
    }

    /**
     * Delete a record from the specified table
     * @param       $id
     * @param       $table
     * @return      bool
     */
    public function delete($id, $table)
    {
        $sql = $this->pdo->prepare('DELETE FROM ' . $table . ' WHERE id = ' . $id);
        $sql->execute();
        return true;
    }

    /**
     * @param       null $seqname
     * @return      string
     */
    public function lastInsertId($seqname = NULL)
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Because Solace returns an object, we need to convert this into a string
     * before we pass it through to PDO
     *
     * @param       object $sql
     * @param       null $options
     * @return      PDOStatement|void
     */
    final function prepare($sql, $options = null)
    {
        $preparedSql = array();

        // If the passed sql is not an array or object then we discard it
        if (is_object($sql))
        {
            foreach ($sql as $stmt)
            {
                $preparedSql[] = $stmt;
            }

        }
        else
        {
            return false;
        }

        // Pop the objects off the end of the array
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
     * @param $sql
     * @return PDOStatement
     */
    public function rawSql($sql)
    {
        return $this->pdo->prepare($sql);
    }

}