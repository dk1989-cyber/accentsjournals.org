<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>Refference Check</a></li>
  </ol>
  <div class="row"> 
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Refference Check</h4>
        </div>
        <form onsubmit=validation(); id='accentform' action="../action/actionReffrenceCheck.php" method='post'  enctype='multipart/form-data'>
        <div class="panel-body" style='margin-top:10px'>
           <div class="col-md-12">
              <p id='msg' style='color:red'></p>
           </div>
           <div class="row">
                <!-- <div class="form-group col-md-2">
                     <input type="checkbox" name='by_title' id='by_title'>
                    <label class='lbl' for="">By Title<span class='req'> </span></label>
                </div>
                <div class="form-group col-md-2">
                    <input type="checkbox" name='by_year' id='by_year'>
                    <label class='lbl' for="">By Year<span class='req'> </span></label>
                </div>
                 <div class="form-group col-md-2">
                    <input type="checkbox" name='by_author' id='by_author'>
                    <label class='lbl' for="">By Author<span class='req'> </span></label>
                </div> -->
         </div>
         <div class="row">
            <div class="col-md-12">
                <label for="">Refference</label>
                <textarea rows='10' placeholder='Paste Refference Here' class='form-control' name="reffrence" id="reffrence">
                     <?php
                     if(isset($_SESSION["uniqid"])){
                      $uniqid=$_SESSION["uniqid"];
                      $sql = "select * from ref_gen where unique_id='$uniqid'";
                      $stmt = $conn->query($sql);
                      $i=1;

                     
                      while(($row=$stmt->fetchAssociative())!==false){
                         extract($row);
                         $articles[] =$title; 

                         if($is_original=="YES"){
                            if($duplication==""){
                            ?>
                          <p style='color:green' >[<?=$i?>]. <?=$reffrence?></p>
                            <?php
                            }
                            else{
                           ?>
                              <p  style='color:orange'>[<?=$i?>]. <?=$reffrence?></p>
                           <?php
                            }
                         }
                         else{
                          ?>
                           <p style='color:red'>[<?=$i?>].<?=$reffrence?></p>
                          <?php
                         }
                        $i=$i+1;
                     }
                    }
                     ?>
                </textarea>
            </div>
         </div>
         <?php
         
          if(isset($_SESSION["uniqid"])){
            $uniqid=$_SESSION["uniqid"];
         ?>
         <div class="row">
              <div class="col-md-12">
                   <h4>Reports</h4>
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
             <table cellspacing="0" cellpadding="0" border="0" width="325">
              <tr>
               <td>
                 <table cellspacing="0" cellpadding="1" border="1" width="300" >
                    <tr>
                      <th colspan='2' style='text-align:center'>
                          Year wise Paper
                      </th>
                    </tr>
                    <tr style="color:white;background-color:grey">
                        <th style='width:70%;text-align:center'>Year</th>
                        <th>No of Paper</th>
                    </tr>
              </table>
              </td>
             </tr>
             <tr>
              <td>
                <div style="width:320px; height:200px; overflow:auto;">
                  <table cellspacing="0" cellpadding="1" border="1" width="300" >
                        <?php
                                  $sql = "select year,count(*) as count from ref_gen where unique_id='$uniqid' group by year";
                                  $stmt = $conn->query($sql);
                                  while(($row=$stmt->fetchAssociative())!==false){
                                    extract($row);
                                  ?>
                                  <tr>
                                      <td style='text-align:center'><?=$year?></td>
                                      <td style='text-align:center'><?=$count?></td>
                                    </tr>
                                  <?php
                                  }
                                ?>   
                      </table>  
                     </div>
                  </td>
                </tr>
              </table>
       </div>
       <div class="col-md-6">
       <table cellspacing="0" cellpadding="0" border="0" width="690">
       <tr>
            <th colspan='2' style='text-align:center'>
                Title Duplicacy Check By Position
                <?php
                $firstOccurrence = [];
                $relations = [];
                foreach ($articles as $index => $article) {
                  if (!isset($firstOccurrence[$article])) {
                      // First time we see this string, mark its index
                      $firstOccurrence[$article] = $index;
                      $relations[$index] = []; // Initialize an empty array for relations
                  } else {
                      // String is a duplicate, link to the original
                      $originalIndex = $firstOccurrence[$article];
                      $relations[$originalIndex][] = $index;
                  }
                }
                ?>
            </th>
         </tr>
        <tr>
          <td>
           <table cellspacing="0" cellpadding="1" border="1" width="690" >
              <tr style="color:white;background-color:grey">
                  <th style='text-align:center;width:90%'> Title </th>
                  <th style='text-align:center'>Duplicate</th>
              </tr>
            </table>
          </td>
        </tr>
       <tr>
        <td>
         <div style="width:690px; height:200px; overflow:auto;">
                      <table cellspacing="0" cellpadding="1" border="1" width="690" >
                        <?php
                        foreach ($relations as $originalIndex => $duplicates) {
                         $right_position =$originalIndex+1;
                         $original=($right_position).":".$articles[$originalIndex];
                        ?>
                        <tr>
                          <td style='text-align:left;padding-left:10px'><?=$original?></td>
                          <td style='text-align:center'>
                          <?php
                          if (!empty($duplicates)) {
                            foreach ($duplicates as $duplicateIndex) {
                              $rightduplicate=$duplicateIndex+1;
                               echo "<b style='color:red'>$rightduplicate,</b>";  
                            }
                          }
                          else{
                              echo "Not Found";
                          }
                          
                          ?>
                          </td>
                        </tr>
                        <?php
                         }
                        ?>
                      </table>  
                    </div>
                  </td>
                </tr>
              </table>
       </div>
    </div> 
    <div class="row" style='margin-top:10px'>
      <div class="col-md-12">
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
          <td>
           <table cellspacing="0" cellpadding="1" border="1" width="100%" >
              <tr style="color:white;background-color:grey">
                  <th style='text-align:center;width:70%'> Journal </th>
                  <th style='text-align:center'>No of Reffrence</th>
              </tr>
            </table>
          </td>
        </tr>
       <tr>
        <td>
         <div style="width:100%; height:200px; overflow:auto;">
                      <table cellspacing="0" cellpadding="1" border="1" width="100%" >
                        <?php
                          $uniqid=$_SESSION['uniqid'];
                          $sql2="SELECT COUNT(*) as no_reff,journal_name from ref_gen where unique_id='$uniqid' and journal_name!='' GROUP by Journal_name";
                          $stmt = $conn->query($sql2);
                          $i2=1;
                          while(($row=$stmt->fetchAssociative())!==false){
                            extract($row);
                        ?>
                          <tr>
                            <td style='text-align:left;padding-left:10px;width:70%'><?=$journal_name?></td>
                            <td style='text-align:center'><?=$no_reff?></td>
                          </tr>
                        <?php
                         }
                        ?>
                      </table>  
                    </div>
                  </td>
                </tr>
            </table>
      </div>
    </div>
    <div class="row" style='margin-top:20px'>
            <div class="col-md-12">
            <div class="table-responsive">
             <table  id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>     
                    <th>Srno</th>
                    <th>Reffrence</th>
                    <th>Type</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $uniqid=$_SESSION['uniqid'];
                 $sql2="select * from ref_gen where unique_id='$uniqid'";
                 $stmt = $conn->query($sql2);
                 $i2=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                ?>
                <tr>
                    <td><?=$i2?></td>
                    <td><?=$reffrence?></td>
                    <td><?=$type?></td>
                </tr>
                <?php
                $i2=$i2+1;
                }
                ?>
             </tbody> 
          </table>
       </div>
    </div>          
   <?php
   }
    ?>
      <div class="row">
        <div class="col-md-12">
             <hr>
        </div>
      </div>
       <div class="row">
           <div class="col-md-12" style='margin-top:10px'>
               <button id='btn'    class='btn btn-info'>Submit</button>
               <?php
                if(isset($_SESSION["uniqid"])){
               ?>
                 <button id='btn' type='button'  onclick="clear_ref_session();"  class='btn btn-danger'>Clear <?=$_SESSION["uniqid"]?></button>
               <?php
                }
               ?>
           </div>
       </div> 
      </div>
    </div><!-- panel -->
    </form>
    </div><!-- col-sm-6 -->
    <!-- ####################################################### -->
  </div><!-- row -->
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function() {
  'use strict';
  $('#dataTable1').DataTable();
});


   CKEDITOR.replace( 'reffrence' );      
</script>
<script>
function validation(){
    $('#btn').attr("disabled","disabled");
}


function clear_ref_session(){
   if(confirm('are you sure')){
      var burl="../action/clearRefsession.php";
        $.post(burl,{},function(data,status){
          window.location.reload();
      });
   }
} 
</script>