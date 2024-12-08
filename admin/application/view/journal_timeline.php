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
    <li><a href="" ><i class="fa fa-home mr5"></i> Timeline <?=$journal_abbri?>   </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'><?=$name?>  (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/updateJournalTimeline.php" method='post'  >
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                 <div class="form-group col-md-12">
                      <label class='lbl' for="">Journal Timeline</label>
                      <input type="hidden" name='id' id='id' value="<?=$journals_id?>">
                      <textarea class='form-control' name="timeline" id="timeline" cols="30" rows="10"><?=$timeline?></textarea>
                  </div>      
                  
                  <div class="form-group col-md-4">
                      <label class='lbl' for="">Manuscript Turn around Time</label>
                      <input type="text" name='m_turn_arround_time' value="<?=$m_turn_arround_time?>" class='form-control' id=''>
                  </div>   

             
                  <div class="form-group col-md-4">
                      <label class='lbl' for="">Manuscript Turn around Time</label>
                      <input type="text" name='editorial_review_duration' value="<?=$editorial_review_duration?>" class='form-control' id=''>
                  </div>   

                  <div class="form-group col-md-4">
                      <label class='lbl' for="">First Review Duration</label>
                      <input type="text" name='first_review_duration'  value="<?=$first_review_duration?>"   class='form-control' id=''>
                  </div>   

                  <div class="form-group col-md-4">
                      <label class='lbl' for="">Over all time from submit to decision</label>
                      <input type="text" name='over_s_to_d'  value="<?=$over_s_to_d?>"    class='form-control' id=''>
                  </div>   

                  <div class="form-group col-md-4">
                      <label class='lbl' for="">Revision Time</label>
                      <input type="text" name='rev_duration'  value="<?=$rev_duration?>"    class='form-control' id=''>
                  </div>   

                  <div class="form-group col-md-4">
                      <label class='lbl' for="">Publication Time</label>
                      <input type="text" name='publication_duration'  value="<?=$publication_duration?>"  class='form-control' id=''>
                  </div>   


                  <div class="form-group col-md-4">
                      <label class='lbl' for="">Abstracting and Indexing</label>
                      <input type="text" name='abstract_indexing'  value="<?=$abstract_indexing?>"    class='form-control' id=''>
                  </div>   

                  <div class="form-group col-md-4">
                      <label class='lbl' for="">Acceptance rate</label>
                      <input type="text" name='acceptance_rate'  value="<?=$acceptance_rate?>"  class='form-control' id=''>
                  </div>   
           </div>
        
      
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <button  class='btn btn-success'><b>UPDATE  </b></button>
            <a href="dashboard.php" class='btn btn-danger'>Back</a>
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