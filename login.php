<?php

include "includes/header.php";

include "includes/db.php";

?>

<?php
// Initialize the session

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Define variables and initialize with empty values
$username = $password = $user_role =  "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT user_id, username, user_password,user_role FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password ,$user_role);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["user_role"] = $user_role;
                            
                            

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "Lozinka nije točna";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "Ne postoji korisnik sa navedenim korisničkim imenom";
                }
            } else {
                echo "Greška.Pokušajte ponovno kasnije!";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    // mysqli_close($connection);
}
?>

<!--  PAGE CONTENT -->
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Prijava</h3></div>
                                    <div class="card-body">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                <label class="small mb-1">Korisničko ime</label>
                                                <input type="text" name="username" class="form-control py-4" value="<?php echo $username; ?>">
                                                <span class="help-block"><?php echo $username_err; ?></span>
                                            </div>
                                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                                <label class="small mb-1">Lozinka</label>
                                                <input type="password" name="password" class="form-control py-4">
                                                <span class="help-block" style="color: red;"><?php echo $password_err; ?></span>
                                            </div>

                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary" value="Prijava">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="small"><a href="register.php">Niste registrirani? Registracija.</a></div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="small"><a href="index.php">Povratak na početnu...</a></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
