<?php

include "includes/header.php";
include "includes/db.php";

?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">

  <div class="row">
    <!--Sidebar-->
    <?php
    include "includes/sidebar.php";
    ?>
    <div class="col-lg-9" style="padding:15px; margin-top:25px; text-align: center;">
        <div class="row">
            <div class="container-fluid">
              <h2>Sve o nama</h2>
            </div>

        <p>Dugi niz godina omogućujemo lakše oglašavanje radnicima ili firmama kako bi mogli lakše doći do ljudi s potrebom njihove pomoći. Naše usluge su tu za sve građane republike Hrvatske.</p>

        <div class="container-fluid">
        <img src="about-slika.png" style="max-height: 400px; max-width:300px">
        </div>
        


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