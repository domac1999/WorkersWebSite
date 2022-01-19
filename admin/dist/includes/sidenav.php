<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Glavno</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Admin - početna
                            </a>
                            <div class="sb-sidenav-menu-heading">Oglašavanje</div>
                            <a class="nav-link" href="ads.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Oglasi

                            </a>
                            <a class="nav-link" href="comments.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Komentari
                            </a>
                            <div class="sb-sidenav-menu-heading">Kontrola usera</div>
                            <a class="nav-link" href="categories.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Kategorije
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Korisnici
                            </a>
                            <div class="sb-sidenav-menu-heading">Stranice za errore</div>
                            <a class="nav-link" href="401.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                401

                            </a>
                            <a class="nav-link" href="404.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                404
                            </a>
                            <a class="nav-link" href="500.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                500
                            </a>
                            <a class="nav-link" href="../../index.php" style="color: lightblue;">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Povratak na početnu
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="medium">Prijavljeni korisnik:
                        <?php
                        if ($_SESSION['user_role'] == "Admin") {
                        ?>
                            <p><?php echo $_SESSION['username']  ?></p>
                        <?php
                            }
                        ?>
                    </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">