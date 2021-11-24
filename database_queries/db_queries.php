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
    public function new_user($user_name, $user_surname, $user_sa_id, $user_mobile, $user_email, $user_password, $user_dob, $user_language, $user_interests){
        $sql = "
            INSERT INTO
                `tbl_user` (`user_id`, `user_name`, `user_surname`, `user_sa_id`, `user_mobile`, `user_email`, `user_password`, `user_dob`, `user_language`, `user_interests`)
            VALUES
                (NULL, '$user_name', '$user_surname', '$user_sa_id', '$user_mobile', '$user_email', '$user_password', '$user_dob', '$user_language', '$user_interests')
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
    //Update User
    public function update_user($user_id, $user_name, $user_surname, $user_sa_id, $user_mobile, $user_email, $user_password, $user_dob, $user_language, $user_interests,$condition = ""){
        $sql = "
            UPDATE 
                `tbl_user`
            SET 
                user_id = '$user_id', 
                user_name = '$user_name', 
                user_surname = '$user_surname', 
                user_sa_id = '$user_sa_id', 
                user_mobile = '$user_mobile', 
                user_email = '$user_email',
                user_password = '$user_password',
                user_dob = '$user_dob',
                user_language = '$user_language',
                user_interests = '$user_interests'
            $condition
        ";
        return $sql;
    }
}