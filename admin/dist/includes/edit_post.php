<?php


if (isset($_POST['edit_post'])) {

    $post_id = $_GET["edit"];
    $post_title = $_POST["post_title"];
    $post_category_id = $_POST["post_category"];
    $post_author = $_POST["post_author"];
    // $post_date = $_POST["post_date"];
    $post_image  =  ($_FILES['image']['name']);
    $post_image_temp  =  ($_FILES['image']['tmp_name']);
    $post_content = $_POST["post_content"];
    $post_tags = $_POST["post_tags"];
    // $post_comment_count = $_POST["post_comment_count"];
    $post_status = $_POST["post_status"];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {

        $query = "SELECT * FROM ads WHERE ad_id = $post_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {

            $post_image = $row['ad_image'];
        }
    }


    $query = "UPDATE ads SET ";
    $query .= "ad_name  = '{$post_title}', ";
    $query .= "ad_cat = '{$post_category_id}', ";
    $query .= "ad_date   =  now(), ";
    $query .= "ad_owner = '{$post_author}', ";
    $query .= "ad_status = '{$post_status}', ";
    $query .= "ad_tags   = '{$post_tags}', ";
    $query .= "ad_description = '{$post_content}', ";
    $query .= "ad_image  = '{$post_image}' ";
    $query .= "WHERE ad_id = {$post_id} ";


    $update_query = mysqli_query($connection, $query);

    if (!$update_query) {
        die("Query failed" . mysqli_error($connection));
    }
    header("Location: ads.php");
}






if (isset($_GET['edit'])) {

    $post_id = $_GET['edit'];
    $query = "SELECT * FROM ads WHERE ad_id = {$post_id}";

    $select_posts_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts_id)) {
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
    }
}

?>



<div class="col-md-12">
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="cat_title"><strong> Naslov</strong></label>
            <input class="form-control" type="text" name="post_title" value="<?php echo $post_title ?>">
        </div>

<!--         <div class="form-group">
            <label for="users"><strong>Autor</strong></label>

            <select name="ad_owner" id="">
                <?php/*
                $query = "SELECT * FROM users";
                $select_categories = mysqli_query($connection, $query);

                confirmQuery($select_categories);


                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $user_id = $row['user_id'];
                    $username = $row['username'];

                    
                    if ($user_id == $post_id) {


                        echo "<option selected value='{$user_id}'>{$username}</option>";
                    } else {

                        echo "<option value='{$user_id}'>{$username}</option>";
                    }
                }*/
                ?>
            </select>
        </div> -->

        <div class="form-group">
            <label for="categories">Kategorije</label>
            <select name="post_category" id="">

                <?php

                $query = "SELECT * FROM categories ";
                $select_categories = mysqli_query($connection, $query);

                confirmQuery($select_categories);


                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];


                    if ($cat_id == $post_category_id) {


                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                    } else {

                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }

                ?>


            </select>

        </div>

        <div class="form-group">
            <label for="exampleFormControlFile1"> Slika</label>
            <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
            <input type="file" name="image">
        </div>

        <div class="form-group">
            <label for="cat_title"><strong> Opis</strong></label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_content"><?php echo $post_content ?></textarea>


        </div>



        <div class="form-group">
            <label for="cat_title"><strong> Tagovi</strong></label>
            <input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags ?>">


        </div>



        <div class="form-group">
            <select name="post_status" id="">
                <?php
                if ($post_status == 'Approved') {
                    $post_status_prijevod = 'Odobri';
                } else {
                    $post_status_prijevod = 'Zabrani';
                }

                ?>
                <option value='<?php echo $post_status ?>'><?php echo $post_status_prijevod; ?></option>

                <?php

                if ($post_status == 'Approved') {


                    echo "<option value='Unapproved'>Zabrani</option>";
                } else {


                    echo "<option value='Approved'>Odobri</option>";
                }

                ?>

            </select>
        </div>

        <div class=" form-group">

            <input class="btn btn-danger" type="submit" name="edit_post" value="Spremi promjene">


        </div>


    </form>

</div>