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
</head>

<body>
    <!-- connecting to database -->
    <?php require 'partials/_dbconnect.php'?>
    <!-- inserting header file -->
    <?php require 'partials/_header.php'?>




    <!-- The following block is for slider images i.e crousal -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/240x70/?apple,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/240x70/?programming,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/240x70/?discussion,coding" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- This is the main body  container -->
    <div class="container my-4">
        <h1 class="text-center my-4">iDiscuss - Categories</h1>

        <div class="row">

            <!-- Fetch all the categories from database and use the loop to iterate through them -->
            <?php
                $fetchsql = 'SELECT * FROM `categories`';
                $fetchresult = mysqli_query($conn,$fetchsql);
                while ($row=mysqli_fetch_assoc($fetchresult)) {
                    $id = $row['category_id'];
                    $cat = $row['category_name'];
                    $desc = $row['category_desc'];
                    
                    
                    echo
                        '<div class="col-md-4 my-3">
                            <div class="card" style="width: 18rem;">
                                <img src="https://source.unsplash.com/160x90/?coding,' . $cat . '" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href=" threadlist.php?catid=' . $id . '" class="text-decoration-none">' . $cat . '</a></h5>
                                    <p class="card-text"> ' . substr($desc,0,90) . '...</p>
                                    <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">View Thread</a>
                                </div>
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