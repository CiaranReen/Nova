<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Topics extends GoBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function getTopics($courseId)
    {
        $sql = $this->db->prepare("SELECT * FROM course_topic as ct
        INNER JOIN topic as t ON ct.topic_id = t.id
        WHERE ct.course_id = :courseId");

        $sql->execute(array (
            ':courseId' => $courseId
        ));

        return $sql->fetchAll();
    }

    public function getCommentsByTopicId($topicId)
    {
        $sql = $this->db->prepare("SELECT * FROM comment AS c
        INNER JOIN user AS u ON c.user_id = u.id
        WHERE c.topic_id = :topicid
        AND c.parent = 0");

        $sql->execute(array (
            ':topicid' => $topicId,
        ));

        return $sql->fetchAll();
    }

    public function getChildComments($commentId)
    {
        $sql = $this->db->prepare("SELECT * FROM comment as c
        INNER JOIN user AS u ON c.user_id = u.id
        WHERE c.parent = :parent");

        $sql->execute(array (
            ':parent' => $commentId
        ));

        return $sql->fetchAll();
    }

    public function getCodePassQuestionsByTopicId($topicId)
    {
        $sql = $this->db->prepare("SELECT * FROM test_question AS tq
        INNER JOIN topic AS t ON tq.topic_id = t.id
        WHERE topic_id = :topicid");

        $sql->execute(array (
            ':topicid' => $topicId
        ));

        return $sql->fetchAll();
    }

    public function checkResults($questionId, $answer)
    {
        $sql = $this->db->prepare("SELECT * FROM test_question
        WHERE id = :questionid AND correct_answer = :answer");

        $sql->execute(array (
            ':questionid' => $questionId,
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

    public function getBadge($topicId)
    {
        $sql = $this->db->prepare("SELECT * FROM badge
        WHERE topic_id = :topicid");

        $sql->execute(array (
            ':topicid' => $topicId
        ));

        return $sql->fetchAll();
    }
}