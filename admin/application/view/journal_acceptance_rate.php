<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  <?php
  extract($_REQUEST);
  $sql = "SELECT * FROM journals where journals_id='$journals_id'";
  $stmt = $conn->query($sql);
  $row=$stmt->fetchAssociative();
  extract($row);

  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  <?=$journal_abbri?> - Acceptance Rate  </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Acceptance Rate - (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/adJournalAcceptance.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Year</label>
                       <select  onchange="get_volume()" class='form-control' name="year" id="year">
                           <?php
                           for($i=2011;$i<=date('Y');$i++){
                           ?>
                            <option value="<?=$i?>"><?=$i?></option>
                           <?php
                           }
                           ?>
                       </select>
                  </div>

                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Volume</label>
                       <input type="text" value="" readonly name='volume' id='volume' placeholder="Volume"   class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Recieved Paper</label>
                       <input type="hidden" name='id' value="<?=$journals_id?>">
                       <input type="text" onkeyup="get_rejected_paper('ADD');" value="" name='totalpaper' id='totalpaper' placeholder="Recieved Paper"   class="form-control" />
                  </div>

                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Accepted</label>
                      <input type="text" value=""  onkeyup="get_rejected_paper('ADD');"   name='accepted' id='accepted' placeholder="Accepted"   class="form-control" />
                  </div>

                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Rejected</label>
                      <input type="text" readonly value="" name='rejected' id='rejected' placeholder="Rejected"  class="form-control" />
                  </div>
                   <div class="form-group col-md-12">
                       <label class='lbl' for="">Rejected Countries</label>
                       <select class="form-control js-example-basic-multiple select2" name="countries[]" id="countries" multiple="multiple">
                              <?php
                                 $sql = "SELECT * from country";
                                 $stmt = $conn->query($sql);
                                 $i=1;
                                while(($row=$stmt->fetchAssociative())!==false){
                                extract($row);
                                ?>
                                <option value="<?=$country_id?>"><?=$name?></option>
                                <?php
                                 }
                              ?>
                     </select>    
                  </div>
                  
                       
                  
                  
            </div>
           <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <a   class='btn btn-danger'>Back</a>
            <button  class='btn btn-info'><b>Add  </b></button>
           
            </div>
        </div>
       </div>
      </form>
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
  <?php

  ?>
   <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Acceptance Rate for  <?=$journal_abbri?></h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
              <table id="datatable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Year</th>
                    <th>Recieved Paper</th>
                    <th>Accepted</th>
                    <th style='width:30%'>Countries</th>
                    <th style='width:15%;text-align:center'>AR(%)</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT a.* from paper_acceptance_rate a where a.journals_id='$journals_id'";
                 $stmt = $conn->query($sql);
                 $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);

                    if($record_type=="NEW"){
                      $q3="select group_concat(distinct university_id) as uid from authornamesjp where journals_id='$journals_id' and year='$volume_year'";
                      $stmt3=$conn->query($q3);
                      $row3=$stmt3->fetchAssociative();
                      if(!empty($row3)){
                          extract($row3);
                          if(!is_null($uid)){
                              $q4="select group_concat(distinct c.name) as cntry from country c 
                              LEFT JOIN ad_university u ON  u.country=c.country_id where u.ad_university_id IN ($uid)";
                              $stmt4=$conn->query($q4);
                              $row4=$stmt4->fetchAssociative();
                              extract($row4);
                          }
                          else{
                              $cntry="Not Available";
                          }
                      }
                      else{
                          $cntry="Not Available";
                      }
              }
              else{
                  $cntry=$countries_name;
              }


                ?>
                      <tr>
                        <td><?=$volume_year?></td>
                        <td><?=$totalpaper?></td>
                        <td><?=$accepted?></td>
                        <td><b><?=$cntry?>,<?=$countries_name?></b></td>
                        <td><?=round(($accepted/$totalpaper)*100,2)?>%</td>
                        <td><a class='btn btn-success btn-sm' onclick="edit_acceptance_rate('<?=$paper_acceptance_rate_id?>')"><i class='fa fa-edit'></i></a><a class='btn btn-danger btn-sm' onclick="delete_acceptance_rate(<?=$paper_acceptance_rate_id?>)"><i  class='fa fa-trash'></i></a></td>
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



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id='title'>Edit   Acceptance Rate</h4>
      </div>
      <div class="modal-body">
        <form action="../action/updateJournalAcceptance.php" method='post'  >
            <div class="panel-body" style='margin-top:10px'>
              <div class="row">
                      <div class="form-group col-md-3">
                          <label class='lbl' for="">Year</label>
                         <input class='form-control' type="text" name='eyear' id='eyear' readonly>  
                     </div>
                     <div class="form-group col-md-3">
                          <label class='lbl' for="">Volume</label>
                         <input   class='form-control' type="text" name='evolume' id='evolume' readonly>  
                     </div>

                      <div class="form-group col-md-3">
                          <label class='lbl' for="">Recieved Paper</label>
                          <input type="hidden" name='journal_id' value="<?=$journals_id?>">
                          <input type="hidden" name='id' id='id' value="">
                          <input type="number" value=""  onkeyup="get_rejected_paper('EDIT');" name='etotalpaper' id='etotalpaper' placeholder="Recieved Paper"   class="form-control" />
                      </div>

                      <div class="form-group col-md-3">
                          <label class='lbl' for="">Accepted</label>
                          <input type="number" value="" onkeyup="get_rejected_paper('EDIT');" name='eaccepted' id='eaccepted' placeholder="Accept Rate"   class="form-control" />
                      </div>
                      <div class="form-group col-md-3">
                          <label class='lbl' for="">Rejected</label>
                          <input type="text" readonly value="" name='erejected' id='erejected' placeholder="Accept Rate"   class="form-control" />
                      </div>
                      
                        <div class="form-group col-md-12">
                          <label class='lbl' for="">Rejected Countries (if Any)</label><br/>
                          <select style='width:100%' class="form-control  select2" name="ecountries[]" id="ecountries" multiple="multiple">
                              <?php
                                 $sql = "SELECT * from country";
                                 $stmt = $conn->query($sql);
                                 $i=1;
                                while(($row=$stmt->fetchAssociative())!==false){
                                extract($row);
                                ?>
                                <option value="<?=$country_id?>"><?=$name?></option>
                                <?php
                                 }
                              ?>
                         </select>          
                       </div>
               </div>
            <div class="row">
                <div class="col-md-12" style='margin-top:10px'>
                  <button  class='btn btn-info'><b>Update</b></button>
                </div>
            </div>
          </div>          
         </form>
      </div>
      
    </div>

  </div>
