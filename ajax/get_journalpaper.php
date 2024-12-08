<?php
include '../vendor/autoload.php';
include "../config/config.php";
extract($_REQUEST);
$sql = "SELECT jp.title,jp.record_type,jp.fullpaper,jp.authors,i.month,i.year,j.journal_abbri 
FROM journalpaper jp 
LEFT JOIN issue i ON i.issue_id=jp.issue_id
LEFT JOIN journals j ON 
i.journals_id=j.journals_id 
where i.journals_id='$jid' and YEAR(jp.`datetime`)=$y";
$stmt = $conn->query($sql);
$i=1;
while(($row=$stmt->fetchAssociative())!==false){
    if($row["record_type"]=="NEW"){
        $m=$row["month"]+1;
        $pth=base_url()."/".$row["journal_abbri"]."/".$row["year"]."/".$m."/".$row["fullpaper"];
        $url=base_url($pth);
        $a="<a target='_blank' href='$url; class='btn btn-sm btn-info'>View</a>";
    }
    else{

        $url=base_url($row["fullpaper"]);
        $a="<a target='_blank' href='$url' class='btn btn-sm btn-info'>View</a>";
    }
   
    $data[]=array(
        $i,
        $row['journal_abbri'],
        $row['title'],
        $row['authors'],
        $y,
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
?>