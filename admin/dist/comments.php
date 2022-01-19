<?php 
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidenav.php";
?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Komentari</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Početna</a></li>
                            <li class="breadcrumb-item"><a href="ads.php">Oglasi</a></li>
                            <li class="breadcrumb-item active">Komentari</li>
                            <li class="breadcrumb-item"><a href="categories.php">Kategorije</a></li>
                            <li class="breadcrumb-item"><a href="tables.php">Korisnici</a></li>
                        </ol>

                
                <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               Tablica korisnika
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                <th>ID Komentara</th>
                <th>ID Oglasa</th>
                <th>Autor</th>
                <th>Komentar </th>
                <th>Vrijeme</th>
                <th>Izbriši</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                <th>ID Komentara</th>
                <th>ID Oglasa</th>
                <th>Autor</th>
                <th>Komentar </th>
                <th>Vrijeme</th>
                <th>Izbriši</th>

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

                                                    case 'add_comment';
                                                        include "includes/add_comment.php";
                                                        break;
                                                    case 'edit_comment';
                                                        include "includes/edit_comment.php";
                                                        break;

                                                    default:
                                                        include "includes/view_all_comments.php";
                                                        break;
                                                }


                                                ?>
                                            
                                        </tbody>
                                    </table>
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
    </body>
</html>
