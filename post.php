<?php

include "includes/header.php";
include "includes/db.php";
include "includes/functions.php";

date_default_timezone_set('Europe/Zagreb');


if (isset($_GET['id'])) {

global $connection;
$post_id = $_GET['id'];

$query = "SELECT * FROM ads WHERE ad_id = {$post_id}";
$select_post_by_id = mysqli_query($connection, $query);

$query_comment_count = "SELECT * FROM comments WHERE comment_ad_id = {$post_id}";
$count_comments_query = mysqli_query($connection, $query_comment_count);
$count_comments = mysqli_num_rows($count_comments_query);

$query_update_count = "UPDATE ads SET count = count + 1 WHERE ad_id = {$post_id}";
$query_update_count_query = mysqli_query($connection, $query_update_count);

while ($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_id = $row["ad_id"];
    $post_title = $row["ad_name"];
    $post_category_id = $row["ad_cat"];
    $post_author = $row["ad_owner"];
    $post_date = $row["ad_date"];
    $post_image = $row["ad_image"];
    $post_content = $row["ad_description"];
    $post_tags = $row["ad_tags"];
    $post_comment_count = $row["ad_comment_count"];
    $post_status = $row["ad_status"];
    $post_views = $row["count"];
    $post_price = $row["price"];

    

}
$query1 = "SELECT * FROM users WHERE user_id = $post_author";
$getUsername = mysqli_query($connection, $query1);
$rowUser = mysqli_fetch_assoc($getUsername);
$AuthorName = $rowUser['username'];

$query2 = "SELECT user_email FROM users WHERE user_id = $post_author";
$getEmail = mysqli_query($connection, $query2);
$rowMail = mysqli_fetch_assoc($getEmail);
$AuthorEmail= $rowMail['user_email'];
}
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

    <div class="col-lg-9" style="padding:15px; margin-top:25px;">
      <div class="row">


<div class="card col-md-12" style="max-height:fit-content">
  <img src="images/<?php echo $post_image ?>" class="card-img-top img-fluid" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $post_title ?></h5>
    <p class="card-text">Opis: <?php echo $post_content ?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item" style="color: red;">Cijena: <?php echo $post_price ?> kn/h</li>
    <li class="list-group-item">Postavljeno: <?php echo $post_date ?></li>
    <li class="list-group-item">Tagovi: <?php echo $post_tags ?></li>
  </ul>
  <div class="card-body">
  <div class="row">
  <div class="col-md-3">
  Autor:<a href="users.php" class="card-link"> <?php echo $AuthorName ?></a>
  </div>
  <div class="col-md-6">
  Email autora:<a href="#" class="card-link"><?php echo $AuthorEmail ?></a>
  </div>
  </div>
  </div>
</div>

</div>
        <!-- /.row -->


<div class="row">
<!-- Blog Comments -->

<?php

if (isset($_POST['submit_comment'])) {

    if (isset($_SESSION['loggedin'])) {
        $comment_username = $_SESSION['username'];
        $comment_content = $_POST['comment_content'];
        $comment_post_id = $_GET['id'];
        $comment_time = date("Y-m-d H:i:s");
        $query = "INSERT INTO comments(comment_author,comment_content,comment_ad_id,comment_date) ";
        $query .= "VALUES('{$comment_username}','{$comment_content}','{$comment_post_id}','{$comment_time}')";

        $create_comment_query = mysqli_query($connection, $query);


    }
}
?>

<?php

if (isset($_SESSION['loggedin'])) {
?>
    <!-- Comments Form - Authenticated users -->
    <div class="card col-md-12" style="max-height:fit-content">
        <div class="card-body">
          <h5 class="card-title">Ostavite komentar:</h5>
        </div>
        <div class="card-body">
        <form role="form" method="post">
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Comment" name="comment_content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit_comment">Pošalji</button>
        </form>
        </div>
    </div>
<?php
}
?>
</div>

<div class="row">
                          <div class="card col-md-12">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               Komentari
                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                    <th>Korisnik</th>
                                    <th>Datum</th>
                                    <th>Komentar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                    <!-- Posted Comments -->

                                        
                                                    <?php
                                                    // $query = "SELECT * FROM comments ORDER BY comment_date {$_GET['sort']}";
                                                    // $select_comments = mysqli_query($connection, $query);
                                        
                                                    // while ($row = mysqli_fetch_assoc($select_comments)) {
                              
                                                    if (isset($_GET['comment_page'])) {
                                                        $comment_page = $_GET['comment_page'];
                                                    } else {
                                                        $comment_page = 1;
                                                    }
                                                    $no_of_records_per_page = 5;
                                                    $offset = ($comment_page - 1) * $no_of_records_per_page;
                                        
                                        
                                                    $total_comments_sql = "SELECT COUNT(*) FROM comments WHERE comment_ad_id = {$post_id} ";
                                                    $result = mysqli_query($connection, $total_comments_sql);
                                                    $total_rows = mysqli_fetch_array($result)[0];
                                                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                                                    
                                                    $sql = "SELECT * FROM comments WHERE comment_ad_id = {$post_id} ORDER BY comment_date DESC LIMIT $offset, $no_of_records_per_page ";
                                                    $res_data = mysqli_query($connection, $sql);
                                                    if (mysqli_num_rows($res_data) == 0) {
                                                        echo "<td>Nema komentara</td>";
                                                        echo "<td></td>";
                                                        echo "<td></td>";

                                                    }else{
                                                        while ($row = mysqli_fetch_array($res_data)) {
                                                            //here goes the data
                                            
                                                            $comment_id = $row["comment_id"];
                                                            $comment_post_id = $row["comment_ad_id"];
                                                            $comment_author = $row["comment_author"];
                                                            $comment_content = $row["comment_content"];
                                                           // $comment_status = $row["comment_status"];
                                                            $comment_date = $row["comment_date"];
                                                        ?>
                                                            <?php
                                                            echo "<tr><td>{$comment_author}</td>";
                                                            echo "<td>{$comment_date}</td>";
                                                            echo "<td>{$comment_content}</td></tr>";
                                                            ?>  
                                                    <?php
                                                        }
                                                }
                                                    ?>
                                                   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


</div>

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