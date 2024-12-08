<?php
include "basic/admin_header.php";


$dt=array("journal_pes",
"journal_les",
"journal_about",
"journal_aim",
"journal_guide",
"journal_submit",
"journal_announce",
"journal_call",
"journal_charges",
"journal_publication_policy",
"journal_indexing",
"journal_ooption",
"journal_oaccess",
"journal_review_process",
 "",
 "",
"editorial_board_discription");
?>

<div class="mainpanel">
<div class="contentpanel">
  <?php
  extract($_REQUEST);
  $sql = "SELECT * FROM journals where journals_id='$id'";
  $stmt = $conn->query($sql);
  $row=$stmt->fetchAssociative();
  extract($row);
  
  if(is_array($row)){
 
  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  <?=$journal_abbri?> -  </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Editorial Board Content  - (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/actionJournalContent.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
               <div class="form-group col-md-12">
                      <label class='lbl' for="">Discription</label>
                      <input type="hidden" name='id' value="<?=$id?>">
                      <input type="hidden" name='type' value="<?=$type?>">
                      <input type="hidden" name='t' value="<?=$t?>">
                      <input type="hidden" name='action' value="Edit">
                      <input type="hidden" name='index' value="<?=$index?>">
                       <textarea class='form-control' name="editorial_board_discription" id="editorial_board_discription" cols="30" rows="10"><?=$editorial_board_discription?></textarea>
                </div>   
                <div class="form-group col-md-2">
                      <label class='lbl' for="">Position</label>
                       <select class='form-control' name="editorial_board_position" id="editorial_board_position">
                          <option selected value="<?=$editorial_board_position?>"><?=$editorial_board_position?></option>
                          <option value="TOP">TOP</option>
                          <option value="BOTTOM">BOTTIOM</option>    
                    </select>
                </div>         
           </div>
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <button  class='btn btn-success'><b>UPDATE <?=$t?></b></button>
            <a href="journal-content_grid.php?id=<?=$id?>" class='btn btn-danger'>Back</a>
            </div>
        </div>
       </div><!-- panel -->
      </form>
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
  <?php
  }
 ?>
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   CKEDITOR.replace( 'discription' );      
</script>