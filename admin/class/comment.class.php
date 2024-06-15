<?php

class Comment
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
        if ($this->conn->connect_error) {
            die('Connection Failed!! ' . $this->conn->connect_error);
        }
    }

    public function submitComment($userId, $postId, $comment, $parentCommentId = 0)
    {
        $sql = "INSERT INTO comment (post_id, user_id, parent_id, comment, created) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('iiis', $postId, $userId, $parentCommentId, $comment);

        $success = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $success;
    }



    public function getComment($postId, $parentCommentId = 0)
    {
        $sql = "SELECT c.*, u.username FROM comment c JOIN users u ON c.user_id = u.id WHERE post_id = ? AND parent_id = ? ORDER BY id DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $postId, $parentCommentId);
        $stmt->execute();
        $result = $stmt->get_result();

        $comments = array();
        while ($row = $result->fetch_assoc()) {
            $row['replies'] = $this->getComment($postId, $row['id']); // Recursive call to fetch replies
            $comments[] = $row; // Append each comment to the $comments array
        }
        if($comments){
            return $comments;
        }else{
            return false;
        }
    }
}
