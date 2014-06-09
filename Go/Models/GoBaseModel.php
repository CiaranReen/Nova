<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:01
 */

class GoBaseModel extends GoDatabase {

    /**
     * Construct the Database object for use with all child models
     */
    public function __construct()
    {
        $this->db = new GoDatabase();
    }

    /**
     * Find a row based on the PK.
     * @param $id
     * @param null $table
     * @return mixed
     */
    public function find($id, $table = null)
    {
        $sql = $this->db->prepare('SELECT * FROM ' . $table . ' WHERE id = :id');
        $sql->execute(array (
            ':id' => $id,
        ));

        $resultSet = $sql->fetch();
        return $resultSet;
    }

    /**
     * INSERT a new record into the db
     * @param $data
     * @param $tableName
     * @return bool
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

        $query = $this->db->prepare($insertSql);
        $query->execute();

        return true;
    }

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

        $query = $this->db->prepare($insertSql);
        $query->execute();

        return true;
    }

    /**
     * SELECT clause for gORM Query Handler. This simply returns a SELECT string but is nonetheless needed to keep the way this system
     * works consistent across the framework.
     * @return string
     */
    public function select()
    {
        return('SELECT ');
    }

    /**
     * Construct the FROM DB clause for the gORM Query Handler
     * @param array $tableName
     * @param array $columns
     * @return string
     */
    public function from(array $tableName, array $columns)
    {
        foreach ($tableName as $key => $value)
        {
            $tableSql = $value . ' AS ' . $key;
        }

        $columnSql = '';
        foreach ($columns as $column)
        {
            $columnSql .= $column . ', ';
        }

        $columnSql = substr($columnSql, 0, -2);

        $fromSql = $columnSql . ' FROM ' . $tableSql;

        return $fromSql;
    }

    /**
     * INNER JOIN clause for the gORM Query Handler
     * @param array $joinTable
     * @param $joinColumn
     * @return string
     */
    public function innerJoin(array $joinTable, $joinColumn)
    {
        foreach ($joinTable as $key => $value)
        {
            $joinTableSql = ' INNER JOIN ' . $value . ' AS ' . $key;
        }

        $innerJoinSql = $joinTableSql . ' ON ' . $joinColumn;

        return $innerJoinSql;
    }

    /**
     * WHERE clause for the gORM Query Handler
     * @param $where
     * @return string
     */
    public function where($where)
    {
        $whereSql = ' WHERE ' . $where;

        return $whereSql;
    }

    /**
     * AND WHERE clause for the gORM Query Handler
     * @param $andWhere
     * @return string
     */
    public function andWhere($andWhere)
    {
        $andWhereSql = ' AND WHERE ' . $andWhere;

        return $andWhereSql;
    }

    /**
     * INSERT INTO clause for the gORM Query Handler
     * @param $tableName
     * @param $columns
     * @param $values
     * @return string
     */
    public function insert($tableName, $columns, $values)
    {
        return ('INSERT INTO `'. $tableName .'` (' . $columns . ') VALUES (' . $values. ');');
    }

    /**
     * UPDATE clause for the gORM Query Handler
     * @param $tableName
     * @param $setSql
     * @param $where
     * @return string
     */
    public function update($tableName, $setSql, $where)
    {
        return ('UPDATE `'. $tableName .'` SET ' . $setSql . ' WHERE `id` = \'' . $where . '\';');
    }

    /**
     * Sha1 encryption for passwords
     * @param $password
     * @return string
     */
    public function sha1PasswordHash($password)
    {
        $hashedPassword = sha1($password);
        return $hashedPassword;
    }

    public function sha1SaltPasswordHash()
    {

    }

    public function bCryptPasswordHash()
    {

    }

    /**
     * Fetches all rows from a specified table
     * @param $tableName
     * @return array
     */
    final public function fetchAll($tableName)
    {
        $sql = $this->db->query('SELECT * FROM ' . $tableName);

        $data = $sql->fetchAll();
        return $data;
    }

    public function delete($id, $tableName)
    {
        $sql = $this->db->prepare('DELETE FROM ' . $tableName . ' WHERE id = ' . $id);
        $sql->execute();
        return true;
    }

}