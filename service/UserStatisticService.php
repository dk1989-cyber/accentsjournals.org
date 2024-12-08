<?php

class UserStatisticService {

    function userStatistcs($key) {
        $query = "select userId,firstName,lastName,regDate,status from user where role='Author' ";
        if ($key != null) {
            $query .= "  and (firstName like('%$key%')";
            $query .= "  OR lastName like('%$key%')";
            $query .= "  OR concat(firstName,' ',lastName) like('%$key%') ";
            $date = date("Y-m-d", strtotime(str_replace('/', '-', $key))); //change date in database formate            
            $query .= "  OR status like('%$key%') )";
        }
        $result = mysql_query($query);
        return $result;
    }

    function autherPaperCount($userId) {
        $query = "select count(*) as pc from user u,papersubmission ps where ps.userId=u.userId and role='Author' and u.userId=$userId";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }

    function reviewerStatistcs($key) {
        $query = "select userId,firstName,lastName,regDate,status from user where role='Reviewer' ";
        if ($key != null) {
            $query .= "  and (firstName like('%$key%')";
            $query .= "  OR lastName like('%$key%')";
            $query .= "  OR concat(firstName,' ',lastName) like('%$key%') ";
            $date = date("Y-m-d", strtotime(str_replace('/', '-', $key))); //change date in database formate
            $query .= "  OR status like('%$key%') )";
        }
        $result = mysql_query($query);
        return $result;
    }

    function reviewerPaperCount($userId) {
        $query = "select count(*) as pc from user u,assignreview ar where ar.userIdTo=u.userId and role='Reviewer' and u.userId=$userId";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }

    function subAdmin($key) {
        $query = "select userId,firstName,lastName,regDate,status from user where role='Admin' ";
        if ($key != null) {
            $query .= "  and (firstName like('%$key%')";
            $query .= "  OR lastName like('%$key%')";
            $query .= "  OR concat(firstName,' ',lastName) like('%$key%') ";
            $date = date("Y-m-d", strtotime(str_replace('/', '-', $key))); //change date in database formate
            $query .= "  OR status like('%$key%') )";
        }
        $result = mysql_query($query);
        return $result;
    }

}

?>
