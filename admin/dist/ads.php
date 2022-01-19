<?php 
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidenav.php";
?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Oglasi</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item "><a href="index.php">Početna</a></li>
                            <li class="breadcrumb-item active">Oglasi</li>
                            <li class="breadcrumb-item"><a href="comments.php">Komentari</a></li>
                            <li class="breadcrumb-item"><a href="categories.php">Kategorije</a></li>
                            <li class="breadcrumb-item"><a href="tables.php">Korisnici</a></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Prikaz svih oglasa u bazi i moguće opcije.
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               Tablica oglasa
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                <th>Naslov</th>
                <th>Kategorija</th>
                <th>Autor</th>
                <th>Slika</th>
                <th>Datum postavljanja</th>
                <th>Opis</th>
                <th>Tagovi</th>
                <th>Broj komentara</th>
                <th>Status</th>
                <th>Izbriši</th>
                <th>Uredi</th>
                <th>Zabrani</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                <th>Naslov</th>
                <th>Kategorija</th>
                <th>Autor</th>
                <th>Slika</th>
                <th>Datum postavljanja</th>
                <th>Opis</th>
                <th>Tagovi</th>
                <th>Broj komentara</th>
                <th>Status</th>
                <th>Izbriši</th>
                <th>Uredi</th>
                <th>Zabrani</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php

                    if (isset($_GET['source'])) {

                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {

                        case 'add_post';
                            include "includes/add_post.php";
                            break;
                        case 'edit_post';
                            include "includes/edit_post.php";
                            break;

                        default:
                            include "includes/view_all_posts.php";
                            break;
                    }


                    ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include "includes/footer.php" ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>