<?php

class StatisticsService {

    function getStatisticsByIssueId($issueId) {
        //$query = "SELECT statisticsId,totalPaper,accepted,rejected,coverage,issueId FROM statistics WHERE issueId=$issueId";
        $query = "SELECT st.statisticsId
                            ,st.totalPaper
                            ,st.accepted
                            ,st.rejected
                            ,st.coverage
                            ,st.registered
                            ,jp.journalPaperId
                            ,jp.countPaper
                            ,jp.articleId
                            ,jp.tittle
                            ,jp.author
                            ,jp.fullpaper
                            ,jp.abspaper
                            ,i.issueId
                            ,i.status
                            ,i.year
                            ,i.issue
                            ,i.volume
                            ,i.month
                            ,j.acname
                            ,j.issnprint
                            ,j.issnonline
                            ,j.upload
                            FROM journalpaper jp
                            , issue i
                            , journals j
                            ,statistics st
                            WHERE i.issueId=jp.issueId
                            AND j.journalsId=i.journalId
                            AND i.issueId=st.issueId
                            AND i.issueId=$issueId";
        return mysql_fetch_array(mysql_query($query));
    }
    
    function getStatisticsByConfrenceId($confrenceId) {        
        $query = "SELECT st.statisticsId
                            ,st.totalPaper
                            ,st.accepted
                            ,st.rejected
                            ,st.coverage
                            ,st.registered
                            ,cp.confPaperId
                            ,cp.countPaper
                            ,cp.articleId
                            ,cp.tittle
                            ,cp.author
                            ,cp.fullpaper
                            ,cp.abspaper
                            ,c.name
                            ,c.confImage
                            ,c.confrenceId
                            FROM confpaper cp
                            , confrence c
                            ,statistics st
                            WHERE c.confrenceId=cp.confrenceId
                            AND st.confrenceId=c.confrenceId
                            AND cp.confrenceId=$confrenceId";
        return mysql_fetch_array(mysql_query($query));
    }

    function getIssueById($issueId){
        $query = "SELECT i.volume,i.issue,i.year,i.month,j.acname,j.journalsId FROM issue i,journals j WHERE j.journalsId=i.journalId AND issueId=$issueId";
        return mysql_fetch_array(mysql_query($query));
    }

    /*For 2019 and after features*/
    function getStats($volume,$volumeYear,$journalsId){
        $query = "SELECT statId, totalPaper, accepted, rejected, coverage, volume, volumeYear, message FROM stats WHERE volume = $volume AND volumeYear = $volumeYear AND journalsId=$journalsId";
        return mysql_fetch_array(mysql_query($query));
    }

}

?>
