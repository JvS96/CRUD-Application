<?php
//Include
include(dirname(__DIR__).'/config/database_queries/db_queries.php');

$delete_user_details = new database_queries();
$delete_user_details_sql = $delete_user_details->delete_user("WHERE user_id = " . $_GET['user_id']);
$result = mysqli_query($conn, $delete_user_details_sql);

if($result){
        die('<script>
            alert("User Successfully Removed.");
            window.location = "manage.php";
         </script>');
}else{
    die('<script>
            alert("There was a problem removing the user.");
            window.location = "manage.php";
         </script>');
}