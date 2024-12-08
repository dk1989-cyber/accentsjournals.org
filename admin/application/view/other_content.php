<?php
include "basic/admin_header.php";
 
 
?>

 <div class="mainpanel">
 <div class="contentpanel">
  <?php
  extract($_REQUEST);
 
  $q="select * from content where type='$type'";
  $stmt = $conn->query($q);
  $row=$stmt->fetchAssociative();
  extract($row);
  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>     </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'> </h4>
        </div>
        <form action="../action/updateContent.php" method='post'  >
         <div class="panel-body" style='margin-top:10px'>
       
           <div class="row">
               <div class="form-group col-md-12">
                        <label class='lbl' for="">Discription</label>
                         <input type="hidden" name='type' value="<?=$type?>">
                        <textarea class='form-control' name="content" id="content" cols="30" rows="10"><?=$content?></textarea>
                  </div>         
           </div>
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <button  class='btn btn-success'><b>UPDATE </b></button>
            <a href="" class='btn btn-danger'>Back</a>
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
   CKEDITOR.replace( 'content' );      
</script>