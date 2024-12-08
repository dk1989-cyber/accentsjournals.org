<?php
 
class JournalsService {
   public $conn;
     function __construct($conn){
        $this->conn=$conn;
    }
    function getJournls() {
        $query = mysql_query("select * from journals");
        return $query;
    }

    function deleteJournals($journalsId) {
        $query = mysql_query("delete from journals where journalsId=$journalsId");
    }

    function getJournalsById($journalsId) {
        $query = mysql_query("select * from journals where journalsId=$journalsId");
        return mysql_fetch_array($query);
    }

    function getConference() {
        $query = mysql_query("select * from confrence");
        return $query;
    }

    function getIssue($issueId) {
        $query = "SELECT j.journalsId,j.acname, i.issueId, i.year, i.volume, i.number, i.issue, i.month, i.status FROM issue i, journals j WHERE j.journalsId=i.journalId";
        if ($issueId != '') {
            $query.=" AND i.issueId=$issueId ";
        }
        $query = mysql_query($query);
        return $query;
    }

    function deleteIssue($issueId) {
        $query = mysql_query("delete from issue where issueId=$issueId");
    }

    function currentIssue($journalsId) {
        $query = "SELECT jp.journalPaperId,jp.countPaper,jp.articleId,jp.tittle,jp.author,jp.fullpaper,jp.abspaper,jp.pageNo,jp.paperImage,i.issueId,i.status,i.year,i.issue,i.month,j.acname,j.issnprint,j.issnonline,j.upload,jp.article_type,jp.type_text FROM journalpaper jp, issue i, journals j WHERE i.issueId=jp.issueId AND j.journalsId=i.journalId AND i.status='Current'";
        if ($journalsId != '') {
            $query .= " AND j.journalsId=$journalsId ORDER By i.issueId DESC";
        }
        // die($query);
        return mysql_query($query);
    }

    function allIssueByIssueId($issueId) {
        $query = "SELECT jp.journalPaperId,jp.countPaper,jp.articleId,jp.tittle,jp.author,jp.fullpaper,jp.abspaper,i.issueId,i.status,i.year,i.issue,i.month,j.acname,j.issnprint,issnonline,j.upload,jp.pageNo,jp.paperImage FROM journalpaper jp, issue i, journals j WHERE i.issueId=jp.issueId AND j.journalsId=i.journalId AND i.status='Current'";
        if ($issueId != '') {
            $query .= " AND i.issueId=$issueId ORDER By i.issueId DESC";
        }
        return mysql_query($query);
    }

    function previousIssue($issueId) {
        $query = "SELECT jp.article_type,jp.type_text,jp.journalPaperId,jp.countPaper,jp.articleId,jp.tittle,jp.author,jp.fullpaper,jp.abspaper,jp.paperImage,jp.doi,i.issueId,i.volume,i.year,i.issue,i.month,j.name,j.acname,j.issnprint,issnonline,j.upload,jp.pageNo,i.status  FROM journalpaper jp, issue i, journals j WHERE i.issueId=jp.issueId AND j.journalsId=i.journalId AND i.status='Previous' AND i.issueId=$issueId ORDER By i.issueId DESC";

        return mysql_query($query);
    }

    function allIssueByJournalsId($journalsId) {
        $query = "SELECT DISTINCT j.journalsId, j.acname, i.year FROM journalpaper jp LEFT JOIN issue i ON  jp.issueId=i.issueId LEFT JOIN journals j ON  j.journalsId=i.journalId WHERE j.journalsId=$journalsId ORDER By i.issueId DESC";
        return mysql_query($query);
    }

    function currentIssueByJournalsId($journalsId) {
        
        $query = mysql_query("SELECT j.journalsId,j.name,j.acname,j.issnprint,j.issnonline,j.upload,j.msg,j.status as jstatus,i.year,i.volume,i.number,i.issue,i.month,i.status,i.datetime from journals j, issue i WHERE j.journalsId=i.journalId AND journalsId=$journalsId");
        return mysql_fetch_array($query);
    }

