<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Welcome to iDiscuss - coding forum</title>
    <style>
    #main {
        min-height: 90vh;
    }

    .jumbotron {
        background: #DDDDDD;
    }

    .text-decoration-none:hover {
        color: blue;
    }
    </style>
</head>

<body>

    <!-- connecting to database -->
    <?php require 'partials/_dbconnect.php'?>

    <!-- inserting header file -->
    <?php require 'partials/_header.php'?>

    <!-- php script to add questions into database -->
    <?php

    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {

        // insert thread into thread table i.e db
        $showalert = true;
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt",$comment);
        $comment = str_replace(">","&gt",$comment);
        $id = $_GET['threadid'];
        $uid = $_POST['uno'];


        $ins_sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$uid', current_timestamp())";

        $result = mysqli_query($conn,$ins_sql);
    }

    if ($showalert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Success! </strong> Your question has been posted wait for community to reply.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
    }

    
    ?>




    <!-- main container of the threadlist -->

    <div class="container my-4" id="main">

        <!-- this block of code is for displaying category and its description -->
        <?php
                $thread_id = $_GET['threadid'];
                $sql = "SELECT * FROM `threads` WHERE `thread_id` = $thread_id";
                $result =mysqli_query($conn,$sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $user_id = $row['thread_user_id'];

                    // Query the users table to find out the name of OP
                    $sql2 = "SELECT user_email FROM `users` WHERE sno='$user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $posted_by = $row2['user_email'];

                    // jumbotron will go here 
                    echo
                    '<div class="jumbotron border border-ligh p-4 shadow-sm rounded">
                        <h3 class="display-7">' . $title .'</h3>
                        <p class="lead my-3">'.$desc.'</p>
                        <hr class="my-4">
                        <p> No Spam / Advertising / Self-promotion is allowed in the forum.
                            not post copyright-infringing material.
                            Do not post “offensive” posts, links or images.
                            Remain respectful of other members at all times.</p>
                        <p class="lead">
                        <p>Posted by: <b><em>'.$posted_by.'</em></b></p>
                        </p>
                    </div>';
                }
        ?>

        <!-- comment box -->

        <div class="container my-4 rounded shadow-sm  p-3">
            <!-- <form action="<?php //echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                <div class="mb-3">
                    <label for="comment" class="form-label"><b>
                            <h5>Write a comment</h5>
                        </b> </label>
                    <textarea class="form-control" id="comment" name="comment" rows="2"></textarea>
                </div>

                <button type="submit" class="btn btn-success px-4">Post Comment</button>
            </form> -->
            <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION['loggedin']==true) {
            echo '
                    <form action="'. $_SERVER['REQUEST_URI'] . '" method="POST">
                    <div class="mb-3">
                        <label for="comment" class="form-label"><b>
                                <h5>Write a comment</h5>
                            </b> </label>
                        <textarea class="form-control" id="comment" name="comment" rows="2"></textarea>
                    </div>
                    <input type="hidden" name="uno" value="'.$_SESSION["sno"].'" >

                    <button type="submit" class="btn btn-success px-4">Post Comment</button>
                </form>
            ';
            }
            else{
                echo '
                <p class="lead "><b>To post comment please login first</b></p>
                ';
            }

        ?>
        </div>

        <!-- discussion ahead -->

        <div class="container my-4">
            <h2>Discussion</h2>
            <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE `thread_id` = $id";
            $result =mysqli_query($conn,$sql);
            $noresult = true;

                while ($row = mysqli_fetch_assoc($result)) {
                    $comment_id = $row['comment_id'];
                    $comment_content = $row['comment_content'];
                    $comment_by = $row['comment_by'];
                    $comment_time = $row['comment_time'];
                    $noresult=false;

                    $sql2 = "SELECT user_email FROM `users` WHERE sno='$comment_by'";
                    $result2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    
                    echo '
                        <div class="border border-light rounded-2 my-2 shadow-sm">
                            <div class="media d-flex">
                                <img src="imgs/user.png" width="40" class="bi bi-person-check-fill m-3" viewBox="0 0 16 16" alt="...">
                                <div class="media-body m-2 ">
                                    '.$comment_content.'
                                </div>
                            </div>
                            <p class="text-end fsize mb-2 px-2">Posted by : '.$row2["user_email"].' on '.$comment_time.'</p>
                        </div>';
                }

                if ($noresult) {
                    echo '
                        <div class="card bg-light rounded-2 shadow-sm">
                            <div class="card-body">
                            Be the first to comment:)
                            </div>
                        </div>';
                }
        
            ?>
        </div>


    </div>





    <?php require 'partials/_footer.php'?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>