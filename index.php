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
      <!-- /.col-lg-3 -->
        <div class="col-lg-9" style="padding:15px; margin-top:25px;">
              <div class="row">
                    <?php

                    $query = "SELECT * FROM ads WHERE ad_status = 'Approved'";
                    $select_all_posts_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                        $post_id = $row["ad_id"];
                        $post_category_id = $row["ad_cat"];
                        $post_title = $row["ad_name"];
                        $post_author = $row["ad_owner"];
                        $post_date = $row["ad_date"];
                        $post_image = $row["ad_image"];
                        $post_content = substr($row["ad_description"], 0, 250);
                        $post_tags = $row["ad_tags"];
                        $post_comment_count = $row["ad_comment_count"];
                        $post_status = $row["ad_status"];
                        $post_price = $row["price"];


                        $query = "SELECT * FROM users WHERE user_id = $post_author";
                        $getUsername = mysqli_query($connection, $query);
                        $rowUser = mysqli_fetch_assoc($getUsername);
                        $AuthorName = $rowUser['username']
                    ?>

          <!-- IZGLED KARTICA -->
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card h-100" style="max-height:fit-content">
                    <a href="#"><img class="card-img-top img-fluid" src="images/<?php echo $post_image ?>" alt=""></a>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="post.php?id=<?php echo $post_id ?>&sort=asc"><?php echo $post_title ?></a>
                      </h4>
                      <h5 style="color: indianred;">Cijena: <?php echo $post_price ?> kn/h</h5>
                      <p class="card-text"><?php echo $post_content ?>...</p>
                    </div>
                    <div class="card-footer">
                      <medium class="text-muted">Autor: <?php echo $AuthorName ?></medium>
                    </div>
                  </div>
                </div>
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
