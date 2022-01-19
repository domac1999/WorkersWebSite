<?php




if (isset($_POST['create_ad'])) {


    $queryResult = createAd();
    confirmQuery($queryResult);
}

?>

<div class="col-md-6">
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="cat_title"><strong> Naslov</strong></label>
            <input class="form-control" type="text" name="ad_title">


        </div>

        <div class="form-group">
            <label for="cat_title"><strong>Cijena (Kn)</strong></label>
            <input class="form-control" type="text" name="price">


        </div>

        <div class="form-group">
            <label for="cat_title"><strong> Kategorija alata </strong></label>
            <select name="ad_category_id">
                <?php

                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);



                while ($row = mysqli_fetch_assoc($select_categories)) {

                    $cat_title = $row["cat_title"];
                    $cat_id = $row["cat_id"];

                ?>

                    <option value=<?php echo $cat_id  ?>><?php echo $cat_title ?></option>

                <?php
                }

                ?>

            </select>


        </div>

        <div class="form-group">
            <label for="exampleFormControlFile1"> Slika</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
        </div>

        <div class="form-group">
            <label for="cat_title"><strong> Opis</strong></label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ad_content"></textarea>


        </div>

        <div class="form-group">
            <label for="cat_title"><strong> Tagovi</strong></label>
            <input class="form-control" type="text" name="ad_tags">


        </div>

        <div class="form-group">

            <input class="btn btn-danger" type="submit" name="create_ad" value="Add Post">


        </div>


    </form>

</div>