<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">HandyMan</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

            <?php

            if (isset($_SESSION['username'])) {

                if ($_SESSION['user_role'] == "Standard") {
            ?>
                    <a class="navbar-brand" href="profile.php" style="color: gold;"><?php echo $_SESSION['username']  ?></a>
                    <a class="navbar-brand" href="createAd.php" >Novi oglas</a>
                <?php
                }
                if ($_SESSION['user_role'] == "Admin") {
                ?>
                    <a class="navbar-brand" href="admin/index.php" style="color: gold;"><?php echo $_SESSION['username']  ?></a>
            <?php
                }
            }
            ?>
          <li class="nav-item">
            <a class="nav-link" href="users.php">Svi korisnici</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">O nama</a>
          </li>


        <!-- Collect the nav links, forms, and other content for toggling (ISPIS KATEGORIJA U NAVIGACIJI)
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php

                $query1 = "SELECT * FROM categories LIMIT 8";
                $select_all_categories_query = mysqli_query($connection, $query1);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];

                    echo "<li class='nav-item'>
                    <a class='nav-link' style='color:lightblue' href='categories.php?categories=$cat_id'>{$cat_title}</a>
                        </li>";
                }

                ?>
            </ul>
        </div>
        /.navbar-collapse -->


          <li class="nav-item" style="margin-left:10px;">
                <?php
                if (isset($_SESSION["loggedin"])) {
                ?>
                    <form action="logout.php" method="POST">
                        <button class="btn btn-danger" type="submit">
                            Odjava
                        </button>
                    </form>
                <?php

                } else {
                ?>
                    <form action="login.php" method="GET">
                        <button class="btn btn-warning" type="submit">
                            Prijava
                        </button>
                    </form>
                <?php

                }

                ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>