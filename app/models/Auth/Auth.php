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
        $sql = $this->select('sq.question')
            ->from(array('user' => 'u'))
            ->innerJoin(array('security_question' => 'sq'), 'u.security_question_id = sq.id')
            ->where('email = ?', $email);

        $query = $this->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function checkAnswer($answer)
    {
        $sql = $this->select()
            ->from(array('user' => 'u'))
            ->where('security_question_answer = ?', $answer);

        $query = $this->prepare($sql);
        $query->execute();

        if ($query->rowCount() > 0)
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