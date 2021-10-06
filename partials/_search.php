<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <style>
            .size{
                min-height:83vh;
            }
            .bg{
                background-color : #FFBABA;
            }
        </style>

    <title>Welcome to iDiscuss - coding forum</title>
</head>

<body>
    <!-- connecting to database -->
    <?php require '_dbconnect.php'?>
    <!-- inserting header file -->
    <?php require '_header.php'?>



    <div class="container size my-4">
    <?php

        $query = $_GET['search'];

        echo '<h1 class="text-center my-4">Your Search Result for <em> "'.$query.'"</em></h1>';

        

        $noresults = true;
        $searchsql = "SELECT * FROM threads WHERE MATCH(thread_title, thread_desc) AGAINST ('$query')";
        $result = mysqli_query($conn, $searchsql);

        while($row = mysqli_fetch_assoc($result)){
            $thread_id= $row['thread_id'];
            // $url = "thread.php?threadid=". $thread_id;
            $noresults = false;

            // Display the search result
            echo '<div class=" border my-2 border-light rounded-2 p-2 shadow-sm">
                <div class="media d-flex ">
                    <div class="media-body ">
                        <h5 class="mt-0"> <a href="/phpprojects/iforum/threads.php?threadid="'.$thread_id.'class="text-decoration-none"> '.$row['thread_title'].' </a>
                        </h5>
                        '.$row['thread_desc'].'
                    </div>
                </div>
            </div>';
        }

        if ($noresults) {

            echo '<div class=" border bg my-2 border-light rounded-2 p-2 shadow-sm">
            
                    <p class="display-4">No Results Found</p>
                    <p class="lead"> Suggestions: <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords. </li></ul>
                    </p>
            
        </div>';



            
        }









        ?>

    </div>











    <?php require '_footer.php'?>

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