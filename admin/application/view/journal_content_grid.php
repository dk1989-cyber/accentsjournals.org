<?php
include "basic/admin_header.php";
?>

<div class="mainpanel">
<div class="contentpanel">
  <?php
  extract($_REQUEST);
  $sql = "SELECT  j.journal_abbri,j.name FROM    journals j   
  where j.journals_id='$id'";
  $stmt = $conn->query($sql);
  $row=$stmt->fetchAssociative();
  extract($row);
  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Journal Content for <?=$journal_abbri?> </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Journal Content for <?=$name?> (<?=$journal_abbri?>)</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
             <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Sr.no</th>
                    <th>Menu </th>
                    
                    <th style='width:8%'>Order By</th>
                    <th>Status</th>
                    
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT * FROM front_menu where journals_id='$id' order by `order_b` ASC";
                 $stmt = $conn->query($sql);
                 $i=1;
                 $rows=$stmt->fetchAll();
                 $cnt=count($rows);
                 for($j=0;$j<$cnt;$j++){   
                    $front_menu_id=$rows[$j]["front_menu_id"];
                    $order_b=$rows[$j]["order_b"];
                    $menu_name=$rows[$j]["menu_name"];
                    $menu_url=$rows[$j]["menu_url"];
                    $menu_url_back=$rows[$j]["menu_url_back"];
                    $status=$rows[$j]["status"];
                    $menu_type=$rows[$j]["menu_type"];
                    $type=$rows[$j]["type"];
                    if($i==1){
                     $ordr="<a onclick=sort($front_menu_id,'DOWN',$order_b) class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                    }
                    elseif($i==$cnt){
                      $ordr="<a onclick=sort($front_menu_id,'UP',$order_b) class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a></a>";
                    }
                    else{
                      $ordr="<a onclick=sort($front_menu_id,'UP',$order_b)  class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a><a onclick=sort($front_menu_id,'DOWN',$order_b)  class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                    }



                    if($status=="Enable"){
                      $lbl="<span style='cursor:pointer' onclick=change_sts('Disable',$front_menu_id) class='label label-success'>Enable</span>";
                    }
                    else{
                      $lbl="<span style='cursor:pointer'  onclick=change_sts('Enable',$front_menu_id) class='label label-danger'>Disable</span>";
                    }


                    ?>
                      <tr>
                        <td style='width:5%'><?=$i?></td>
                        <td>
                          
                          <a href="<?=$menu_url_back?>?id=<?=$id?>&type=<?=$type?>"><?=$menu_name?></a>
                        </td>
                        <td style='text-align:center'><?=$ordr?></td>
                        <td style='width:10%'><?=$lbl?></td>
                      
                      </tr>
                 <?php
                 $i=$i+1;
                 }
                 ?>
              </tbody>
            </table>
          </div>
                </div>
             </div>
        </div>
     </div>
    </div><!-- col-sm-6 -->
    
  </div><!-- row -->

</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";

?>
<script>
$(document).ready(function() {
  'use strict';
  $('#dataTable1').DataTable();
});


function change_sts(sts,id){
  $.ajax({
    url: "../action/change_menu_sts.php",
    type: "POST",
    data: {sts: sts,id: id},
    success: function(data) {
     location.reload();
    }
  });
}


function sort(id,ordr,pos){
  var burl="../action/sortFrontMenu.php";
  $.post(burl,{"id":id,"ordr":ordr,"order_b":pos},function(data,status){
   window.location.reload();
  });
}
</script>
