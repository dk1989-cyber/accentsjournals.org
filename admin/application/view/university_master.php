<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>University</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>University</h4>
        </div>
        <form action="../action/adUniversity.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-4">
                       <label class='lbl' for="">University Name</label>
                       <input type="text" value="" name='university'  id='university' placeholder="Enter Department" class="form-control" />
                  </div>

                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Country</label>
                       <select onchange="get_state('add')" class='form-control' name="country" id="country">
                           <option value="">select</option>
                           <?php
                           $sql = "SELECT * FROM country";
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
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">State</label>
                       <select onchange="get_city('add')" class='form-control' name="state" id="state">
                           <option value="">select</option>
                       </select>
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">City</label>
                       <select class='form-control' name="city" id="city">
                           <option value="">select</option>
                       </select>
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Zipcode</label>
                       <input type="text" value="" name='zipcode'  placeholder="Enter Zipcode" class="form-control" />
                  </div>
                  <div class="form-group col-md-12">
                       <label class='lbl' for="">Address</label>
                       <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Status</label>
                       <select class='form-control' name="status" id="status">
                           <option value="Enable">Enable</option>
                           <option value="Disable">Disable</option>
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
           
            <a href="#" class='btn btn-danger'>Back</a>
            <button  class='btn btn-info'><b>Add</b></button>
            </div>
        </div>
       </div><!-- panel -->
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
          <h4 class="panel-title" style='color:White'>View University </h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Srno</th>
                    <th>University</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT u.*,c.name as cname,st.name as sname,ct.name as ctname 
                 FROM ad_university u 
                 LEFT JOIN country c ON u.country=c.country_id
                 LEFT JOIN states st ON u.ustate=st.states_id
                 LEFT JOIN cities ct ON ct.cities_id=u.ucity";
                 $stmt = $conn->query($sql);
                 $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$university?></td>
                        <td><?=$cname?></td>
                        <td><?=$sname?></td>
                        <td><?=$ctname?></td>
                        <td><?=$status?></td>
                        <td><a onclick="edit_university(<?=$ad_university_id?>)">Edit</a><a onclick="delete_university(<?=$ad_university_id?>)">Delete</a></td>
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

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id='title'>Edit University </h4>
      </div>
      <div class="modal-body">
        <form action="../action/updateUniversity.php" method='post' enctype='multipart/form-data'>
          <div class="row">
                  <div class="form-group col-md-6">
                       <label class='lbl' for="">University Name</label>
                       <input type="hidden" value="" name='ad_university_id'  id='ad_university_id'   />
                       <input type="text" value="" name='euniversity'  id='euniversity' placeholder="Enter University" class="form-control" />
                  </div>
                  <div class="form-group col-md-3">
                       <label class='lbl' for="">Country</label>
                       <select onchange="get_state('edit')" class='form-control' name="ecountry" id="ecountry">
                           <option value="">select</option>
                           <?php
                           $sql = "SELECT * FROM country";
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
                  <div class="form-group col-md-3">
                       <label class='lbl' for="">State</label>
                       <select onchange="get_city('edit')" class='form-control' name="estate" id="estate">
                           <option value="">select</option>
                       </select>
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">City</label>
                       <select class='form-control' name="ecity" id="ecity">
                           <option value="">select</option>
                       </select>
                  </div>
                  <div class="form-group col-md-3">
                       <label class='lbl' for="">Zipcode</label>
                       <input type="text" value="" name='ezipcode' id='ezipcode'  placeholder="Enter Zipcode" class="form-control" />
                  </div>
                  <div class="form-group col-md-12">
                       <label class='lbl' for="">Address</label>
                       <textarea name="eaddress" id="eaddress" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Status</label>
                       <select class='form-control' name="estatus" id="estatus">
                           <option value="Enable">Enable</option>
                           <option value="Disable">Disable</option>
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
           
            <a href="#" class='btn btn-danger'>Back</a>
            <button  class='btn btn-info'><b>Update</b></button>
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

function edit_university(id){
    burl="../ajax/get_university.php"; 
    $("#ad_university_id").val(id);
    $.post(burl,{"id":id},function(data,status){
       obj=JSON.parse(data);
       $("#euniversity").val(obj['university']);
       $("#ecountry").val(obj['country']);
       $("#ezipcode").val(obj['uzip']);
        get_state("edit",obj['ustate']);
    //   get_city("edit",obj['ucity']);
        setTimeout(() => {
        get_city("edit",obj['ucity']);
       }, 1000);
       $("#eaddress").val(obj['uaddress']);
       $("#myModal").modal('show');
    });
}

function get_state(t,v=0){
    if(t=="add"){
         country_id=$("#country").val();
         burl="../ajax/get_state.php"; 
         $.post(burl,{"id":country_id},function(data,status){
          $("#state").html(data);
        });
    }
    else{
         country_id=$("#ecountry").val();
         burl="../ajax/get_state.php"; 
         $.post(burl,{"id":country_id},function(data,status){
         $("#estate").html(data);
          if(v!=0){
            $("#estate").val(v);
          }
      });
    }
}
function get_city(t,v=0){
    if(t=="add"){
         state_id=$("#state").val();
         burl="../ajax/get_city.php"; 
         $.post(burl,{"id":state_id},function(data,status){
          $("#city").html(data);
        });
    }
    else{
         state=$("#estate").val();
         burl="../ajax/get_city.php"; 
         $.post(burl,{"id":state},function(data,status){
          $("#ecity").html(data);
          if(v!=0){
            $("#ecity").val(v);
          }
         
        });
    }
}
function delete_university(id){
  if(confirm("Are you sure")){
       burl="../action/deleteUniversity.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}
</script>
