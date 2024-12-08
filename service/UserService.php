<?php

class UserService {

    function getAdminUser() {
        $query = mysql_query("select * from user where role='Admin' and status!='Block'");
        return $query;
    }

    function getSubAdmin() {
        $query = mysql_query("select * from user where role='Admin' and status!='Block'");
        return $query;
    }

    function getAuthors() {
        $query = mysql_query("select * from user where role='Author' and status!='Block'");
        return $query;
    }

    function getReviewer() {
        $query = mysql_query("select * from user where role='Reviewer' and status!='Block'");
        return $query;
    }

    function getReviewerById($userId) {
        $query = mysql_query("select * from user where role!='Admin' and userId=$userId");
        return $query;
    }

    function getEmailById($userId) {
        $query = mysql_query("select email from user where userId=$userId");
        return mysql_fetch_array($query);
    }

    function getPasswordByEmail($email) {
        $query = mysql_query("select password from user where email='$email'");
        return mysql_fetch_array($query);
    }

    function checkLoginName($email) {
        $query = mysql_query("select email from user where email='$email'");
        return mysql_fetch_array($query);
    }

    function checkAssignTask($userId) {
        $query = mysql_query("select userId from task where userId=$userId");
        return mysql_fetch_array($query);
    }

}

?>
