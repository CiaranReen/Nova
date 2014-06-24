<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Topics extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function getTopics($courseId)
    {
        $sql = $this->db->select()
            ->from(array('course_topic' => 'ct'))
            ->innerJoin(array('topic' => 't'), 'ct.topic_id = t.id')
            ->where('ct.course_id = ?', $courseId);
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getCommentsByTopicId($topicId)
    {
        $sql = $this->db->select()
            ->from(array('comment' => 'c'))
            ->innerJoin(array('user' => 'u'), 'c.user_id = u.id')
            ->where('c.topic_id = ?', $topicId)
            ->andWhere('c.parent = ?', 0);
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getChildComments($commentId)
    {
        $sql = $this->db->select()
            ->from(array('comment' => 'c'))
            ->innerJoin(array('user' => 'u'), 'c.user_id = u.id')
            ->where('c.parent = ?', $commentId);

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getCodePassQuestionsByTopicId($topicId)
    {
        $sql = $this->db->select()
            ->from(array('test_question' => 'tq'))
            ->innerJoin(array('topic' => 't'), 'tq.topic_id = t.id')
            ->innerJoin(array('badge' => 'b'), 'tq.topic_id = b.topic_id')
            ->where('topic_id = ?', $topicId);
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function checkResults($questionId, $answer)
    {
        /*$sql = $this->db->rawSql("SELECT * FROM test_question
        WHERE id = :questionid AND correct_answer = :answer");*/

        $sql = $this->db->select()
            ->from(array('test_question' => ''))
            ->where('id = ?', $questionId)
            ->andWhere('correct_answer = ?', $answer);
        //echo '<pre>'; var_dump($sql); die();

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

    public function getBadge($topicId)
    {
        $sql = $this->db->select()
            ->from(array('badge' => ''))
            ->where('topic_id = ?', $topicId);
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetch();
    }
}