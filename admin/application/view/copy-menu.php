<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Menu</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Menu Copy</h4>
        </div>
        
        <div class="panel-body" style='margin-top:10px'>
            <div class="col-md-12">
                        <table class='table'>
                        <?php
                        $q="select * from journals";
                        $stmt = $conn->query($q);
                        while(($row=$stmt->fetchAssociative())!==false){
                            extract($row);
                        ?>
                        <tr>
                            <td><?=$journal_abbri?></td>
                            <td>
                                <a onclick="copy_menu(<?=$journals_id?>)" class='btn btn-success'>Copy Menu</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
            </div>    
         </div>    
       </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
  <?php

  ?>
   <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Journals</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Sr.no</th>
                    <th>Journal Name</th>
                     <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT j.*,(select count(*) from front_menu where journals_id=j.journals_id) as cnt  FROM   journals j" ;
                 $stmt = $conn->query($sql);
                 $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                   if($cnt==0){
                    continue;
                   }
                ?>
                      <tr>
                        <td style='width:5%'><?=$i?></td>
                        <td><?=$journal_abbri?></td>
                         <td><a class='btn btn-sm btn-danger' onclick="delete_journal_menu(<?=$journals_id?>)"><i class='fa fa-trash'></i></a></td>
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

function reset_menu(id){
  if(confirm("Are you sure")){
       burl="../action/resetMenuJournal.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

function delete_journal_menu(id){
  if(confirm("Are you sure")){
       burl="../action/deleteMenuJournal.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

function copy_menu(id){
    burl="../action/copyFrontTempMenu.php"; 
    $.post(burl,{"jid":id},function(data,status){
      window.location.reload();
    });
}

function sort(id,ordr,pos){
  var burl="../action/sortArticleType.php";
  $.post(burl,{"id":id,"ordr":ordr,"order_b":pos},function(data,status){
   window.location.reload();
  });
}
 
</script>