</div>
<?php
include "basic/admin_footer.php";
?>
<script>
function edit_acceptance_rate(id){
   burl="../ajax/get_accept_paper.php"; 
   $.post(burl,{"id":id},function(data,status){
     obj=JSON.parse(data);
     $("#id").val(id);
     $("#eyear").val(obj['volume_year']);
     $("#etotalpaper").val(obj['totalpaper']);
     $("#eaccepted").val(obj['accepted']);
     $("#erejected").val(obj['rejected']);
     $("#evolume").val(obj['volume']);
      arr=obj['countries'].split(',');
       $("#ecountries").select2({ dropdownParent: $('#myModal')}).val(arr).trigger("change");
     $("#myModal").modal('show');
  });
}
function delete_acceptance_rate(id){
  if(confirm("Are you sure")){
       burl="../action/deleteJournalAcceptance.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

$(document).ready(function() {
    $('#countries').select2({
        tags: true,
      tokenSeparators: [',', ' ']
    });

    $('#ecountries').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        dropdownParent: $('#myModal')
    });
});


function get_rejected_paper(v){
  if(v=="ADD"){
        totalpaper=$("#totalpaper").val();
        accepted=$("#accepted").val();
        rejected=totalpaper-accepted;
        $("#rejected").val(rejected);
  }else{
        totalpaper=$("#etotalpaper").val();
        accepted=$("#eaccepted").val();
        rejected=totalpaper-accepted;
        $("#erejected").val(rejected);
  }
}

function get_volume(){
  var year=$("#year").val();
  var journal_id="<?=$journals_id?>";
  burl="../ajax/get_volume.php"; 
  $.post(burl,{"year":year,"journals_id":journal_id},function(data,status){
    obj=JSON.parse(data);
    $("#volume").val(obj['volume']);
  });
}

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
