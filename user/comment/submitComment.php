 <?php

    // Check if the request method is POST
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     // Include the Comment class
        include('../../admin/class/comment.class.php');

    //     // Create a new instance of the Comment class
        $comment = new Comment();

    //     // Get the comment data from the POST request
    //     $parent_id = $_POST['parent_id'];
    //     $post_id = $_POST['post_id'];
    //     $user_id = $_POST['user_id'];
    //     $commentText = $_POST['comment'];
    //     // echo $comment_id;
    //     // echo $user_id;
    //     // echo $commentText;
    //     // echo $post_id;

    //     // Check if the comment text is not empty
    //     if (!empty($commentText)) {
    //         // Submit the comment to the database
    //         $success = $comment->submitComment($user_id, $post_id , $commentText, $parent_id);

    //         // Check if the comment was successfully submitted
    //         if ($success) {
    //             // Respond with success message
    //             echo json_encode(["success" => true, "message" => "Comment inserted successfully"]);
    //         } else {
    //             // Respond with error message if comment insertion failed
    //             echo json_encode(["success" => false, "message" => "Failed to insert comment"]);
    //         }
    //     } else {
    //         // Respond with error message if comment text is empty
    //         echo json_encode(["success" => false, "message" => "Comment text is empty"]);
    //     }
    // } else {
    //     // Respond with error message if request method is not POST
    //     echo json_encode(["success" => false, "message" => "Invalid request method"]);
    // }

    // if (isset($_POST["post_id"])) {
    //     $data = [
    //         "parent_id" => $_POST['parent_id'],
    //         "post_id" => $_POST['post_id'],
    //         "user_id" => $_POST['user_id'],
    //         "commentText" => $_POST['comment']
    //     ];

    //     header('Content-Type: application/json; charset=UTF-8');
    //     echo json_encode($data);
    //     exit;
    // }

    // header("HTTP/1.0 400 Bad Request");
    // echo json_encode(['status' => 'error', 'message' => 'Data not received.']);

    // exit;






    // Assuming you have already connected to your database

    // Get the comment data from the POST request
    // $comment = $_POST['comment'];
    // $comment_id = $_POST['comment_id'];
    // $post_id = $_POST['post_id'];
    // $user_id = $_POST['user_id'];

    // // Insert the comment data into the database
    // // You should use prepared statements to prevent SQL injection
    // // Assuming you have a table named 'comments' with appropriate columns

    // // $stmt = $pdo->prepare("INSERT INTO comments (comment, comment_id, post_id, user_id) VALUES (?, ?, ?, ?)");
    // // $stmt->execute([$comment, $comment_id, $post_id, $user_id]);
    // // Respond with success message
    // echo json_encode(["success" => true, "message" => "Comment inserted successfully"]);
    // // } else {
    //     // Respond with error message if request method is not POST
    //     echo json_encode(["success" => false, "message" => "Invalid request method"]);
    // }

    if (isset($_POST["post_id"])) {
        $user_id = filter_input(INPUT_POST, "user_id", FILTER_SANITIZE_NUMBER_INT);
        $post_id = filter_input(INPUT_POST, "post_id", FILTER_SANITIZE_NUMBER_INT);
        $parent_id = filter_input(INPUT_POST, "parent_id", FILTER_SANITIZE_NUMBER_INT);
        $commentText = filter_input(INPUT_POST, "commentText");

        if (!$user_id ) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(["status" => "error", "message" => "Log in to comment"]);
            exit;
        }else{
            if(!$commentText){
                header("HTTP/1.0 400 Bad Request");
                echo json_encode(["status" => "error", "message" => "Empty comment!!"]);
                exit;
            }
        }

        $data = [
            "successMsg" => 'comment Successful'
        ];
        $result = $comment->submitComment($user_id, $post_id, $commentText,$parent_id );
        if($result){
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode($data);
        }
        exit;
    }

    header("HTTP/1.0 400 Bad Request");
    echo json_encode(["status" => "error", "message" => "post_id is missing"]);
    exit;

    ?>