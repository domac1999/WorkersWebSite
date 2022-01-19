<?php

include "includes/header.php";
include "includes/db.php";

?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

  <div class="row">
  
  <?php
  if (isset($_SESSION['username'])) {
    ?>
    <!--Sidebar-->
    <?php
    include "includes/sidebar.php";
    ?>
      <!-- /.col-lg-3 -->
        <div class="col-lg-9" style="padding:15px; margin-top:25px;">
              <div class="row">
            <div class="container-fluid">
              <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               Tablica korisnika
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                        <thead>
                                            <tr>
                                    <th>Korisnik</th>
                                    <th>Ime</th>
                                    <th>Prezime</th>
                                    <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>    
    <?php          
    global $connection;
    $query = "SELECT * FROM users WHERE user_role = 'Standard'";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {

        $username = $row["username"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_email = $row["user_email"];

        echo "<tr>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "</tr>";
        
    }
?>
  </tbody>
</table>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->
      
</div>
<!-- /.container -->
</div>
</div>
</div>

<?php 
  } else {
    echo "
    <div class='container-fluid' style='text-align: center; padding-top:20px; color:red;font-style:italic;'>
    <h2>MOLIMO PRIJAVITE SE ZA UVID U KORISNIKE</h2>
    </div>
    ";

  }
?>
</div>

  <!-- Footer -->
  <?php include "includes/footer.php" ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>