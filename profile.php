<?php

include "includes/header.php";
include "includes/db.php";

?>

<?php
if (isset($_POST['update_profile'])) {

    $the_user_id = $_SESSION['id'];

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

/*     if (empty($post_image)) {

        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {

            $post_image = $row['user_image'];
        }
    } */

    $query = "UPDATE users SET ";
    $query .= "username  = '{$username}', ";
    $query .= "user_firstname = '{$firstname}', ";
    $query .= "user_email = '{$email}', ";
    $query .= "user_lastname = '{$lastname}' WHERE user_id = {$the_user_id}";
    //$query .= "user_image  = '{$post_image}' ";
    $update_query = mysqli_query($connection, $query);


    if (!$update_query) {
        die("Query failed" . mysqli_error($connection));
    }
    header("Location: logout.php");
}

?>



<!-- Navigation -->
<?php include "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">

  <div class="row">
    <!--Sidebar-->
    <?php
    //include "includes/sidebar.php";
    ?>
      <!-- /.col-lg-3 -->
        <div class="col-lg-9">
              <div class="row">

            <?php
            $the_user_id = $_SESSION['id'];

            $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
            $select_user_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_user_id)) {

                $username = $row["username"];
                $user_firstname = $row["user_firstname"];
                $user_lastname = $row["user_lastname"];
                $user_email = $row["user_email"];
                //$user_image = $row["user_image"];
                $user_role = $row["user_role"];
            ?>
                
        
                <form action="" method="post" enctype="multipart/form-data" style="text-align: left; padding-left:2rem;padding-top:1rem;">


                    <h1>Moj profil</h1>

                    <label>Korisničko ime</label>
                    <input class="form-control" type="text" name="username" value="<?php echo $username ?>">
                    <label>Ime</label>
                    <input class="form-control" type="text" name="firstname" value="<?php echo $user_firstname ?>">
                    <label>Prezime</label>
                    <input class="form-control" type="text" name="lastname" value="<?php echo $user_lastname ?>">
                    <label>Email</label>
                    <input class="form-control" type="text" name="email" value="<?php echo $user_email ?>">
                    <label>Vrsta računa</label>
                    <input disabled class="form-control" type="text" name="role" value="<?php echo $user_role ?>">
                    <br/>
                    <div class=" form-group">

                        <input class="btn btn-success" type="submit" name="update_profile" value="Spremi promjene i ponovno se prijavi">
                      
                    </div>
                    <div class=" form-group">
                    <?php
                    if ($_SESSION['user_role'] == "Admin") {
                    ?>
                    <a class="btn btn-secondary" href="admin/index.php" >Povratak na admin panel</a>
                    <?php
                      }
                    ?>
                    </div>
                </form>
        <?php
        }
        ?>

              </div>
        <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->
      
</div>
<!-- /.container -->

  <!-- Footer -->
  <?php include "includes/footer.php" ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>