<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Auth extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Login function
     * @param $email
     * @return bool
     */
    public function login($email)
    {
        $sql = $this->select()
                    ->from(array('user' => 'u'))
                    ->where('email = ?', $email);

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetch();
    }

    public function getUserPasswordByEmail($email)
    {
        $sql = $this->select('password')
            ->from(array('user' => 'u'))
            ->where('email = ?', $email);

        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetch();

        return $data['password'];
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
     * Testing for Solace
     * @return string
     */
    public function test()
    {
        $id = '7';
        $sql = $this->select('name, id, description')
                    ->from(array('course' => 'c'))
                    ->where('id = ?' . $id);

        echo '<pre>'; var_dump($sql); die();
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}