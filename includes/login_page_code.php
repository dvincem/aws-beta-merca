<?php

    if(isset($_POST['submit-login'])){
        
        require 'config.php';

        $Email_User = $_POST ['Email_User'];
        $Password = $_POST ['Password'];

        if (empty($Email_User) || empty($Password)) {
            header("location: ../login_page.php?error=emptyfields");
            exit();
        }
        else{
            $sql = "SELECT * FROM logins WHERE email=? OR username=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../login_page.php?error=error!&Username=".$Email_User."");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "ss", $Email_User, $Email_User);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    if ($row['pass'] !== $Password){
                        header("location: ../login_page.php?error=wrongpassword!&Username=".$Email_User."");
                        exit();
                    }
                    elseif ($row['pass'] == $Password && $row['usertype']=='cashier1') {
                        session_start();
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['usertype'] = $row['usertype'];
                        header("location: ../dashboard.php");
                        exit();
                    }
                    elseif ($row['pass'] == $Password && $row['usertype']=='cashier2') {
                        session_start();
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['usertype'] = $row['usertype'];
                        header("location: ../dashboard.php");
                        exit();
                    }
                    elseif ($row['pass'] == $Password && $row['usertype']=='hr') {
                        session_start();
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['usertype'] = $row['usertype'];
                        header("location: ../dashboard.php");
                        exit();
                    }
                    elseif ($row['pass'] == $Password && $row['usertype']=='superadmin') {
                        session_start();
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['usertype'] = $row['usertype'];
                        header("location: ../dashboard.php");
                        exit();
                    }
                    else {
                        header("location: ../login_page.php?error=unknown!&Username=".$Email_User."");
                        exit();
                    }
                }
                else{
                    header("location: ../login_page.php?error=nouser!&Username=".$Email_User."");
                    exit();
                }
            }
        }

    }
    if (isset($_POST['signup-submit'])) {
        header("location: ../create_account.php?please%signup!");
    }