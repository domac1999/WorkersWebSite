<?php

include "includes/header.php";

include "includes/db.php";

?>
<?php


// Define variables and initialize with empty values
$username = $password = $confirm_password = $firstname = $lastname = $email = $profile_image = "";
$username_err = $password_err = $confirm_password_err = $email_err = $firstname_err = $lastname_err =  "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT user_id FROM users WHERE username = ? OR user_email = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_email);

            // Set parameters
            $param_username = trim($_POST["username"]);
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken or this email is already being used";
                } else {
                    $username = trim($_POST["username"]);
                    $email = trim($_POST["email"]);
                    $firstname = trim($_POST["firstname"]);
                    $lastname = trim($_POST["lastname"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }








    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter a email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate firstname
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "Please enter a firstname.";
    } elseif (strlen(trim($_POST["firstname"])) < 1) {
        $firstname_err = "Firstname must have atleast 2 characters.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }

    // Validate lastname
    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Please enter a lastname.";
    } elseif (strlen(trim($_POST["lastname"])) < 1) {
        $lastname_err = "Lastname must have atleast 2 characters.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }









    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, user_password,user_firstname,user_lastname,user_email) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_email);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // header("refresh:5;location: index.php");
                // echo "Sign Up successful!";
?>
                <div class="alert alert-success" role="alert">
                    Sign up successful! Now you can login.
                </div>
<?php
                $username = $password = $confirm_password = $firstname = $lastname = $email = $profile_image = "";
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($connection);
}


?>

<body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Registracija</h3></div>
                                    <div class="card-body">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                        <label class="small mb-1">Username</label>
                                                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                                        <span class="help-block"><?php echo $username_err; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                                    <label class="small mb-1">Email</label>
                                                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                                                    <span class="help-block"><?php echo $email_err; ?></span>
                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                                                        <label class="small mb-1">Ime</label>
                                                        <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                                                        <span class="help-block"><?php echo $firstname_err; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                                                        <label class="small mb-1">Prezime</label>
                                                        <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                                                        <span class="help-block"><?php echo $lastname_err; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                                    <label class="small mb-1">Lozinka</label>
                                                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                                                    <span class="help-block"><?php echo $password_err; ?></span>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                                    <label class="small mb-1">Potvrdi lozinku</label>
                                                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                                                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary" value="Registracija">
                                                <input type="reset" class="btn btn-default" value="Reset">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Imate račun? Prijava.</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>


