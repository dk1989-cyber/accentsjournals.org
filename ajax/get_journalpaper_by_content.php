<?php
include '../vendor/autoload.php';
include "../config/config.php";
extract($_REQUEST);

// $query = "SELECT pd.*,jp.title,jp.fullpaper,i.month,i.year,j.journal_abbri FROM pdfdata pd, journalpaper jp, journals j,issue i 
// WHERE jp.journalpaper_id=pd.journalpaper_id AND jp.issue_id=i.issue_id AND i.journals_id=j.journals_id";


if($key!=''){
    $keytrim=str_replace(' ', '', $key);
    $query = "SELECT jp.title,jp.record_type,jp.fullpaper,i.month,i.year,j.journal_abbri FROM journalpaper jp 
    LEFT JOIN issue i ON jp.issue_id = i.issue_id
    LEFT JOIN journals j ON i.journals_id=j.journals_id 
    WHERE ";
     $query .="  (jp.keyword like('%".$key."%') OR jp.keyword like('%".$keytrim."%'))";
     $stmt = $conn->query($query);
$i=1;
while(($row=$stmt->fetchAssociative())!==false){
       $a="";
        if($row["record_type"]=="NEW"){
            $m=$row["month"]+1;
            $url_=base_url("/".$row["journal_abbri"]."/".$row["year"]."/".$m."/".$row["fullpaper"]);
           
            $a="<a target='_blank' href='$url_' class='btn btn-sm btn-info'>View</a>";
        }
        else{
            $url=base_url($row["fullpaper"]);
            $a="<a target='_blank' href='$url' class='btn btn-sm btn-info'>View</a>";
        } 
        $data[]=array(
            $i,
            $row['title'],
            $a
        );
        $i=$i+1;
    }
    if(!empty($data)){
    $out=array("data"=>$data);
    }
    else{
    $out=array("data"=>[]);
    }
    echo json_encode($out);
}
else{
    $out=array("data"=>[]);
    echo json_encode($out);
}

// if($title!=''){
//     $query .= " AND (jp.tittle like('%".$title."%')) ";
// }
// if($journals!=''){
//     $query .= " AND (j.name like('%".$journals."%')) ";
// }
// if($authors!=''){
//     $query .= " AND (jp.author like('%".$authors."%')) ";
// }
// if($yearFrom!='' && $yearTo==''){
//     $query .= " AND (i.year like('%".$yearFrom."%')) ";
// }
// if($yearFrom=='' && $yearTo!=''){
//     $query .= " AND (i.year like('%".$yearTo."%')) ";
// }
// if($yearFrom!='' && $yearTo!=''){
//     $query .= " AND i.year BETWEEN  $yearFrom AND $yearTo";
// }
// if($issn!=''){
//     $query .= " AND (j.issnprint like('%".$issn."%')) ";
// }
// if($content!=''){
//     $query .= " AND (pd.pdfContent like('%".$key."%')) ";
// }
// if($keyword!=''){
//  
// }



?>