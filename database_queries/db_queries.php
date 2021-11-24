<?php
//Includes
include('db_connection.php');

class database_queries{
    //Login Function
    public function login_details($username, $password){
        $sql = "
            SELECT 
                `user_id`,
                `user_name`,
                `user_password`   
            FROM
                `tbl_user`
            WHERE 
                `user_name` = '$username' AND 
                `user_password` = '$password'
        ";
        return $sql;
    }
    //User View Function
    public function view_user($condition = ""){
        $sql = "
            SELECT 
                   * 
            FROM 
                   `tbl_user`
            $condition
        ";
        return $sql;
    }
    //Add New User Function
    public function new_user($user_name, $user_email, $user_gender, $user_coment){
        $sql = "
            INSERT INTO
                `tbl_user` (`user_id`, `user_name`, `user_email`, `user_gender`, `user_content`)
            VALUES
                (NULL, '$user_name', '$user_email', '$user_gender', '$user_coment')
        ";
        return $sql;
    }
    //Remove user
    public function delete_user($condition = ""){
        $sql = "
            DELETE FROM 
                `tbl_user`
            $condition
        ";
        return $sql;
    }
}