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
    .jumbotron {
        background: #DDDDDD;
    }

    .text-decoration-none:hover {
        color: blue;
    }
    .fsize{
        font-size: smaller;
        font-weight: 600;
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
        $th_title = $_POST['title'];
        $th_title = str_replace("<","&lt",$th_title);
        $th_title = str_replace(">","&gt",$th_title);

        $th_desc = $_POST['desc'];
        $th_desc = str_replace("<","&lt",$th_desc);
        $th_desc = str_replace(">","&gt",$th_desc);

        $id = $_GET['catid'];
        $uid = $_POST['uno'];


        $ins_sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$uid', current_timestamp())";

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

    <div class="container my-4">

        <!-- this block of code is for displaying category and its description -->
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE `category_id` = $id";
        $result =mysqli_query($conn,$sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_desc'];
        $catdate = $row['created'];
    
        // jumbotron will go here 
        echo
        '<div class="jumbotron border border-ligh p-4 shadow-sm rounded">
            <h1 class="display-4">Welcome to ' . $catname .'  Forum</h1>
            <p class="lead">'.$catdesc.'</p>
            <hr class="my-4">
            <p> No Spam / Advertising / Self-promotion is allowed in the forum.
                not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Remain respectful of other members at all times.</p>
                Posted By: <b>harry</b> on '.$catdate.'
            <!--<p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">View Thread</a>
            </p>-->
        </div>';
    }
    
        ?>
        

        <div class="container my-4 rounded shadow-sm p-3">
            <h2>Ask a Question</h2>
            <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION['loggedin']==true) {
            echo '
            <form action="'.$_SERVER['REQUEST_URI'] . '" method="POST" >
                <div class="mb-3">
                    <label for="title" class="form-label mt-4"><b> Thread Title</b></label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label"><b>Thread Description </b> </label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <input type="hidden" name="uno" value="'.$_SESSION["sno"].'" >
                <button type="submit" class="btn btn-success px-4">Post</button>
            </form>';
            }
            else{
                echo '
                <p class="lead "><b>To ask a question please login first</b></p>
                ';
            }

            ?>

        </div>



        <!-- browse question section will go here -->
        <div class="container my-4">
            <h2>Browse Questions</h2>
            <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id";
            $result =mysqli_query($conn,$sql);
            $noresult = true;

                while ($row = mysqli_fetch_assoc($result)) {
                    $thread_id = $row['thread_id'];
                    $thread_title = $row['thread_title'];
                    $thread_desc = $row['thread_desc'];
                    $thread_user_id = $row['thread_user_id'];
                    $thread_date = $row['timestamp'];
                    $noresult=false;

                    $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                    $result2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    
                    echo '
                        <div class=" border my-2 border-light rounded-2 p-2 shadow-sm">
                        <div class="media d-flex ">
                            <img src="imgs/user.png" width="40" class="bi bi-person-check-fill m-3" viewBox="0 0 16 16" alt="...">
                            <div class="media-body ">
                            <h5 class="mt-0"> <a href="threads.php?threadid='.$thread_id.'" class="text-decoration-none"> ' .$thread_title . '</a></h5>
                            '.$thread_desc.'
                            </div>
                            </div>
                            <p class="text-end fsize m-0 p-0">Posted by : '.$row2["user_email"].' on '.$thread_date.'</p>
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