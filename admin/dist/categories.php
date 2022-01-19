<?php 
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidenav.php";
?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Kategorije</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Početna</a></li>
                            <li class="breadcrumb-item"><a href="ads.php">Oglasi</a></li>
                            <li class="breadcrumb-item"><a href="comments.php">Komentari</a></li>
                            <li class="breadcrumb-item active">Kategorije</li>
                            <li class="breadcrumb-item"><a href="tables.php">Korisnici</a></li>
                        </ol>
                        <div class="col-xs-4">

<?php


insert_categories();

?>

<form action="" method="POST">

    <div class="form-group">
        <label for="cat_title">Nova kategorija</label>
        <input class="form-control" type="text" name="cat_title">


    </div>

    <div class="form-group">

        <input class="btn btn-info" type="submit" name="submit" value="Dodaj kategoriju">


    </div>


</form>



<?php

// Update and include query
if (isset($_GET['edit'])) {

    $cat_id = $_GET['edit'];

    include "includes/update_categories.php";
}


?>



</div>

<div class="col-xs-8">


<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ime kategorije</th>
            <th>Izbriši</th>
            <th>Uredi</th>
        </tr>
    </thead>

    <tbody>
        <?php

        // Find all categories query
        findAllCategories();
        ?>


        <?php

        // DELETE QUERY 

        deleteCategories();



        ?>


    </tbody>
</table>


</div>
                        
                    </div>
                </main>
                <?php include "includes/footer.php" ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
