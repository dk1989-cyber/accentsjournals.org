<?php
include "basic/admin_header.php";

extract($_REQUEST);
$q="select jp.*,jp.doi as do,j.journal_abbri as abbri,j.name as journal_name,j.doi,j.journals_id as jid from press_paper jp 
left join journals j on jp.journals_id=j.journals_id    WHERE  jp.press_paper_id='$id'";
 
$stmt = $conn->query($q);
$row_=$stmt->fetchAssociative();
extract($row_);
?>
<div class="mainpanel">
<div class="contentpanel">
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Add Article in press</a></li> 
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Article In Press</h4>
        </div>
       <form action="../action/updatePaperpress.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
         <div class="row pbody"  id='pbody' style='padding:10px'>
           <div class="row" style='margin-top:20px;padding:5px'>
           <div class="form-group col-md-4">
                      <label class='lbl' for="">Journal <span class='req'>*</span> </label>
                      <select required  class='form-control' name="journals_id" id="journals_id">
                          <option value=""></option>
                          <?php
                          $q="select * from journals";
                          $stmt = $conn->query($q);
                          $i=1;
                          while(($row=$stmt->fetchAssociative())!==false){
                            extract($row);
                            ?>
                            <option <?=($jid==$journals_id)?"selected":""?> value="<?=$journals_id?>#<?=$journal_abbri?>#<?=$doi?>#<?=$name?>"><?=$journal_abbri?></option>
                            <?php
                            }
                            ?>
                          <?php
                          ?>
                      </select>
                  </div>
                 <div class="form-group col-md-5">
                    <label class='lbl' for="">Paper Id <span class='req'>*</span></label>
                    <input required onkeyup="generate_doi_url();" value="<?=$paper_id?>" type="text" name='paper_id' id='paper_id' placeholder="Enter  Paper Id" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label class='lbl' for="">Article Type <span class='req'>*</span></label>
                    <select required  class='form-control' name="article_type" id="article_type">
                            <?php
                            $q="select * from article_type";
                            $stmt = $conn->query($q);
                            $i=1;
                            while(($row=$stmt->fetchAssociative())!==false){
                              extract($row);
                            ?>
                            <option <?=($row_['article_type_id']==$article_type_id)?"selected":""?>  value="<?=$article_type_id?>"><?=$article_type?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class='lbl' for="">Discipline <span class='req'>*</span></label>
                    <select class='form-control' name="discipline" id="discipline">
                         <option value="">Select</option>
                        <?php
                            $q="select * from discipline";
                            $stmt = $conn->query($q);
                            $i=1;
                            while(($row=$stmt->fetchAssociative())!==false){
                              extract($row);
                            ?>
                            <option  <?=($row_['discipline']==$discipline_id)?"selected":""?>  value="<?=$discipline_id?>"><?=$discipline?></option>
                            <?php
                            }
                          ?>
                    </select>
                </div>
                <div class="form-group col-md-9">
                    <label class='lbl' for="">Title <span class='req'>*</span></label>
                    <input value="<?=$title?>" type="text" name='paper_title' id='paper_title' placeholder="Enter  Paper Title " class="form-control" />
                </div>

                <?php
                   
                   $rec_date=date('d-m-Y',strtotime($recieved_date));
                   $ac_date=date('d-m-Y',strtotime($accepted_date));
                   $rev_date=date('d-m-Y',strtotime($revised_date));

                   ?>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Received Date <span class='req'>*</span> </label>
                    <input required autocomplete="off" value="<?=$rec_date?>"  type="text" id='recieved_date' name='recieved_date' placeholder="" class="form-control datepicker" />
                   
                </div>

                <div class="form-group col-md-2">
                    <label class='lbl' for="">Revised Date  <span class='req'>*</span> </label>
                    <input required autocomplete="off" value="<?=$rev_date?>"   type="text" name='revised_date' id='revised_date' placeholder="" class="form-control datepicker" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Accepted Date <span class='req'>*</span>  </label>
                    <input required autocomplete="off" value="<?=$ac_date?>"   type="text" name='accepted_date' id='accepted_date' placeholder="" class="form-control datepicker" />
                </div>
                <div class="form-group col-md-6">
                    <label class='lbl' for="">DOI  <span class='req'>*</span></label>
                    <input  type="text" name='doi' value="<?=$do?>" id='doi' value="" placeholder="Enter  DOI" class="form-control" />
                </div>
        </div>
        <div class="row">
           <div class="col-md-6" style='margin-top:-25px'>
                <label class='error' for="" id='lblrecieved_date'></label>
                <label  class='error'  for="" id='lblrevised_date'></label>
                <label  class='error'  for="" id='lblaccepted_date'></label>
          </div>
        </div>
        
        <div class="row" style='padding:5px;'>
                <div class="form-group col-md-8">
                    <input type="hidden" name='id' id='id' value="<?=$_REQUEST['id']?>">
                    <label class='lbl' for="">Hyperlink  <span class='req'>*</span></label>
                    <input type="text" value="<?=$doilink?>" name='doilink' id='doilink' placeholder="" class="form-control" />
                </div>  
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Page  <span class='req'>*</span></label><br/>
                    <input type="text" name='page_no_start' id='page_no_start' placeholder="Start" style='width:48%;float:left' class="form-control"  value="<?=$page_no_start?>"/>
                    <input type="text" name='page_no_end'  id='page_no_end' placeholder="End" style='width:48%;float:right' class="form-control" value="<?=$page_no_end?>" />
                </div> 
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Authors  <span class='req'>*</span></label><br/>
                    <input required type="number" value="<?=$no_authors?>" onkeyup="get_authors();"  onchange="get_authors();" id='no_authors' name='no_authors' placeholder="No of Authors"   class="form-control" />
                 </div> 
        </div>
        <div class="row authordata">

        </div>
        <div class="row" style='padding:5px;'>
                 <div class="form-group col-md-12">
                    <label class='lbl' for="">Citation (Vancuvar)</label>
                    <textarea style='color:black;font-size:16px' onclick="generate_citations('press');" placeholder='Click for generate citation' readonly class='form-control' name="citation" id="citation" cols="30" rows="10"><?=$citation?></textarea>
                 </div>
        </div>
        <div class="row" style='padding:5px;'>
                 <div class="form-group col-md-6">
                    <label class='lbl' for="">Citation (MLA)</label>
                        <textarea style='color:black;font-size:16px' onclick="" placeholder='Click for generate citation'  class='form-control' name="citation_mla" id="citation_mla" cols="30" rows="10"><?=$citation_mla?></textarea> 
                  </div>
                  <div class="form-group col-md-6">
                    <label class='lbl' for="">Citation (APA)</label>
                        <textarea style='color:black;font-size:16px' onclick="" placeholder='Click for generate citation'  class='form-control' name="citation_apa" id="citation_apa" cols="30" rows="10"><?=$citation_apa?></textarea> 
                </div>
        </div>
        <div class="row" style='padding:5px;'>
                 <div class="form-group col-md-6">
                    <label class='lbl' for="">Citation (IEEE)</label>
                        <textarea style='color:black;font-size:16px' onclick="" placeholder='Click for generate citation'  class='form-control' name="citation_ieee" id="citation_ieee" cols="30" rows="10"><?=$citation_ieee?></textarea> 
                </div>
                <div class="form-group col-md-6">
                    <label class='lbl' for="">Citation (Harvard)</label>
                        <textarea style='color:black;font-size:16px' onclick="" placeholder='Click for generate citation'  class='form-control' name="citation_h" id="citation_h" cols="30" rows="10"><?=$citation_h?></textarea> 
                </div>               
        </div>
        <div class="row" style='padding:5px;'>
                 <div class="form-group col-md-12">
                    <label class='lbl' for="">Abstract</label>
                    <textarea class='form-control' name="abstract" id="abstract" cols="30" rows="10"><?=$abstract?></textarea>
                 </div>
        </div>

        <div class="row"  style='margin-top:10px;padding:5px'>
                 <div class="form-group col-md-12">
                    <label class='lbl' for="">Refference  <span class='req'>*</span></label>
                    <textarea  required class='form-control' name="refference" id="reffrence" cols="30" rows="10"><?=$refference?></textarea>
                 </div>
        </div>
        <div class="row"  style='margin-top:10px;padding:5px'>
                 <div class="form-group col-md-12">
                    <label class='lbl' for="">Refference Preview</label>
                    <table class='table table-bordered'>
                        <thead>
                                <tr>
                                    <th>Reffrence</th>
                                    <th style='width:13%'>Cross Ref</th>
                                    <th style='width:12%'>G. Scholar</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                             $sql = "SELECT * FROM refrencep where press_paper_id='$id'";
                             $stmt = $conn->query($sql);
                             $i=1;
                             while(($row=$stmt->fetchAssociative())!==false){
                                extract($row);
                             ?>
                             <tr>
                                <td><b>[<?=$i?>]. </b><?=$name?></td>
                                <td style='text-align:center'><a target='blank' href="<?=$crossref?>"><i class='fa fa-link'></i></a></td>
                                <td style='text-align:center'><a target='blank' href="<?=$googlescholar?>"><i class='fa fa-link'></i></a></td>
                             </tr>
                             <?php
                             $i=$i+1;
                             }
                            ?>
                        </tbody>
                      

                    </table>
                 </div>
        </div> 
        <div class="row"  style='margin-top:10px'>
                 <div class="form-group col-md-12">
                    <label class='lbl' for="">Keywords  <span class='req'>*</span> </label>
                    <input style='width:100%' required  value="<?=$keyword?>"  autocomplete="off"  data-role="tagsinput"   type="text" Placeholder="Separated with comma"  name='keywords' id='keywords' class='form-control'  />     
                 </div>
        </div>
        <div class="row" style='margin-top:10px'>
          <div class="col-md-2">
               <label class='lbl' for=""> Paper  <span class='req'>*</span></label>
               <input   type="file"  onchange="chkDoc(0,'full_paper',5)";   <?=($fullpaper!="")?"":"required"?>  name='full_paper' id='full_paper'>
          </div>
          <div class="col-md-2">
               <label class='lbl' for=""> Graphical Abstract  <span class='req'></span></label>
               <input  accept="image/*"  onchange="getImg(this,full_graphical_abstract,'400','400');"  type="file" name='full_graphical_abstract' id='full_paper'>
          </div>
       </div>

  

       <div class="row" style='margin-top:10px'>
           <div class="col-md-4">
              <?php
    
              if($fullpaper!=""){
                $l=base_url("PaperDirectory/Journal/$abbri/press/").$fullpaper;
               ?>
                 <a target='_blank' class='btn btn-success' href="<?=$l?>" ><i class='fa fa-download'></i>Download</a>
                 <?php
                }
              ?>
          </div>
          <div class="col-md-4">
             <?php
              if($paperimage!=""){
                   $l2=base_url("PaperDirectory/Journal/$abbri/press/").$paperimage;
                  ?>
                  <a target='_blank'  href="<?=$l2?>" ><img src="<?=$l2?>" style='width:100px'/></a>  
                <?php
                }
              ?>
          </div>
       </div> 
      <div class="row">
        <div class="col-md-12">
             <hr>
        </div>
      </div>

       <div class="row">
           <div class="col-md-12" style='margin-top:10px'>
              <button  class='btn btn-info'>Update Paper</button>
           </div>
       </div>
        </div>
      </div>
      </div>  
      
      </form>
    </div><!-- col-sm-6 -->    
  </div><!-- row -->

</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id='title'>Add  University </h4>
      </div>
      <div class="modal-body">
        <form  method='post' >
          <div class="row">
                  <div class="form-group col-md-6">
                       <label class='lbl' for="">University Name <span class="req">*</span></label>
                    
                       <input type="text" value="" name='university'  id='university' placeholder="Enter University" class="form-control" />
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
                  <div class="form-group col-md-3">
                       <label class='lbl' for="">Zipcode</label>
                       <input type="text" value="" name='zipcode' id='zipcode'  placeholder="Enter Zipcode" class="form-control" />
                  </div>
                  <div class="form-group col-md-12">
                       <label class='lbl' for="">Address</label>
                       <input type="hidden" name='pos' id='pos'>
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
               <p id='msg' style='color:red;font-weight:bold'></p>
            </div>
            <div class="col-md-12" style='margin-top:10px'>
              <button  type='button' onclick='add_university()' class='btn btn-info'><b>Add</b></button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
 <script src="<?=base_url('admin/dist/bootstrap-tagsinput.js')?>"></script>
<script>

$(document).ready(function(){
    get_authors();
    $(window).keydown(function(event){
      // if(event.keyCode == 13) {
      //   event.preventDefault();
      //   return false;
      // }
    });
  
});
 
function generate_doi_url(){
  journal=$("#journals_id").val();
  j=journal.split("#");
  paper_id=$("#paper_id").val();
  doi_journal=j[2];
  complete_doi=doi_journal+"/"+paper_id;
  complete_doi_url="https://dx.doi.org/"+doi_journal+"/"+paper_id;
  $("#doi").val(complete_doi);
  $("#doilink").val(complete_doi_url);
}
function show_modal(i){
  $("#pos").val(i);
  $("#myModal").modal('show');
}

function get_state(){
         country_id=$("#country").val();
         burl="../ajax/get_state.php"; 
         $.post(burl,{"id":country_id},function(data,status){
          $("#state").html(data);
        });
}
function get_city(){
         state_id=$("#state").val();
         burl="../ajax/get_city.php"; 
         $.post(burl,{"id":state_id},function(data,status){
          $("#city").html(data);
        });
}
 
function add_university(){
pos=$("#pos").val();
university=$("#university").val();
country=$("#country").val();
address=$("#address").val();
state=$("#state").val();
city=$("#city").val();
zipcode=$("#zipcode").val();
if(university!=""&&country!=""&&state!=""&&city!=""){
    burl="../ajax/adUniversity.php"; 
    $.get(burl,{"university":university,"country":country,"state":state,"city":city,"zipcode":zipcode,"address":address},function(data,status){
        if(status=="success"){
            data=data.trim(); 
            if(data!="0"&&data!="-1"){
                ids=data;
                get_univerlist(pos,ids);
                $("#myModal").modal('hide');
                $("#university").val("");
                $("#country").val("");
                $("#address").val("");
            } 
            else if(data=="-1"){
               $("#msg").html("University Already Added");
               //already addres
            }     
            //$("#university_id").html(data);
        }
    });
}
else{
  //fillrequired
  $("#msg").html("Please Select All Required Fields");
}
}

 
function get_authors(){
  cnt=$("#no_authors").val();
  burl="../ajax/get_authors.php"; 
  jp_id="<?=$_REQUEST['id']?>";
  $.post(burl,{"authors":cnt,"type":"edit","p":"press","jp_id":jp_id},function(data,status){
     $(".authordata").html(data);
     get_univerlist();
   }); 
 } 

   function get_univerlist(pos=0,id=0){
    burl="../ajax/get_univer_list.php"; 
    $.post(burl,{},function(data,status){
     $(".univerlist").html(data);
     if(id!=0){
       $("#university_"+pos).val(id);
       $("#myModal").modal('hide');
     }
   }); 
}


 $(document).ready(function () {
    $("#recieved_date").datepicker({
         dateFormat: 'dd-mm-yy',
         maxDate: 0,
         onSelect: function(date) {
             let sts = Boolean(validation('lblrecieved_date', date));
             if (sts != true) {  
                 $("#recieved_date").val("<?=$rec_date?>");
                
                 $("#lblrecieved_date").html("Received  Date Not be Grater than from Revised Date & Accepted Date");
                 $("#lblrevised_date").html("");
                 $("#lblaccepted_date").html("");
          
             } else {
                 $("#lblaccepted_date").html("");
                 $("#lblrevised_date").html("");
                 $("#lblrecieved_date").html("");
             }
         }
     });
     $("#revised_date").datepicker({
         dateFormat: 'dd-mm-yy',
         maxDate: 0,
         onSelect: function(date) {
             let sts = Boolean(validation('lblrevised_date', date));
             if (sts != true) {
              $("#revised_date").val("<?=$rev_date?>"); 
            
              $("#lblrecieved_date").html(""); 
              $("#lblrevised_date").html("Revised Date Not be Less than from Received  Date and Not Greater than from Accepted Date"); 
              $("#lblaccepted_date").html(""); 
                
             } else {

              $("#lblrecieved_date").html(""); 
              $("#lblrevised_date").html(""); 
              $("#lblaccepted_date").html(""); 

             }
         }
     });
     $("#accepted_date").datepicker({
         dateFormat: 'dd-mm-yy',
         maxDate: 0,
         onSelect: function(date) {
             let sts = Boolean(validation('lblaccepted_date', date));
             if (sts != true) {
                 $("#accepted_date").val("<?=$ac_date?>");

                 $("#lblrecieved_date").html("");
                 $("#lblrevised_date").html("");
                 $("#lblaccepted_date").html("Accepted Date is Not  less than from Received  and Revised Date");
               
             } else {
                $("#lblrecieved_date").html(""); 
                $("#lblrevised_date").html(""); 
                $("#lblaccepted_date").html(""); 
             }
         }
     });
 });

rect=true;
revt=true;
act=true;
 
 
function validation(element, date) {
  revised_date_ = $("#revised_date").val();
  accepted_date_ = $("#accepted_date").val();
  recieved_date_ = $("#recieved_date").val();
  // alert(accepted_date_);
  var rev_d = revised_date_.split("-").reverse().join("-");
  var rec_d = recieved_date_.split("-").reverse().join("-");
  var ac_d = accepted_date_.split("-").reverse().join("-");
  revised_date = new Date(rev_d);
  accepted_date = new Date(ac_d);
  recieved_date = new Date(rec_d);
  if (element == "lblrecieved_date") {
    if (accepted_date_ != "") {
     
      if (accepted_date <= recieved_date) {
        act = false;
        return false;
      } else {
        act = true;
      }
    }
    if (revised_date_ != "") {
      if (revised_date <= recieved_date) {
        revt = false;
        return false;
      } else {
        revt = true;
      }
    }
    //alart(revt);
    //alart(act);
    t = revt * act;
    return t;
  }
  if (element == "lblrevised_date") {
    if (accepted_date_ != "") {
      if (accepted_date <= recieved_date) {
        act = false;
        return false;
      } else {
        act = true;
      }
    }
    if (revised_date_ != "") {
      if (revised_date <= recieved_date) {
        revt = false;
        return false;
      } else {
        revt = true;
      }
    }
    if (revised_date_ != "") {
      if (revised_date >= accepted_date) {
        revt = false;
        return false;
      } else {
        revt = true;
      }
    }
    t = revt * act;
    return t;
  }
  if (element == "lblaccepted_date") {
    // alert(accepted_date);
    if (accepted_date_ != "") {
      if (accepted_date < recieved_date) {
        act = false;
        return false;
      } else {
        if (accepted_date > revised_date) {
          act = true;
        } else {
          act = false;
          return false;
        }
      }
    }
    if (revised_date != "") {
      if (revised_date < recieved_date) {
        revt = false;
      } else {
        revt = true;
      }
    }
    t = revt * act;
    return t;
  }
}

function getCheck(){
     
}

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
 
   CKEDITOR.replace( 'abstract' );  
   //CKEDITOR.replace( 'refference' );      
</script>
