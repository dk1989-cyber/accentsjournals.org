<?php

class ConfrenceService {

    function getConfrence() {
        $query = mysql_query("SELECT c.confrenceId,c.confImage,c.name FROM confrence c ORDER BY c.confrenceId DESC ");
        return $query;
    }

    function getAllConfrence() {
        $query = mysql_query("SELECT * FROM confrence");
        return $query;
    }

    function getAllConfrencePaper($confrenceId) {
        $query = "SELECT * FROM confrence c, confpaper cp WHERE c.confrenceId=cp.confrenceId";
        if ($confrenceId != '') {
            $query .= " AND c.confrenceId=$confrenceId";
        }

        return mysql_query($query);
    }

    function deleteConfrence($confrenceId) {
        $query = mysql_query("delete from confrence where confrenceId=$confrenceId");
        return $query;
    }

    function deleteConfPaperById($confpaperId) {
        $query = mysql_query("delete from confpaper where confpaperId=$confpaperId");
        return $query;
    }

    function getConfrenceById($confrenceId) {
        $query = mysql_query("select * from confrence where confrenceId=$confrenceId");
        return mysql_fetch_array($query);
    }

    function getConfNameById($confrenceId) {
        $query = mysql_query("SELECT * FROM confrence c WHERE c.confrenceId=$confrenceId");
        return mysql_fetch_array($query);
    }

    function getConfPaperDetailById($confpaperId) {
        $query = mysql_query("SELECT * FROM confrence c,confpaper cp WHERE c.confrenceId=cp.confrenceId AND cp.confpaperId=$confpaperId");
        return mysql_fetch_array($query);
    }

    function countDownloads($confrenceId) {
        $query = "SELECT SUM(cp.countpaper) as totaldownload FROM confpaper cp, confrence c WHERE c.confrenceId=cp.confrenceId ";
        if ($confrenceId != '') {
            $query .= "AND c.confrenceId=$confrenceId";
        }
        $query = mysql_query($query);
        if ($query != '') {
            return mysql_fetch_array($query);
        }
    }

    function updateConfrenceDownloads($confPaperId, $countpaper) {
//        mysql_query("update confpaper set countPaper=$countpaper where confpaperId=$confPaperId");
        mysql_query("update confpaper set countPaper=(countpaper+1) where confpaperId=$confPaperId");
    }

    function getConfPaperDetailId($confPaperId) {
        $query = mysql_query("SELECT * FROM confrence c,confpaper cp WHERE c.confrenceId=cp.confrenceId AND cp.confpaperId=$confPaperId");
        return mysql_fetch_array($query);
    }

    function getConfPaperRefDetail($confPaperId) {
        $query = mysql_query("SELECT r.referenceId,r.name,r.googleScholar,r.crossRef,r.publish FROM confrence c,confpaper cp,refrence r WHERE c.confrenceId=cp.confrenceId AND r.conferencePaperId=cp.confpaperId AND cp.confpaperId=$confPaperId");
        return $query;
    }

    function getStatisticsById($confrenceId) {
        $query = "SELECT * FROM confrence c, confpaper cp WHERE c.confrenceId=cp.confrenceId";
        if ($confrenceId != '') {
            $query .= " AND c.confrenceId=$confrenceId";
        }
        print $query;
        return mysql_query($query);
    }

}

?>
