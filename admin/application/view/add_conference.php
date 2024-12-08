<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
 
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  Conference </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'> </h4>
        </div>
        <form action="../action/addConference.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-8">
                       <label class='lbl' for="">Title</label>
                      <input type="text" value="" name='title'  placeholder="Enter  Title" class="form-control" />
                  </div>
                  <div class="form-group col-md-4">
                       <label class='lbl' for="">Short Title</label>
                      <input type="text" value="" name='short_title'  placeholder="Enter  Short Title" class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Dates</label>
                      <input type="text" value="" name='dates'  placeholder="Enter  Dates" class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Location</label>
                      <input type="text" value="" name='location'  placeholder="Enter  Location" class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">City</label>
                      <input type="text" value="" name='city'  placeholder="Enter  Location" class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Type</label>
                       <select class='form-control' name="type" id="type">
                           <option value="PREVIOUS">PREVIOUS</option>
                           <option value="CURRENT">CURRENT</option>
                       </select>
                  </div>
                  <div class="form-group col-md-12">
                      <label class='lbl' for="">Discription</label>
                       <textarea class='form-control' name="discription" id="discription" cols="30" rows="10"></textarea>
                  </div>         
          </div>
        
           
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <button  class='btn btn-info'><b>Add Conference </b></button>
            <a  class='btn btn-danger'>Back</a>
            </div>
        </div>
       </div><!-- panel -->
      </form>
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
  <?php

  ?>
   
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
 
<?php
include "basic/admin_footer.php";
?>
<script>
// function edit_news(id){
//    burl="../ajax/get_journals_news.php"; 
//    $.post(burl,{"id":id},function(data,status){
//     obj=JSON.parse(data);
//     $("#etitle").val(obj['title']);
//     $("#ediscription").val(obj['discription']);
//     $("#journals_news_id").val(id);
//     if(obj['image']!=""){
//         $("#enews_img").attr("src","../../../upload/journal_content/news/"+obj["image"]);
//     }
//     else{
//         $("#enews_img").attr("src","https://via.placeholder.com/200x200");
//     }
//     $("#myModal").modal('show');
//    }); 
// }

function delete_news(id){
  if(confirm("Are you sure")){
       burl="../action/deleteNews.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   CKEDITOR.replace( 'discription' );   
   CKEDITOR.replace( 'ediscription' );      
</script>
