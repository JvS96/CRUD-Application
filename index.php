<?php
session_start();
//Include
include(dirname(__DIR__).'/config/database_queries/db_queries.php');
//Class
$user_login_details = new database_queries();

if(isset($_POST['btn-login'])) {
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];

    $user_login_details_sql = $user_login_details->login_details("$username", "$password");
    $result = mysqli_query($conn, $user_login_details_sql);
    $sql_login_results = mysqli_fetch_array($result);

    if($sql_login_results){
        $_SESSION['user_name'] = $username;
        header('Location: manage.php');
        die();
    }else{
        die('<script>
            alert("Wrong Login Details, Please try again.");
            window.location = "index.php";
         </script>');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            .wrapper{
                width: 600px;
                margin: 0 auto;
            }
            table tr td:last-child{
                width: 120px;
            }
            .align-center{
                text-align: center;
            }
            .margin-class-top{
                margin-top: 2%
            }
            input{
                display: inline-block;
                font-weight: 400;
                border: 1px solid #000;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                border-radius: 0.25rem;
            }
        </style>
    </head>
    <body>
        <div style="margin: 5% 0;">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="align-center">
                        <h2>User Login</h2>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <div class="margin-class-top">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Username</strong><br>
                                            <input style="width: 100%;" type="text" name="user_name">
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Password</strong><br>
                                            <input style="width: 100%;" type="text" name="user_password">
                                        </div>
                                    </div>
                                    <div class="row margin-class-top">
                                        <div class="col-md-12">
                                            <input style="width: 100%" type="submit" name="btn-login" class="btn btn-success" value="Login">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
