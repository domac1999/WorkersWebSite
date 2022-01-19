<?php

include "includes/header.php";
include "includes/functions.php";
include "includes/db.php";


?>
<?php




if (isset($_POST['create_ad'])) {


    $queryResult = createAd();
    confirmQuery($queryResult);
}

?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<div class="container" style="margin-top: 5rem;">

    <div class="row">
        <div class="col-md-6">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="cat_title"><strong> Naslov</strong></label>
                    <input class="form-control" type="text" name="ad_title">


                </div>

                <div class="form-group">
                    <label for="cat_title"><strong>Cijena (kn/h)</strong></label>
                    <input class="form-control" type="text" name="price">


                </div>

                <div class="form-group">
                    <label for="cat_title"><strong> Kategorija </strong></label>
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
                    <label><strong>Slika</strong></label>
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
                    <input class="btn btn-danger" type="submit" name="create_ad" value="Add Post" onclick="return confirm('Vaš oglas je poslan na obradu. Biti će prikazan ako ste unjeli sve podatke ispravno i u skladu s pravilima kada ga admin dozvoli.');">
                </div>


            </form>

        </div>

    </div>

</div>