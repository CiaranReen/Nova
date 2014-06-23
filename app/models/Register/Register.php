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
        $sql = $this->select()
            ->from(array('user' => 'u'))
            ->where('email = ?', $email);
        $query = $this->db->prepare($sql);
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

}