    function getJournalDetail() {
        $query = mysql_query("SELECT jp.articleId,jp.tittle,jp.author,jp.fullpaper,i.year,i.issue,i.month,j.acname,j.name,j.issnprint,issnonline,j.upload FROM journalpaper jp, issue i, journals j WHERE i.issueId=jp.issueId AND j.journalsId=i.journalId AND i.status='Current'");
        return mysql_fetch_array($query);
    }

function getJournalDetailVIM($journalsId,$issueId) {
        $query = "SELECT i.issueId,i.year,i.volume,i.issue,i.month,i.mode,i.coverImage,i.issueTitle,i.issueDetail,i.detailWeblink,i.weblink,j.name,j.acname,j.issnprint,issnonline,j.upload FROM issue i, journals j WHERE j.journalsId=i.journalId AND i.status='Previous'";
        if ($journalsId != '') {
            $query .= " AND j.journalsId=$journalsId";
        }
        if ($journalsId != '') {
            $query .= " AND i.issueId=$issueId";
        }
        $query = mysql_query($query);
        return mysql_fetch_array($query);
    }


    function getPaper($pi) {
        $month = $pi['month'];
        $paperpath = '';
        if (in_array($month, unserialize(THREE))) {
            $paperpath = PARENT_DIR . "/" . JOURNAL_DIR . "/" . $pi['acname'] . "/" . $pi['year'] . "/" . "3" . "/" . $pi['fullpaper'];
        }
        if (in_array($month, unserialize(SIX))) {
            $paperpath = PARENT_DIR . "/" . JOURNAL_DIR . "/" . $pi['acname'] . "/" . $pi['year'] . "/" . "6" . "/" . $pi['fullpaper'];
        }
        if (in_array($month, unserialize(NINE))) {
            $paperpath = PARENT_DIR . "/" . JOURNAL_DIR . "/" . $pi['acname'] . "/" . $pi['year'] . "/" . "9" . "/" . $pi['fullpaper'];
        }
        if (in_array($month, unserialize(TWELVE))) {
            $paperpath = PARENT_DIR . "/" . JOURNAL_DIR . "/" . $pi['acname'] . "/" . $pi['year'] . "/" . "12" . "/" . $pi['fullpaper'];
        }
        return $paperpath;
    }


    function previousIssueByYear($journalsId, $year) {
        $query = "SELECT DISTINCT i.issueId,i.year,i.volume,i.issue,i.month,j.journalsId,j.acname,j.issnprint,issnonline,j.upload FROM issue i, journals j WHERE j.journalsId=i.journalId AND i.status='Previous' AND j.journalsId=$journalsId AND i.year=$year ORDER By i.issueId DESC";
        //print $query;
        return mysql_query($query);
    }

    function allIssueByYear($journalsId, $year) {
        $query = "SELECT DISTINCT i.issueId,i.year,i.volume,i.issue,i.month,j.acname,j.issnprint,issnonline,j.upload,j.journalsId FROM issue i, journals j WHERE j.journalsId=i.journalId AND j.journalsId=$journalsId AND i.year=$year ORDER By i.issueId DESC";
//print $query;
        return mysql_query($query);
    }

    function previousIssueAll() {
        $query = "SELECT i.issueId,i.year,i.volume,i.issue,i.month,j.acname,j.issnprint,issnonline,j.upload FROM issue i, journals j WHERE j.journalsId=i.journalId AND i.status='Previous'";
        return mysql_query($query);
    }

    function previousIssueByJournalId($journalsId) {
        $query = "SELECT DISTINCT j.journalsId, i.year FROM journalpaper jp LEFT JOIN issue i ON  jp.issueId=i.issueId LEFT JOIN journals j ON  j.journalsId=i.journalId WHERE i.status='Previous' AND j.journalsId=$journalsId ORDER By i.issueId DESC";
        return mysql_query($query);
    }

    function piByJId($journalsId) {
        $query = mysql_query("SELECT jp.journalPaperId,jp.countPaper,jp.articleId,jp.tittle,jp.author,jp.fullpaper,jp.abspaper,i.issueId,i.volume,i.year,i.issue,i.month,j.acname,j.issnprint,issnonline,j.upload,jp.datetime FROM journalpaper jp, issue i, journals j WHERE i.issueId=jp.issueId AND j.journalsId=i.journalId AND i.status='Previous' AND j.journalsId=$journalsId");
        return $query;
    }

