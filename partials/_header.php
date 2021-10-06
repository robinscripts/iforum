<!-- included signup and login modals -->
<?php include '_loginmodal.php'; ?>

<?php

session_start();

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/phpprojects/iforum/about.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/phpprojects/iforum/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/phpprojects/iforum/about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

            $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
            $result = mysqli_query($conn, $sql); 
             while($row = mysqli_fetch_assoc($result)){
               echo '<li><a class="dropdown-item" href="/phpprojects/iforum/threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
                  
              }



          echo '
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/phpprojects/iforum/contact.php">Contact</a>
        </li>
      </ul>
      <div class="d-flex mx-2">';

      if (isset($_SESSION["loggedin"]) && $_SESSION['loggedin']==true) {
        echo '<form class="d-flex " method="get" action="/phpprojects/iforum/partials/_search.php">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
          <p class="text-light my-0 mx-2">Welcome '. $_SESSION['useremail']. ' </p>
          <a href="/phpprojects/iforum/partials/_logouthandler.php" class="mx-1 btn btn-outline-primary">Logout</a>
        </form>';
      }
      else{
        echo '
        <form class="d-flex " method="get" action="/phpprojects/iforum/partials/_search.php">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
          </form>
        
        
        <button class=" mx-2 btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginmodal" >Log in</button>
        <button class=" mx-1 btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupmodal" >Sign Up</button>';
      }
      echo '
      </div>

</div>
</div>
</nav>';

?>


<?php
   include '_signupmodal.php'; 
  if (isset($_GET["signupsuccess"]) && $_GET["signupsuccess"]=="true") {
    echo '
          <div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
          <strong>Suceess!</strong> You can login now safily
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  // else {
  //   echo '
  //         <div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
  //         <strong>Error!</strong> '.$_GET["error"].'
  //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  //         </div>';
  // }
  
  ?>