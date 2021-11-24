<?php
session_start();
//Include
include $_SERVER['DOCUMENT_ROOT'].'/database_queries/db_queries.php';
//Class
$insert_new_user = new database_queries();

//Insert user to database
if(isset($_POST['btn-insert'])){
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_gender = $_POST['user_gender'];
    $user_coment = $_POST['user_comment'];

    $insert_new_user_sql = $insert_new_user->new_user("$user_name", "$user_email", "$user_gender", "$user_coment");
    $result = mysqli_query($conn, $insert_new_user_sql);

    if($result){
        $to_email_address = $user_email;
        $subject = 'Testing PHP Mail';
        $message = 'This mail is sent using the PHP mail function';
        $headers = 'From: noreply@testmail.com';
        mail($to_email_address,$subject,$message,$headers);

        die('<script>
                alert("Account Successfully created.");
                window.location = "manage.php";
            </script>');

    }else{
        die('<script>
                alert("There was a problem creating the user.");
                window.location = "create_user.php";
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
                        <h2>Create a New Account</h2>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <?php
                if(empty($_SESSION['user_name'])){ ?>
                    <div class="row">
                        <div class="container">
                            <a href="index.php" class="btn btn-secondary pull-right" style="width: 100%;"><i class="fa fa-undo"></i> Go Back</a>
                        </div>
                    </div>
                <?php
                }else{ ?>
                    <div class="row">
                        <div class="container">
                            <a href="manage.php" class="btn btn-secondary pull-right" style="width: 100%;"><i class="fa fa-undo"></i> Go Back</a>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="container margin-class-top" style="border: 1px dotted;padding: 5%;">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>First Name:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Last Name:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>South Africa ID:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Mobile Number:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Email:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Password:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Date of Birth:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Language:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong>Interest:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_name" required>
                                    </div>
                                </div>
                                <div class="row margin-class-top">
                                    <div class="col-md-12">
                                        <input style="width: 100%" type="submit" name="btn-insert" class="btn btn-success" value="Insert User">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
