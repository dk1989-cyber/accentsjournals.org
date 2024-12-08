 
<?php

session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$q="select jp.*,a.article_type,d.discipline,i.*,(select GROUP_CONCAT(orders ORDER BY orders) ordsbs from journalpaper where issue_id='$issue_id') as series,j.journal_abbri from journalpaper jp 
left join article_type a on a.article_type_id=jp.article_type_id
left join discipline d on d.discipline_id=jp.discipline
left join issue i on jp.issue_id=i.issue_id
left join journals j on i.journals_id=j.journals_id 
where jp.issue_id='$issue_id' order by jp.orders ASC";

$stmt = $conn->query($q);
$i=1;
$tr="";
while(($row=$stmt->fetchAssociative())!==false){
   extract($row);

   $rep=str_replace(",","-",$series);
   $repa=explode("-",$rep);
   $top="";
   $down="";
   $cnt=count($repa)-1;
   if($repa[0]==$orders){
     $top="";
   }
   else{
    $top="<a class='btn btn-success btn-sm' onclick=sort('UP',$journalpaper_id,'$series','$orders')><i class='fa fa-arrow-up'></i></a> ";
   }
   if($repa[$cnt]==$orders){
     $down="";
   }
   else{
     $down="<a onclick=sort('DOWN',$journalpaper_id,'$series','$orders') class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
   }

   $p=($is_publish!=0)?"<a class='btn btn-success btn-sm' onclick=change_pub(0,$journalpaper_id)><i style='margin-right:5px' class='fa fa-check-circle'></i>Published</a>":"<a class='btn btn-default btn-sm' onclick=change_pub(1,$journalpaper_id)><i class='fa fa-clock-o'></i> Unpublished</a>";
  
  // $m=($modification_type!="")?"<span class='badge badge-alert'>$modification_type</span>":"";

  $m="";
  if($modification_type!=""){
   if($link_id!=0){
        
        $q6="select issue_id from journalpaper where journalpaper_id  = $link_id";
        $stmt6 = $conn->query($q6);
        $row6=$stmt6->fetchAssociative();
        $issue_id=$row6["issue_id"];
        $m="<a class='badge badge-alert' href='issue_preview.php?id=$issue_id&l=$link_id'>$modification_type</a>";
   }
   else{
    $m="<a class='badge badge-danger' style='background-color:red'>$modification_type</a>";
   }
  }

   $tr.=
   "<tr>
       <td>$i</td>
       <td>$title <br/>$m</td>
       <td>$article_type</td>
       <td>$discipline</td>
       <td>$page_no_start-$page_no_end</td>
       <td style='text-align:center'>$top.$down</td>
       <td style='width:15%'> $p <a class='btn btn-success btn-sm' href=edit_paper.php?id=$journalpaper_id><i class='fa fa-edit'></i></a></td>
       
   </tr>";

   $i=$i+1;
}
echo $tr;
?>
<tr>
    
</tr>
<tr>
    
</tr>
<tr>
    <td colspan='6'><a onclick="change_pub_all(1)" class='btn btn-success'>Publish Issue</a> 
    <a class='btn btn-default' onclick="change_pub_all(0)">UnPublish Issue</a> 
    <a href="view_directory.php" class='btn btn-danger'>Back</a></td>
</tr>