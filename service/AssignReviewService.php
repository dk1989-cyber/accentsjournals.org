<?php
class AssignReviewService{
    function getAssignReview($userId){
        $query = mysql_query("select j.acname,ar.uploadPaper,ar.reviewReport,ar.assignDate,ps.paperId,ar.userIdFrom,ar.status from assignreview ar, user u, journals j,papersubmission ps where u.userId=ar.userIdFrom and j.journalsId=ar.journalsId and ps.paperSubmissionId=ar.paperSubmissionId and userIdTo=$userId");
        return $query;
    }

    function getReviewerStatistic(){
        $query = mysql_query("select u.firstName,u.lastName,ar.userIdTo,ar.userIdFrom,ar.completedDate,ar.assignDate,ar.status as arStatus,u.status from assignreview ar, user u where u.userId=ar.userIdFrom and u.role='Reviewer'");
        return $query;
    }

    function getAdminReview($userId){
        //$query = mysql_query("select ar.assignReviewId,ps.paperId,u.firstName,u.lastName,j.acname,ps.tittle,ar.reviewReport,ar.status from assignreview ar, papersubmission ps, user u, journals j where j.journalsId=ps.journalId and ps.paperSubmissionId=ar.paperSubmissionId and u.userId=ar.userIdFrom and userIdTo=$userId");
        $query = mysql_query("select ar.assignReviewId,ps.paperId,u.firstName,u.lastName,j.acname,ps.tittle,ar.reviewReport,ar.status from assignreview ar, papersubmission ps, user u, journals j where j.journalsId=ps.journalId and ps.paperSubmissionId=ar.paperSubmissionId and u.userId=ar.userIdFrom and u.role!='Super Admin'");
        return $query;
    }
}

?>
