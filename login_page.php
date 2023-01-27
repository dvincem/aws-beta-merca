<?php 
    include 'includes/config.php';
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['usertype']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>MERCA's PIZZA</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!-- NAV BAR -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href="index.php" class="navbar-brand">
                <img src="logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                <span class="text-light"><b>MERCA'S PIZZA</b></span>
            </a>
        </div>
    </nav>
<!-- MAIN LOGIN PAGE -->
    <div class="container">
        <div class="row my-custom-row justify-content-around">
            <div class="col col-lg-6 col-md-7 col-sm-10" id="login">
                <fieldset class="form-group rounded border p-1 text-light" id="fieldset">
                    <legend class="w-auto px-2"><img src="logo.png" alt="" width="100" height="100" class="d-inline-block"></legend>
                    <h1 class="heading"><i class="bi bi-lock"></i> LOGIN</h1>
                    <?php

                        if (isset($_GET['error'])) {
                            if ($_GET['error']== "emptyfields") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                username and password is empty!
                              </div>';
                            }
                            elseif ($_GET['error']== "error!") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    database error contact site owner
                              </div>';
                            }
                            elseif ($_GET['error']== "wrongpassword!") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    you have entered a wrong password!
                              </div>';
                            }
                            elseif ($_GET['error']== "designation%error!") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    please choose the right designation!
                              </div>';
                            }
                            elseif ($_GET['error']== "unknown!") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    unknown error has occured please refresh the page
                              </div>';
                            }
                            elseif ($_GET['error']== "nouser!") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    username is not registered!
                              </div>';
                            }
                            else {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    Unknown error. please retry or refresh the page
                              </div>';
                            }
                        }
                        if (isset($_GET['login'])) {
                            if ($_GET['login']== "success") {
                                echo '<div class="alert alert-info mx-1" role="alert">
                                You have been logged in!
                              </div>';
                            }
                        }
                        if (isset($_GET['signup'])) {
                            if ($_GET['signup']== "success") {
                                echo '<div class="alert alert-info mx-1" role="alert">
                                You have signed up successfully!
                              </div>';
                            }
                        }

                    ?>
                    <form class="p-1 text-dark" action="includes/login_page_code.php" method="POST">
                        <?php
                            if (isset($_GET['Username'])) {
                                $Email_User = $_GET['Username'];
                                echo '<div class="form-floating mb-3 mt-3">
                                <input type="text" class="form-control" id="Email_User" name="Email_User" placeholder="exampleuser" value="'.$Email_User.'">
                                <label for="Email_User"><i class="bi bi-person-circle"></i> Email or Username</label>
                            </div>';
                            }
                            else {
                                echo '<div class="form-floating mb-3 mt-3">
                                <input type="text" class="form-control" id="Email_User" name="Email_User" placeholder="exampleuser">
                                <label for="Email_User"><i class="bi bi-envelope-fill"></i> Email or <i class="bi bi-person-circle"></i>Username</label>
                            </div>';
                            }
                        ?>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="loginPassword" name="Password" placeholder="Password">
                            <label for="loginPassword"><i class="bi bi-key-fill"></i>Password</label>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-end">
                            
                            </button>
                            <button type="submit" id="login" name="submit-login" class="btn btn-outline-light">
                                <i class="bi bi-unlock"></i> login
                            </button>
                        </div>
                    </form>
                </fieldset>    
            </div>
        </div>
    </div>

    <footer id="footer">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col text-center">
                    <div class="copyright text-light">
                        <i class="bi bi-c-circle"></i> Copyright <strong> Merca's Pizza</strong>. All Rights Reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>