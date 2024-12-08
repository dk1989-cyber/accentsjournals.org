<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Conference</a></li>
   
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Conference</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table  id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>     
                    <th>Title </th>
                    <th>Created</th>
                    <th>Location</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "select * from conference";
                 $stmt = $conn->query($sql);
                 $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                   ?>
                 <tr>
                   <td><?=$short_title?></td>
                   <td style='width:15%'><?=$created?></td>
                   <td><?=$location?></td>
                   <td style='width:10%'><?=$city?></td>
                   <td style='width:5%'><a class='btn btn-success btn-sm' onclick="edit_conference(<?=$conference_id?>)"><i class='fa fa-edit'></i></a><a onclick="delete_conference(<?=$conference_id?>)" class='btn btn-danger btn-sm' ><i class='fa fa-trash' ></i></a></td>
                   
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

    <!-- ####################################################### -->
  </div><!-- row -->

</div><!-- contentpanel -->
</div><!-- mainpanel -->


</section>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id='titles'>Edit Conferece</h4>
      </div>
      <div class="modal-body">
      <form action="../action/updateConference.php" method='post' >
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-8">
                       <input type="hidden" name='conference_id' id='conference_id'>
                       <label class='lbl' for="">Title</label>
                      <input type="text" value="" name='title' id='title'  placeholder="Enter  Title" class="form-control" />
                  </div>
                  <div class="form-group col-md-4">
                       <label class='lbl' for="">Short Title</label>
                      <input type="text" value="" name='short_title' id='short_title'  placeholder="Enter  Short Title" class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Dates</label>
                      <input type="text" value="" name='dates' id='dates'  placeholder="Enter  Dates" class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Location</label>
                      <input type="text" value="" name='location' id='location'  placeholder="Enter  Location" class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">City</label>
                      <input type="text" value="" name='city' id='city'  placeholder="Enter  Location" class="form-control" />
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
            <button  class='btn btn-info'><b>Update  </b></button>
            </div>
        </div>
       </div><!-- panel -->
      </form>
      </div>
      
    </div>

  </div>
</div>

<?php
include "basic/admin_footer.php";
?>
<script>
$(document).ready(function() {
  'use strict';
  $('#dataTable1').DataTable();
});
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
      dt=CKEDITOR.replace( 'discription' ); 
        
</script>
<script>
function edit_conference(id){
   burl="../ajax/get_conference.php"; 
   $.post(burl,{"id":id},function(data,status){
    obj=JSON.parse(data);
    $("#title").val(obj['title']);
    $("#type").val(obj['type']);
    $("#short_title").val(obj['short_title']);
    $("#dates").val(obj['dates']);
    $("#city").val(obj['city']);
    $("#location").val(obj['location']);
  //  $("#discription").val(obj['discription']);
    CKEDITOR.instances['discription'].setData(obj['discription']);
    $("#conference_id").val(id);
    $("#myModal").modal('show');
   }); 
}

function delete_conference(id){
  if(confirm("Are you sure")){
       burl="../action/deleteConference.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}
</script>