    function getJournalDetailP($journalsId) {
        $query = "SELECT i.issueId,i.year,i.volume,i.issue,i.month,j.name,j.acname,j.issnprint,issnonline,j.upload FROM issue i, journals j WHERE j.journalsId=i.journalId AND i.status='Previous'";
        if ($journalsId != '') {
            $query .= " AND j.journalsId=$journalsId";
        }
        $query = mysql_query($query);
        return mysql_fetch_array($query);
    }

    function getJournalDetailByIssueId($issueId) {
        $query = "SELECT i.issueId,i.year,i.volume,i.number,i.issue,i.month,j.name,j.acname,j.issnprint,issnonline,j.upload FROM issue i, journals j WHERE j.journalsId=i.journalId ";
        if ($issueId != '') {
            $query .= " AND i.issueId=$issueId";
        }
        $query = mysql_query($query);
        return mysql_fetch_array($query);
    }

function currentIssueVIM($journalsId) {
        $query = mysql_query("SELECT j.journalsId,j.name,j.acname,j.issnprint,j.issnonline,j.upload as jstatus,i.year,i.volume,i.number,i.issue,i.month,i.status,i.datetime,i.issueTitle,i.issueDetail,i.detailWeblink,i.weblink,i.mode,i.coverImage from journals j, issue i WHERE j.journalsId=i.journalId AND journalsId=$journalsId AND i.status='Current'");
        return mysql_fetch_array($query);
    }

    function countDownloads($issueId) {
        $query = "SELECT SUM(jp.countpaper) as totaldownload FROM journalpaper jp, issue i WHERE i.issueId=jp.issueId";
        if ($issueId != '') {
            $query .= " AND i.issueId=$issueId";
        }
        $query = mysql_query($query);
        return mysql_fetch_array($query);
    }

    function countDownloadsCI($journalsId) {
        $query = "SELECT SUM(jp.countPaper) as totaldownload FROM journalpaper jp, issue i,journals j WHERE i.issueId=jp.issueId AND i.status='Current' AND j.journalsId=i.journalId ";
        if ($journalsId != '') {
            $query .= "AND j.journalsId=$journalsId";
        }
        $query = mysql_query($query);
        if ($query != '') {
            return mysql_fetch_array($query);
        }
    }

    function countDownloadJP($journalPaperId) {
        $query = "SELECT SUM(jp.countpaper) as totaldownload FROM journalpaper jp WHERE jp.journalPaperId=$journalPaperId";
        $query = mysql_query($query);
        return mysql_fetch_array($query);
    }

    function updateDownloads($journalPaperId, $countpaper) {
        //        mysql_query("update journalpaper set countPaper=$countpaper where journalPaperId=$journalPaperId");
        mysql_query("update journalpaper set countPaper=(countPaper+1) where journalPaperId=$journalPaperId");
    }

    function getJournalIssue($start,$limit) {
        $query = "SELECT * FROM journalpaper LIMIT $start, $limit";
        return mysql_query($query);
    }

    function countJournalIssue() {
        $query = "SELECT count(*) as `total` FROM journalpaper";
        $query = mysql_query($query);
        return mysql_fetch_assoc($query);
    }

    function getPaperNameByPath($fullpaper) {
        $query = "SELECT tittle FROM journalpaper WHERE fullpaper='$fullpaper'";
        $query = mysql_query($query);
        return mysql_fetch_array($query);
    }

    function deleteJournalPaper($journalPaperId) {
        $query = "DELETE FROM journalpaper WHERE journalPaperId=$journalPaperId";
        mysql_query($query);
        $query = "DELETE FROM authornamesjp WHERE journalPaperId=$journalPaperId";
        mysql_query($query);
    }

    function getJournalPaperById($journalPaperId) {
        $query ="SELECT jp.journalpaper_id,jp.countpaper,jp.articleId,jp.title,jp.authors,jp.fullpaper,jp.abstract,jp.paperImage,jp.keyword,i.volume,i.year,i.issue,i.month,j.journal_abbri,j.name,j.issnprint,issnonline,jp.page_no_start,jp.page_no_end,jp.doilink,jp.article_type_id,jp.type_text  FROM journalpaper jp, issue i, journals j WHERE i.issue_id=jp.issue_id AND j.journals_id=i.journals_id AND jp.journalpaper_id='$journalPaperId'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getPaperImageById($issueId,$journalPaperId) {
        $query = mysql_query("SELECT jp.paperImage FROM journalpaper jp WHERE issueId=$issueId AND journalPaperId=$journalPaperId AND paperImage IS NOT NULL");
        return mysql_fetch_array($query);
    }
    function getAllPaperImageById($issueId) {
        $query = mysql_query("SELECT jp.paperImage FROM journalpaper jp WHERE issueId=$issueId AND paperImage <> '' AND paperImage IS NOT NULL");
        return mysql_num_rows($query);
    }

