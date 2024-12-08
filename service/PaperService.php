<?php
class PaperService{
    function getPaperSubmission(){
        $query = mysql_query("select * from papersubmission");
        return $query;
    }

    function getPaperSubmissionByPaperId($paperId){
        $query = mysql_query("select paperSubmissionId,paperId from papersubmission where paperId='$paperId'");
        return mysql_fetch_array($query);
    }

    function getPaperSubmissionAdmin(){
        $query = mysql_query("select * from papersubmission ps, user u, journals j where u.userId=ps.userId and j.journalsId=ps.journalId");
        return $query;
    }

    function maxPaperId(){
        $query = mysql_query("select MAX(paperID) as paperId from papersubmission");
        return mysql_fetch_array($query);
    }

    function getPaperSubmissionById($userId){
        $query = mysql_query("select * from papersubmission ps, journals j where j.journalsId=ps.journalId and userId=$userId");
        return $query;
    }

    function adlService($key, $title, $journals,$authors,$yearFrom,$yearTo,$file){
        $query = "select ps.coAuthorName,ps.uploadPaper,ps.manuScriptTitle,ps.authorName,ps.authorEmail,j.name  from user u, papersubmission ps, journals j where j.journalsId=ps.journalsId and u.userId=ps.userId ";
        
        
        if($key!=null){
            $query .=" and (ps.authorName like('%$key%') OR ps.manuScriptTitle like('%$key%') OR ps.authorName like('%$key5') OR j.name like('%$key%') OR ps.uploadPaper like('%$key%')) ";
        }

         if($title!=null){
             $query .= " and ps.manuScriptTitle like('%$title%') ";
        }
        if($journals!=null){
             $query .= " and j.name like('%$journals%') ";
        }
        if($authors!=null){
             $query .= " and ps.authorName like('%$authors%') ";
        }
        if($yearFrom!=null){
             $query .= " and ps.year like('%$yearFrom%') ";
        }
         if($yearTo!=null){
             $query .= " and ps.year like('%$yearTo%') ";
        }
        if($yearFrom!=null && $yearTo!=null){
             $query .= " and ps.year BETWEEN '$yearFrom' AND '$yearTo'";
        }
        if($file!=null){
            $query .=" and ps.uploadPaper like('%$file%') ";
        }        
        $query = mysql_query($query);        
        return $query;
    }
   
//    function currentIssue(){
//        $query = "select ps.paperSubmissionId,ps.coAuthorName,ps.uploadPaper,ps.manuScriptTitle,ps.authorName,ps.authorEmail,ps.countDownloads,ps.year from papersubmission ps where ps.decision='Grant'";
//        $query = mysql_query($query);
//        return $query;
//    }

    function countDownloads($paperSubmissionId){
        $query = mysql_query("select countDownloads from papersubmission where paperSubmissionId=$paperSubmissionId");
        return mysql_fetch_array($query);
    }

    function addCountDownloads($paperSubmissionId,$count){
       mysql_query("update papersubmission set countDownloads=$count where paperSubmissionId=$paperSubmissionId");        
    }

    function countTotaldownloads(){
        $query = mysql_query("select sum(countDownloads) as cd from papersubmission");
        return mysql_fetch_array($query);
    }
}
?>
