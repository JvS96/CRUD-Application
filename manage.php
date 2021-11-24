<?php
session_start();
//Include
include $_SERVER['DOCUMENT_ROOT'].'/database_queries/db_queries.php';

if(empty($_SESSION['user_name'])){
    die('<script>
            alert("User needs to login.");
            window.location = "index.php";
         </script>');
}

if(isset($_POST['logout'])){
    session_destroy();
    header('Location: index.php');
    die();
}
//Class call
$view_user_details = new database_queries();

//View Users
//Call function
$view_user_details_sql = $view_user_details->view_user();
$result = mysqli_query($conn, $view_user_details_sql);

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
            .search-style{
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
                        <h2>User Details</h2>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <div class="row">
                    <div class="container">
                        <a href="create_user.php" class="btn btn-primary pull-right" style="width: 100%;"><i class="fa fa-plus"></i> Add New User</a>
                    </div>
                </div>
                <div class="row margin-class-top">
                    <div class="container">
                        <form method="post">
                            <input name="search" class="search-style" type="text" style="width: 69%;">
                            <input name="search-btn" class="btn btn-info pull-right" type="submit" value="Search Name" style="width: 30%;">
                        </form>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <div class="row margin-class-top">
                                <?php
                                if(isset($_POST['search-btn'])) {
                                    $search_value = $_POST['search'];

                                    //Call function
                                    $search_user_details_sql = $view_user_details->view_user("WHERE user_name LIKE '%{$search_value}%'");
                                    $search_view_result = mysqli_query($conn, $search_user_details_sql);

                                    if(mysqli_num_rows($search_view_result) > 0){
                                        echo '<table class="table table-bordered table-striped">';
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th>Name</th>";
                                                    echo "<th>Surname</th>";
                                                    echo "<th>Email</th>";
                                                    echo "<th>Mobile</th>";
                                                    echo "<th>DoB</th>";
                                                    echo "<th>Action</th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                            while($rows = $search_view_result->fetch_assoc()){
                                                echo "<tr>";
                                                    echo "<td>" . $rows['user_name'] . "</td>";
                                                    echo "<td>" . $rows['user_surname'] . "</td>";
                                                    echo "<td>" . $rows['user_email'] . "</td>";
                                                    echo "<td>" . $rows['user_mobile'] . "</td>";
                                                    echo "<td>" . $rows['user_dob'] . "</td>";
                                                    echo "<td>";
                                                    echo '<a href="delete.php?user_id='. $rows['user_id'] .'" title="Delete User" class="mr-3" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                                    echo '<a href="update.php?user_id='. $rows['user_id'] .'" title="Update User" data-toggle="tooltip"><span class="fa fa-pencil-square-o"></span></a>';
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                            echo "</tbody>";
                                        echo "</table>";
                                    }else{
                                        echo '<table class="table table-bordered table-striped">';
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th>Name</th>";
                                                    echo "<th>Email</th>";
                                                    echo "<th>Gender</th>";
                                                    echo "<th>Content</th>";
                                                    echo "<th>Action</th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                                echo "<tr>";
                                                    echo "<td colspan='5' style='text-align: center'> No Data Matching Your Search </td>";
                                                echo "</tr>";
                                            echo "</tbody>";
                                        echo "</table>";
                                    }
                                }else{
                                    if(mysqli_num_rows($result) > 0){
                                        echo '<table class="table table-bordered table-striped">';
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th>Name</th>";
                                                    echo "<th>Surname</th>";
                                                    echo "<th>Email</th>";
                                                    echo "<th>Mobile</th>";
                                                    echo "<th>DoB</th>";
                                                    echo "<th>Action</th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                            while($row = $result->fetch_assoc()){
                                                echo "<tr>";
                                                    echo "<td>" . $row['user_name'] . "</td>";
                                                    echo "<td>" . $row['user_surname'] . "</td>";
                                                    echo "<td>" . $row['user_email'] . "</td>";
                                                    echo "<td>" . $row['user_mobile'] . "</td>";
                                                    echo "<td>" . $row['user_dob'] . "</td>";
                                                    echo "<td>";
                                                        echo '<a href="delete.php?user_id='. $row['user_id'] .'" title="Delete User" class="mr-3" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                                        echo '<a href="update.php?user_id='. $row['user_id'] .'" title="Update User" data-toggle="tooltip"><span class="fa fa-pencil-square-o"></span></a>';
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                            echo "</tbody>";
                                        echo "</table>";
                                    }
                                }
                                // Close connection
                                mysqli_close($conn);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post">
                    <div class="row">
                        <div class="container">
                            <input name="logout" type="submit" class="btn btn-danger pull-right" value="Log Out" style="width: 20%;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