    function getAuthorNamesById($journalPaperId,$t=0,$mode="paper") {
        if($mode=="paper"){
                if($t!=0){
                    $query="SELECT * FROM authornamesjp WHERE journalpaper_id=$journalPaperId and is_corresponding='1'";
                    $stmt = $this->conn->query($query);
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                else{
                    $query="SELECT * FROM authornamesjp WHERE journalpaper_id=$journalPaperId";
                    $stmt = $this->conn->query($query);
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
        }
        else{
            if($t!=0){
                $query="SELECT * FROM authornamespp WHERE press_paper_id=$journalPaperId and is_corresponding='1'";
                $stmt = $this->conn->query($query);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                $query="SELECT * FROM authornamespp WHERE press_paper_id=$journalPaperId";
                $stmt = $this->conn->query($query);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }

    function getDoiById($issueId,$journalPaperId) {
        $query = mysql_query("SELECT jp.doi,jp.doiLink FROM journalpaper jp WHERE issueId=$issueId AND journalPaperId=$journalPaperId");
        return mysql_fetch_array($query);
    }
    function getSearchedItem($journalPaperId,$year) {
        $query = "SELECT jp.tittle, jp.author, i.year, jp.fullpaper, j.acname, j.journalsId FROM journalpaper jp INNER JOIN issue i on jp.issueId = i.issueId INNER JOIN journals j on i.journalId = j.journalsId";
        if ($year != '' || $journalPaperId != '') {
            $query.=" WHERE ";
        }
        if ($year != '') {
            $query.="year = $year ";
            if ($journalPaperId!='') {
                $query .= " AND ";
            }
        }
        if ($journalPaperId != '') {
            $query.="j.journalsId = $journalPaperId";
        }
        $query = mysql_query($query);
        return $query;
    }

    
    function getJournalPaperRef($journalPaperId) {
        $query = mysql_query("SELECT r.referenceId,r.name,r.crossRef,r.googleScholar,r.publish FROM journalpaper jp, issue i, journals j,refrence r WHERE i.issueId=jp.issueId AND j.journalsId=i.journalId AND r.journalPaperId=jp.journalPaperId AND jp.journalPaperId=$journalPaperId");
        return $query;
    }
    function getCoverImage($issueId){
        $query = mysql_query("SELECT coverImage FROM issue WHERE status = 'current' AND issueId= $issueId ");
        return mysql_fetch_array($query);
    }
    function getSpecialIssueById($journalsId) {
        $query = mysql_query("SELECT j.journalsId, i.issueId, i.volume,i.number,i.issue,i.mode from journals j, issue i WHERE j.journalsId=i.journalId AND journalsId=$journalsId AND i.mode='special' ORDER BY j.journalsId DESC");
        return $query;
    }
    function specialIssue($issueId) {
        $query = "SELECT jp.journalPaperId,jp.countPaper,jp.articleId,jp.tittle,jp.author,jp.fullpaper,jp.abspaper,jp.paperImage,jp.doi,i.issueId,i.volume,i.year,i.issue,i.month,j.name,j.acname,j.issnprint,issnonline,j.upload,jp.pageNo,i.status  FROM journalpaper jp, issue i, journals j WHERE i.issueId=jp.issueId AND j.journalsId=i.journalId AND i.issueId=$issueId ORDER By i.issueId DESC";

        return mysql_query($query);
    }
    function getJournalDetailS($journalsId,$issueId) {
        $query = "SELECT i.issueId,i.year,i.volume,i.issue,i.month,j.name,j.acname,j.issnprint,issnonline,j.upload FROM issue i, journals j WHERE j.journalsId=i.journalId";
        if ($journalsId != '') {
            $query .= " AND j.journalsId=$journalsId";
        }
        if ($issueId != '') {
            $query .= " AND i.issueId=$issueId";
        }
        $query = mysql_query($query);
        return mysql_fetch_array($query);
    }
    function getJournalDetailVIMS($journalsId,$issueId) {
        $query = "SELECT i.issueId,i.year,i.volume,i.issue,i.month,i.mode,i.coverImage,i.issueTitle,i.issueDetail,i.detailWeblink,i.weblink,j.name,j.acname,j.issnprint,issnonline,j.upload FROM issue i, journals j WHERE j.journalsId=i.journalId AND i.status='Previous'";
        if ($journalsId != '') {
            $query .= " AND j.journalsId=$journalsId";
        }
        if ($issueId != '') {
            $query .= " AND i.issueId=$issueId";
        }
        $query = mysql_query($query);
        return mysql_fetch_array($query);
    }
    
    function adlSearch($key,$title,$journals,$authors,$yearFrom,$yearTo,$issn,$content,$keyword,$start,$limit){
        $query = "SELECT pd.pdfDataId,jp.tittle, jp.fullpaper,j.name,jp.author,i.year,j.issnprint,jp.keyword FROM pdfdata pd, journalpaper jp, journals j,issue i WHERE jp.journalPaperId=pd.journalPaperId AND jp.issueId=i.issueId AND i.journalId=j.journalsId ";
        if($key!=''){
                $query .= " AND (pd.pdfContent like('%".$key."%')) ";
        }
        if($title!=''){
                $query .= " AND (jp.tittle like('%".$title."%')) ";
        }
        if($journals!=''){
                $query .= " AND (j.name like('%".$journals."%')) ";
        }
        if($authors!=''){
                $query .= " AND (jp.author like('%".$authors."%')) ";
        }
        if($yearFrom!='' && $yearTo==''){
                $query .= " AND (i.year like('%".$yearFrom."%')) ";
        }
        if($yearFrom=='' && $yearTo!=''){
                $query .= " AND (i.year like('%".$yearTo."%')) ";
        }
        if($yearFrom!='' && $yearTo!=''){
                $query .= " AND i.year BETWEEN  $yearFrom AND $yearTo";
        }
        if($issn!=''){
                $query .= " AND (j.issnprint like('%".$issn."%')) ";
        }
        if($content!=''){
                $query .= " AND (pd.pdfContent like('%".$key."%')) ";
        }
        if($keyword!=''){
                $query .= " AND (jp.keyword like('%".$keyword."%')) ";
        }
        $query .=  " LIMIT $start, $limit";
        return mysql_query($query);
    }
    function adlSearchCount($key,$title,$journals,$authors,$yearFrom,$yearTo,$issn,$content,$keyword){
        $query = "SELECT COUNT(jp.tittle) as total FROM pdfdata pd, journalpaper jp, journals j,issue i WHERE jp.journalPaperId=pd.journalPaperId AND jp.issueId=i.issueId AND i.journalId=j.journalsId ";
        if($key!=''){
                $query .= " AND (pd.pdfContent like('%".$key."%')) ";
        }
        if($title!=''){
                $query .= " AND (jp.tittle like('%".$title."%')) ";
        }
        if($journals!=''){
                $query .= " AND (j.name like('%".$journals."%')) ";
        }
        if($authors!=''){
                $query .= " AND (jp.author like('%".$authors."%')) ";
        }
        if($yearFrom!='' && $yearTo==''){
                $query .= " AND (i.year like('%".$yearFrom."%')) ";
        }
        if($yearFrom=='' && $yearTo!=''){
                $query .= " AND (i.year like('%".$yearTo."%')) ";
        }
        if($yearFrom!='' && $yearTo!=''){
                $query .= " AND i.year BETWEEN  $yearFrom AND $yearTo";
        }
        if($issn!=''){
                $query .= " AND (j.issnprint like('%".$issn."%')) ";
        }
        if($content!=''){
                $query .= " AND (pd.pdfContent like('%".$key."%')) ";
        }
        if($keyword!=''){
                $query .= " AND (jp.keyword like('%".$keyword."%')) ";
        }
        $query = mysql_query($query);        
        return mysql_fetch_array($query);
    }


    function deleteReference($referenceId) {
        $query = mysql_query("delete from refrence where referenceId=$referenceId");
    }
}

?>
