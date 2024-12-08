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
                <div class="form-group col-md-2">
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
                </div>
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
                      ?>
                       <p >[<?=$i?>]. <?=$reffrence?></p>
                     <?php
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
            <div class="col-md-12">
                  <table class='table table-bordered' style='height:300px;display:overflow'>
                     <thead>
                         <tr>
                            <th colspan='2'>Year Wise Report</th>
                         </tr>
                         <tr>
                            <th>Year</th>
                            <th>No of Paper</th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php
                         $sql = "select year,count(*) as count from ref_gen where unique_id='$uniqid' group by year";
                         $stmt = $conn->query($sql);
                         while(($row=$stmt->fetchAssociative())!==false){
                          extract($row);
                         ?>
                         <tr>
                            <td><?=$year?></td>
                            <td><?=$count?></td>
                          </tr>
                        <?php
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
   CKEDITOR.replace( 'reffrence' );      
</script>
<script>
function validation(){
    $('#btn').attr("disabled","disabled");
}
 
  
</script>