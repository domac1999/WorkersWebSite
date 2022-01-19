<form action="" method="POST">

    <div class="form-group">
        <label for="cat_title">Uredi kategoriju</label>

        <?php


        if (isset($_GET['edit'])) {

            $the_cat_id = $_GET['edit'];

            $query = "SELECT * FROM categories WHERE cat_id = {$the_cat_id}";
            $select_categories_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_id)) {

                $cat_title = $row["cat_title"];
                $cat_id = $row["cat_id"];
        ?>
                <input class="form-control" type="text" name="cat_title" value="<?php echo $cat_title ?>">
        <?php
            }
        }
        ?>

        <?php

        if (isset($_POST['update_category'])) {

            $cat_title = $_POST['cat_title'];

            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = '{$cat_id}'";
            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {
                die("Query failed" . mysqli_error($connection));
            }
            header("Location: categories.php");
        }


        ?>

    </div>

    <div class="form-group">

        <input class="btn btn-info" type="submit" name="update_category" value="Spremi promjene">


    </div>


</form>