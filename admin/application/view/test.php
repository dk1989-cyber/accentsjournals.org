<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Add Paper</a></li>
   
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Add Paper</h4>
        </div>
        <form action="../action/adTest.php" method='post'  enctype='multipart/form-data'>
          <div class="row">
          <div class="row"  style='margin-top:10px;padding:5px'>
                 <div class="form-group col-md-12">
                    <label class='lbl' for="">Refference</label>
                    <textarea class='form-control' name="refference" id="refference" cols="30" rows="10"></textarea>
                 </div>
           </div>
           <div class="col-md-12" style='margin-top:10px'>
              <button  class='btn btn-info'>Add Paper</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
 <script src="<?=base_url('admin/dist/bootstrap-tagsinput.js')?>"></script>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
<script>
     
        CKEDITOR.replace( 'refference' );    
</script>