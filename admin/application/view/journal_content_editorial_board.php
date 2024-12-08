<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  <?php
  extract($_REQUEST);
  $sql = "SELECT * FROM journals where journals_id='$id'";
  $stmt = $conn->query($sql);
  $row=$stmt->fetchAssociative();
  extract($row);

  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  <?=$journal_abbri?>  </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Editorial Board - (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/adJournalContentEditorialBoard.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-4">
                       <label class='lbl' for="">Name</label>
                       <input type="hidden" name='id' value="<?=$id?>">
                       <input type="hidden" name='type' value="<?=$type?>">
                       <input type="hidden" name='t' value="<?=$t?>">
                      <input type="text" value="" name='name' id='name' placeholder="Enter Name"   class="form-control" />
                  </div>
                  <div class="form-group col-md-4">
                       <label class='lbl' for="">Designation</label>
                       <select class='form-control' name="designation" id="designation">
                           <option value="">Select</option>
                           <?php
                             $q="select * from designation";
                             $stmt = $conn->query($q);
                             $i=1;
                             while(($row=$stmt->fetchAssociative())!==false){
                               extract($row);
                             ?>
                             <option value="<?=$designation_id?>"><?=$designation?></option>
                            <?php
                             }
                            ?>
                       </select>
                  </div>
                   <div class="form-group col-md-4">
                       <label    class='lbl' for="">Department</label>
                       <select class='form-control'  name="department" id="department">
                           <?php
                             $q="select * from department";
                             $stmt = $conn->query($q);
                             $i=1;
                             while(($row=$stmt->fetchAssociative())!==false){
                               extract($row);
                             ?>
                             <option value="<?=$department_id?>"><?=$department?></option>
                            <?php
                             }
                             ?>
                       </select>
                  </div>
                  <div class="form-group col-md-3">
                       <label class='lbl' for="">Country  <span class="req">*</span></label>
                       <select onchange="get_state()" class='form-control' name="country" id="country">
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
                       <label class='lbl' for="">State  <span class="req">*</span></label>
                       <select onchange="get_city()" class='form-control' name="state" id="state">
                           <option value="">select</option>
                       </select>
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">City  <span class="req">*</span></label>
                       <select class='form-control' name="city" id="city">
                           <option value="">select</option>
                       </select>
                  </div>
                  <div class="form-group col-md-2">
                       <label    class='lbl' for="">Editorial Board Category</label>
                       <select class='form-control'  name="editorial_board_category" id="editorial_board_category">
                           <?php
                             $q="select * from editorial_board_category";
                             $stmt = $conn->query($q);
                             $i=1;
                             while(($row=$stmt->fetchAssociative())!==false){
                               extract($row);
                             ?>
                             <option value="<?=$editorial_board_category_id?>"><?=$row["category"]?></option>
                            <?php
                             }
                             ?>
                       </select>
                  </div>
                
                  <div class="form-group col-md-12">
                       <label class='lbl' for="">University & Other Information</label>
                       <textarea  name="university" id="university" cols="30" rows="10"></textarea>
                  </div>
                  <div class="form-group col-md-12">
                       <label class='lbl' for="">Domain of Research</label>
                       <input type="text" value="" name='domain_research' id='domain_research'  placeholder="Enter Key Area"   class="form-control" />
                  </div>
                  <div class="form-group col-md-12">
                       <label class='lbl' for="">Scopus ID</label>
                       <input type="text" value="" name='scopus_id' id='scopus_id'  placeholder="Scopus Id"   class="form-control" />
                  </div>
                  <div class="form-group col-md-12">
                      <label class='lbl' for="">Education</label>
                       <textarea class='form-control' name="education" id="education" cols="30" rows="10"></textarea>
                  </div> 
                  <div class="form-group col-md-12">
                      <label class='lbl' for="">Theses</label>
                       <textarea class='form-control' name="theses" id="theses" cols="30" rows="10"></textarea>
                  </div>   
                  <div class="form-group col-md-6">
                      <label class='lbl' for="">External Url </label>
                      <input type="text" value="" name='external_url'  placeholder="Enter External Url"   class="form-control" />
                  </div> 
                  <div class="form-group col-md-6">
                      <label class='lbl' for="">Email  </label>
                      <input type="text" class='form-control' name='email' id='email'>
                  </div>         
           </div>
          <div class="row" style='margin-bottom:10px;margin-top:2px'>
                  <div class="form-group col-md-2">
                      <label class='lbl' for="">Image</label>
                      <input  onchange="getImg(this,photo_img,'400','400');" type="file" name='photo_file'  class="form-control" />
                  </div>      
          </div>
          <div class="row">
          <?php
              $journal_c="https://via.placeholder.com/200x200";
             
            ?>
            <div class="col-md-2">
              <img style='width:100%' src="<?=$journal_c?>" alt="" id='photo_img'>   
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <button  class='btn btn-info'><b>Add  </b></button>
            <a href="journal_content_grid.php?id=<?=$id?>" class='btn btn-danger'>Back</a>
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
          <h4 class="panel-title" style='color:White'>Editorial Board of <?=$name?></h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
              <table id="datatable_edi" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>University</th>
                    <th>Orderby</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
                </div>
             </div>
        </div>
      </div>
    </div><!-- col-sm-6 -->
   </div> 

   <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Editorial Board  Content</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
            <form action="../action/updateeditorContentDiscription.php" method='post'  enctype='multipart/form-data'>
             <div class="row">
                <div class="col-md-12">
                    <label for="">Content</label>
                    <textarea class='form-control' name="editorial_board_discription" id="editorial_board_discription"><?=$editorial_board_discription?></textarea>
                    <input type="hidden" name='id' value="<?=$journals_id?>">
                    <input type="hidden" name='type' value="<?=$type?>">
                </div>
                <div class="col-md-2" style='margin-top:10px;margin-bottom:10px'>
                    <label for="">Position</label>
                    <select class='form-control' name="editorial_board_position" id="editorial_board_position">
                        <option value="<?=$editorial_board_position?>" ><?=$editorial_board_position?></option>
                        <option value="TOP">TOP</option>
                         <option value="BOTTOM">BOTTOM</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <button class='btn btn-success'>Update</button>
                </div>
             </div>
            </form>
        </div>
      </div>
    </div><!-- col-sm-6 -->
   </div> 

</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id='title'>Edit Editorial Board</h4>
      </div>
      <div class="modal-body">
        <form action="../action/updateJournalContentEditorialBoard.php" method='post' enctype='multipart/form-data'>
                <div class="panel-body" style='margin-top:10px'>
                <div class="row">
                        <div class="form-group col-md-4">
                            <label class='lbl' for="">Name</label>
                            <input type="hidden" name='id' value="<?=$id?>">
                            <input type="hidden" name='type' value="<?=$type?>">
                            <input type="hidden" name='t' value="<?=$t?>">
                            <input type="text" value="" name='ename' id='ename' placeholder="Enter Name"   class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class='lbl' for="">Designation</label>
                            <input type="hidden" id='editorial_board_id' name='editorial_board_id'>
                            <select class='form-control'  name="edesignation" id="edesignation">
                                  <?php
                                      $q="select * from designation";
                                      $stmt = $conn->query($q);
                                      $i=1;
                                      while(($row=$stmt->fetchAssociative())!==false){
                                        extract($row);
                                      ?>
                                      <option value="<?=$designation_id?>"><?=$designation?></option>
                                      <?php
                                      }
                                  ?>
                              </select>
                          </div>
                        <div class="form-group col-md-5">
                            <label class='lbl' for="">Department</label>
                            <select class='form-control'  name="edepartment" id="edepartment">
                            <?php
                             $q="select * from department";
                             $stmt = $conn->query($q);
                             $i=1;
                             while(($row=$stmt->fetchAssociative())!==false){
                               extract($row);
                             ?>
                             <option value="<?=$department_id?>"><?=$department?></option>
                            <?php
                             }
                             ?>
                       </select>
                        </div>
                      <div class="form-group col-md-3">
                       <label class='lbl' for="">Country  <span class="req">*</span></label>
                        <select onchange="get_state('e')" class='form-control' name="ecountry" id="ecountry">
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
                          <label class='lbl' for="">State  <span class="req">*</span></label>
                          <select onchange="get_city('e')" class='form-control' name="estate" id="estate">
                              <option value="">select</option>
                          </select>
                      </div>
                      
                      <div class="form-group col-md-2">
                          <label class='lbl' for="">City  <span class="req">*</span></label>
                          <select class='form-control' name="ecity" id="ecity">
                              <option value="">select</option>
                          </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label    class='lbl' for="">E. Board Category</label>
                        <select class='form-control'  name="eeditorial_board_category" id="eeditorial_board_category">
                            <?php
                              $q="select * from editorial_board_category";
                              $stmt = $conn->query($q);
                              $i=1;
                              while(($row=$stmt->fetchAssociative())!==false){
                                extract($row);
                              ?>
                              <option value="<?=$editorial_board_category_id?>"><?=$row["category"]?></option>
                              <?php
                              }
                              ?>
                        </select>
                       </div>
                        
                        <div class="form-group col-md-12">
                            <label class='lbl' for="">Domain of Research</label>
                            <input type="text" value="" name='edomain_research' id='edomain_research'  placeholder="Enter Key Area"   class="form-control" />
                        </div>
                        <div class="form-group col-md-12">
                            <label class='lbl' for="">University</label>
                            <textarea class='form-control' name="euniversity" id="euniversity" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                       <label class='lbl' for="">Scopus ID</label>
                       <input type="text" value="" name='escopus_id' id='escopus_id'  placeholder="Scopus Id"   class="form-control" />
                       </div>
                        <div class="form-group col-md-12">
                            <label class='lbl' for="">Education</label>
                            <textarea class='form-control' name="eeducation" id="eeducation" cols="30" rows="10"></textarea>
                        </div> 
                        <div class="form-group col-md-12">
                            <label class='lbl' for="">Theses</label>
                            <textarea class='form-control' name="etheses" id="etheses" cols="30" rows="10"></textarea>
                        </div>   
                        <div class="form-group col-md-6">
                            <label class='lbl' for="">External Url </label>
                            <input type="text" value="" name='eexternal_url'  placeholder="Enter External Url"   class="form-control" />
                        </div> 
                        <div class="form-group col-md-6">
                            <label class='lbl' for="">Email  </label>
                            <input type="text" class='form-control' name='eemail' id='eemail'>
                        </div>         
                </div>
                <div class="row" style='margin-bottom:10px;margin-top:2px'>
                        <div class="form-group col-md-2">
                            <label class='lbl' for="">Image</label>
                            <input  onchange="getImg(this,photo_img,'400','400');" type="file" name='ephoto_file'  class="form-control" />
                        </div>      
                </div>
                <div class="row">
                <?php
                    $journal_c="https://via.placeholder.com/200x200";
                    
                    ?>
                    <div class="col-md-2">
                    <img style='width:100%' src="<?=$journal_c?>" alt="" id='ephoto_img'>   
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
                    <a href="journal-content-grid.php?id=<?=$id?>" class='btn btn-danger'>Back</a>
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

$(document).ready(function(){
  get_editorialbord();
});  
function edit_editor(id){
   burl="../ajax/get_journals_editor_board.php"; 
   $.post(burl,{"id":id},function(data,status){
    obj=JSON.parse(data);
    $("#ename").val(obj['name']);
    $("#edesignation").val(obj['designation']);
    $("#edepartment").val(obj['department']);
    $("#ecountry").val(obj['country']);
    
    $("#eeditorial_board_category").val(obj["editorial_board_category_id"]);
    get_state('e',obj['state']);
   
    setTimeout(() => {
      get_city('e',obj['city']);
 
    }, 1000);
   
    $("#escopus_id").val(obj['scopus_id']);
   // $("#euniversity").val(obj['university']);
    CKEDITOR.instances['euniversity'].setData(obj['university']);
    $("#ekey_area").val(obj['key_area']);
    $("#edomain_research").val(obj['domain_research'])
    $("#eeducation").val(obj['education']);
    $("#etheses").val(obj['theses']);
    $("#eexternal_url").val(obj['extrnal_url']);
    $("#eemail").val(obj['email']);
    $("#editorial_board_id").val(id);
    if(obj['photo']!=""){
        $("#ephoto_img").attr("src","../../../upload/journal_content/editorial_board/"+obj["photo"]);
    }
    else{
        $("#ephoto_img").attr("src","https://via.placeholder.com/200x200");
    }
    $("#myModal").modal('show');
   }); 
}

function delete_editor(id){
  if(confirm("Are you sure")){
       burl="../action/deleteEditorialBoard.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

function get_state(v='add',f=0){
         if(v!='add'){
          country_id=$("#ecountry").val();
          id=$("#estate");
         }
         else{
          country_id=$("#country").val();
          id=$("#state");
         }
         burl="../ajax/get_state.php"; 
         $.post(burl,{"id":country_id},function(data,status){
          id.html(data);
          if(f!=0){
             id.val(f);
          }
        });
}
function get_city(v='add',f=0){
         if(v!='add'){
          state_id=$("#estate").val();
          id=$("#ecity");
         }
         else{
          state_id=$("#state").val();
          id=$("#city");
         }
         burl="../ajax/get_city.php"; 
         $.post(burl,{"id":state_id},function(data,status){
         id.html(data);
         if(f!=0){
             id.val(f);
          }
        });
}



function get_editorialbord(){
      burl="<?=base_url('admin/application/ajax/get_editorialboard.php')?>";
      table=new $('#datatable_edi').DataTable({
        "ajax" : {
            "url": burl, //give your controller & function name
            "type":"post",
                "data":{"journals_id":"<?=$id?>"}
            },
        bDestroy:true,
        scrollX: true,
        dom: 'Blfrtip',
        "paging": true,
        lengthMenu: [10, 25, 50, 75, 100],
         "pageLength": 10,
      });
    }

  function sort(id,ordr,pos){
  var burl="../action/sortEditorialBoard.php";
  $.post(burl,{"id":id,"ordr":ordr,"order_b":pos},function(data,status){
    get_editorialbord();
  });
}
 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   CKEDITOR.replace( 'university' );  
   CKEDITOR.replace( 'euniversity' );      
</script>
