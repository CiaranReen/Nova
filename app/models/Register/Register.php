<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Register extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return all security questions
     * @return array
     */
    public function getSecurityQuestions()
    {
        return $this->fetchAll('security_question');
    }

    /**
     * Check for any matching email address to the one entered
     * @param $email
     * @return array
     */
    public function checkEmailExists($email)
    {
        $sql = $this->db->prepare('SELECT * FROM user WHERE email = :email');
        $sql->execute(array(
            ':email' => $email,
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

}