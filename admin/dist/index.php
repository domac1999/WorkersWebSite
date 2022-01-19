<?php 
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidenav.php";
?>
                <main>
                    <!-- CHARTS.PHP -->
                    <div class="container-fluid">
                        <h1 class="mt-4">Izvješća</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active" href="index.php">Početna</li>
                            <li class="breadcrumb-item"><a href="ads.php">Oglasi</a></li>
                            <li class="breadcrumb-item"><a href="comments.php">Komentari</a></li>
                            <li class="breadcrumb-item"><a href="categories.php">Kategorije</a></li>
                            <li class="breadcrumb-item"><a href="tables.php">Korisnici</a></li>

                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Prikaz odabranih izvješća o oglasima na stranici.
                                <a target="_blank" href="https://www.chartjs.org/docs/latest/">Chart.js documentation</a>
                                .
                            </div>
                        </div>

                           
                    </div>
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Status i broj oglasa
                                    </div>
                                    <div class="card-body"><div id="barChart" style="width: 100%; height: 400px;margin:auto"></div></div>
                                    <div class="card-footer small text-muted">Updated: <?php echo date("H:i:s d-m-Y ",time()) ?> </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Cijene oglasa
                                    </div>
                                    <div class="card-body"><div id="bar1Chart" style="width: 100%; height: 400px;margin:auto"></div></div>
                                    <div class="card-footer small text-muted">Updated: <?php echo date("H:i:s d-m-Y ",time()) ?> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

        <?php include "includes/footer.php" ?>

    </body>
</html>
