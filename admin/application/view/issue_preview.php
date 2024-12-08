<?php
include "basic/admin_header.php";
extract($_REQUEST);

$q="select i.*,j.journal_abbri from issue i
LEFT JOIN journals j ON j.journals_id=i.journals_id where i.issue_id=$id";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
extract($row);
?>
 
<div class="mainpanel">
<div class="contentpanel">
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> View Issue Preview</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>  Issue Preview <br><span style='margin-top:3px'>Month - <?=get_month($month)?> | Year - <?=$year?> | Volume - <?=$volume?>| Issue - <?=$issue?> | Journal - <?=$journal_abbri?></span></h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
          
           <div class="row">
                <div class="col-md-12">
            <div class="table-responsive">
            <table   class="table table-bordered table-striped-col">
              <thead>
                <tr>     
                    <th>Srno</th>
                    <th>Paper Title</th>
                    <th>Article Type</th>
                    <th>Discipline</th>
                    <th>Page</th>
                    <th>Order</th>
                    <th style='width:5%'>Action</th>
                </tr>
              </thead>
              <tbody id='issue_data'>
              </tbody>
            </table>
          </div>
          </div>
        </div>
        </div>
      </div>
    </div><!-- col-sm-6 -->
    <!-- ####################################################### -->
  </div><!-- row -->
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?>
<script>
$(document).ready(function() {
    get_issue_preview();
});

// function delete_directory(id,abbri,y,m){
//   if(confirm('Are you sure you want to delete')){
//       burl="../ajax/deleteDirectory.php";
//       $.post(burl,{"id":id,"abbri":abbri,"year":y,"month":m},function(data,status){
//          window.location.reload();
//       });
//   } 
// }

function get_issue_preview(){
  issue_id="<?=$id?>";  
  burl="../ajax/getIssuePreview.php";
      $.post(burl,{"issue_id":issue_id},function(data,status){
      $("#issue_data").html(data);
  });
}


function sort(direction,pid,series,current){
  issue_id="<?=$id?>";  
  burl="../ajax/issue_sorting.php";
  $.post(burl,{"id":pid,"issue_id":issue_id,"direction":direction,"series":series,"current":current},function(data,status){
     get_issue_preview();
  });
}

function change_pub(sts,journalpaper_id){
  issue_id="<?=$id?>";  
  burl="../ajax/changePublicationSts.php";
  $.post(burl,{"id":journalpaper_id,"publish_sts":sts,"issue":issue_id},function(data,status){
    get_issue_preview();
  });
}

function change_pub_all(sts){
  issue_id="<?=$id?>";  
  burl="../ajax/changePublicationStsAll.php";
  $.post(burl,{"publish_sts":sts,"issue":issue_id},function(data,status){
    get_issue_preview();
  });
}
</script>