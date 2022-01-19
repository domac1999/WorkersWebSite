<div class="col-lg-3">

<h1 class="my-4" style="color: orange;">Kategorije</h1>
<div class="list-group">

  <?php
  $query1 = "SELECT * FROM categories ";
  $select_all_categories = mysqli_query($connection, $query1);

  while ($row = mysqli_fetch_assoc($select_all_categories)) {
    $cat_id = $row["cat_id"];
    $cat_title = $row["cat_title"];

    echo "<a class='list-group-item btn btn-warning' style='color:black;font-style:oblique' href='categories.php?categories=$cat_id'>{$cat_title}</a>";
  }
  ?>

</div>

</div>