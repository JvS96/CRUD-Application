<?php
session_start();
//Include
include $_SERVER['DOCUMENT_ROOT'].'/database_queries/db_queries.php';
//Session Info
if(empty($_SESSION['user_name'])){
    die('<script>
            alert("User needs to login.");
            window.location = "index.php";
         </script>');
}

//Class call
$view_user_details = new database_queries();

if(isset($_POST["user_id"]) && !empty($_POST["user_id"])){ //Update Users
    echo "hello";
    // Retrieve individual field value
    $user_id = $_POST["user_id"];
    $user_name = $_POST['user_name'];
    $user_surname = $_POST['user_surname'];
    $user_sa_id = $_POST['user_sa_id'];
    $user_mobile = $_POST['user_mobile'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_dob = $_POST['user_dob'];
    $user_language = $_POST['user_language'];
    $user_interests = $_POST['user_interests'];


    //Call function
    $update_user_details_sql = $view_user_details->update_user("$user_id","$user_name", "$user_surname", "$user_sa_id", "$user_mobile", "$user_email", "$user_password", "$user_dob", "$user_language", "$user_interests","WHERE user_id = ".$_POST["user_id"]);
    $result = mysqli_query($conn, $update_user_details_sql);
    if($result){
        die('<script>
            alert("User updated successfully.");
            window.location = "manage.php";
         </script>');
    }else{
        die('<script>
            alert("Something went wrong.");
            window.location = "update.php";
         </script>');
    }


}else{ //View Users

    //Call function
    $view_user_details_sql = $view_user_details->view_user();
    $result = mysqli_query($conn, $view_user_details_sql);

    if(mysqli_num_rows($result) == 1){
        /* Fetch result row as an associative array. Since the result set
        contains only one row, we don't need to use while loop */
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // Retrieve individual field value
        $user_id = $row["user_id"];
        $user_name = $row['user_name'];
        $user_surname = $row['user_surname'];
        $user_sa_id = $row['user_sa_id'];
        $user_mobile = $row['user_mobile'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_dob = $row['user_dob'];
        $user_language = $row['user_language'];
        $user_interests = $row['user_interests'];
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
                        <h2>Update User Account</h2>
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
                                        <input style="width: 100%;" type="text" name="user_name" value="<?php echo $user_name; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Last Name:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_surname" value="<?php echo $user_surname; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>South Africa ID:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_sa_id" value="<?php echo $user_sa_id; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Mobile Number:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_mobile" value="<?php echo $user_mobile; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Email:</strong><br>
                                        <input style="width: 100%;" type="text" name="user_email" value="<?php echo $user_email; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Password:</strong><br>
                                        <input style="width: 100%;" type="password" name="user_password" value="<?php echo $user_password; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Date of Birth:</strong><br>
                                        <input style="width: 100%;" type="date" name="user_dob" value="<?php echo $user_dob; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Language:</strong><br>
                                        <select class="form-control" name="user_language" id="interest" required="">
                                            <option value="Afrikaans">Afrikaans</option>
                                            <option value="English">English</option>
                                            <option value="German">German</option>
                                            <option value="Frence">Frence</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong>Interest:</strong><br>
                                        <select class="form-control" name="user_interests" id="interest" required="" multiple="">
                                            <option value="Golf">Golf</option>
                                            <option value="Rugby">Rugby</option>
                                            <option value="Gaming">Gaming</option>
                                            <option value="Reading">Reading</option>
                                            <option value="Cricket">Cricket</option>
                                            <option value="Chess">Chess</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row margin-class-top">
                                    <div class="col-md-12">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
                                        <input style="width: 100%" type="submit" name="btn-update" class="btn btn-success" value="Update User">
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