<?php 
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidenav.php";
?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Korisnici</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="index.php">Početna</a></li>
                            <li class="breadcrumb-item"><a href="ads.php">Oglasi</a></li>
                            <li class="breadcrumb-item"><a href="comments.php">Komentari</a></li>
                            <li class="breadcrumb-item"><a href="categories.php">Kategorije</a></li>
                            <li class="breadcrumb-item">Korisnici</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Prikaz svih korisnika u bazi i moguće opcije.
                            </div>
                        </div>
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
                                    <th>ID Korisnika</th>
                                    <th>Korisničko ime</th>
                                    <th>Ime</th>
                                    <th>Prezime</th>
                                    <th>Email</th>
                                    <th>Ovlasti</th>
                                    <th>Promjeni ovlast</th>
                                    <th>Obriši</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                    <th>ID Korisnika</th>
                                    <th>Korisničko ime</th>
                                    <th>Ime</th>
                                    <th>Prezime</th>
                                    <th>Email</th>
                                    <th>Ovlasti</th>
                                    <th>Promjeni ovlast</th>
                                    <th>Obriši</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php

                                            // Find all categories query
                                            findAllUsers();
                                            ?>

                                            <?php

                                            // DELETE QUERY 

                                            deleteUsers();

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
