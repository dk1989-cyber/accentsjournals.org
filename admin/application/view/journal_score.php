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
    <li><a href="" ><i class="fa fa-home mr5"></i> Journal Score <?=$journal_abbri?>   </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'><?=$name?>  (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/updateJournalScore.php" method='post'  >
         <div class="panel-body" style='margin-top:10px'>
         <div class="row">
                    <div class="form-group col-md-4">
                        <label class='lbl' for="">Google Scholar Value</label>
                        <input type="hidden" name='id' id='id' value="<?=$journals_id?>">
                        <input class='form-control' type="text" id='google_scholar_v'  name='google_scholar_v' value="<?=$google_scholar_v?>" >
                    </div> 
                    <div class="form-group col-md-8">
                        <label class='lbl' for="">Google Scholar Link</label>
                        <input class='form-control' type="text" id='google_scholar_link' name='google_scholar_link' value="<?=$google_scholar_link?>" >
                    </div>         
          </div>
          <div class="row">
                    <div class="form-group col-md-4">
                        <label class='lbl' for="">Citation Value</label>
                        <input class='form-control' type="text" id='citation_v' name='citation_v' value="<?=$citation_v?>" >
                    </div> 
                    <div class="form-group col-md-8">
                        <label class='lbl' for="">Citation Link</label>
                        <input class='form-control' type="text" id='citation_link' name='citation_link' value="<?=$citation_link?>" >
                    </div>         
          </div>
          <div class="row">
                    <div class="form-group col-md-4">
                        <label class='lbl' for="">Impact Factor Value</label>
                        <input class='form-control' type="text" id='impact_factor_v' name='impact_factor_v' value="<?=$impact_factor_v?>" >
                    </div> 
                    <div class="form-group col-md-8">
                        <label class='lbl' for="">Impact Factor Link</label>
                        <input class='form-control' type="text" id='impact_factor_link' name='impact_factor_link' value="<?=$impact_factor_link?>" > 
                    </div>         
          </div>
          <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
              <a href="dashboard.php" class='btn btn-danger'>Back</a>
              <button  class='btn btn-success'><b>UPDATE  </b></button>
            </div>
        </div>
       </div><!-- panel -->
      </form>
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
 
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   CKEDITOR.replace( 'timeline' );      
</script>