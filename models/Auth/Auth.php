<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Auth extends GoBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Login function
     * @param $email
     * @param $password
     * @return bool
     */
    public function login($email, $password)
    {
        $sql = $this->db->prepare('SELECT id FROM user WHERE email = :email AND password = :password');

        $sql->execute(array (
            ':email' => $email,
            ':password' => $password,
        ));

        if ($sql->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getSecurityQuestionByEmail($email)
    {
        $sql = $this->db->prepare('SELECT sq.question FROM user AS u INNER JOIN security_question AS sq
        ON u.security_question_id = sq.id
        WHERE email = :email');

        $sql->execute(array (
            ':email' => $email,
        ));

        $data = $sql->fetchAll();
        return $data;
    }

    public function checkAnswer($answer)
    {
        $sql = $this->db->prepare('SELECT * FROM user AS u WHERE security_question_answer = :answer');

        $sql->execute(array (
            ':answer' => $answer,
        ));

        if ($sql->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Testing for gORM
     * @return string
     */
    public function test()
    {
        $sql = $this->select();
        $sql .= $this->from(array('u' => 'user'), array('u.id', 'u.first_name'));
        $sql .= $this->innerJoin(array('a' => 'address'), 'u.address_id = a.address.id');
        $sql .= $this->where('u.id = ' . 1);
        echo '<pre>'; var_dump($sql); die();
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll();

        return $sql;
    }
}