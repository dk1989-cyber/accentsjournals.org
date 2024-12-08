<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
  
 $sql = "SELECT e.*,d.designation as desig  FROM editorial_board e 
 LEFT JOIN designation d ON d.designation_id=e.designation where journals_id='$journals_id' order by e.ordby";
 $stmt = $conn->query($sql);

$root="";
$i=1;
$rows=$stmt->fetchAll();
$cnt=count($rows);
for($j=0;$j<$cnt;$j++){
 
    $name=$rows[$j]['name'];
    $photo=$rows[$j]['photo'];
    $ordby=$rows[$j]['ordby'];
    $editorial_board_id=$rows[$j]['editorial_board_id'];
    $university=$rows[$j]['university'];
    $desig=$rows[$j]['desig'];

    if($photo!=""){
        $journal_p=base_url('upload/journal_content/editorial_board/').$photo;
     }
    else
    {
        $journal_p="https://via.placeholder.com/200x200";
    }

    if($i==1){
    $ordr="<a onclick=sort($editorial_board_id,'DOWN',$ordby) class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
    }
    elseif($i==$cnt){
        $ordr="<a onclick=sort($editorial_board_id,'UP',$ordby) class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a></a>";
    }
    else{
        $ordr="<a onclick=sort($editorial_board_id,'UP',$ordby)  class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a><a onclick=sort($editorial_board_id,'down',$ordby)  class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
    }

    $l="<a class='btn btn-success btn-sm' onclick=edit_editor($editorial_board_id)><i class='fa fa-edit'></i></a><a class='btn btn-danger btn-sm' onclick=delete_editor($editorial_board_id)><i  class='fa fa-trash'></i></a>";
    $data[]=array(
        "<img src='$journal_p' style='width:100px;height:100px'/>",
        $name,
        $university,
        $desig,
        $ordr,
        $l
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