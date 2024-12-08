<?php
include "basic/admin_header.php";
extract($_REQUEST);
$q="select jp.*,jp.doi as do,i.*,i.status as st,j.journal_abbri,j.name as journal_name,j.doi from journalpaper jp 
left join issue i on jp.issue_id=i.issue_id
left join journals j on i.journals_id=j.journals_id    WHERE  jp.journalpaper_id='$id'";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
extract($row);

?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Edit Paper</a></li>
   
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Edit Paper</h4>
        </div>
        <form action="../action/updatePaper.php" method='post'  enctype='multipart/form-data'>
        <div class="panel-body" style='margin-top:10px'>
          <div class="row" style='background-color:#efefef;padding:5px;margin:2px'>
                  <div class="form-group col-md-6">
                     <label class='lbl' for="">Journal  </label><br/>
                     <input type="hidden" name='id' id='id' value="<?=$journalpaper_id?>" >
                     
                     <input type="hidden" name='journals_id' id='id' value="<?=$journals_id?>" >
                     <input type="hidden" name='issue_id' id='id' value="<?=$issue_id?>" >
                     
                     
                     <label for="" class='lblv' style='font-size:20px;font-weight:bold'><?=$journal_name?></label>
                  </div>
                  <div class="form-group col-md-4">
                   <label class='lbl' for="">Issue </label><br/>
                    <label style='display:block;font-size:20px;font-weight:bold'><?=$volume?>(<?=$issue?>)</label> 
                  </div>
                  <div class="form-group col-md-2">
                   <label class='lbl' for="">Year/Month</label><br/>
                    <label style='display:block;font-size:20px;font-weight:bold'><?=$year?>/<?=$month+1?></label> 
                  </div>

             </div>
           <div class="row" style='margin-top:20px;padding:5px'>
                 <div class="form-group col-md-6">
                    <label class='lbl' for="">Paper Id <span class='req'>*</span></label>
                    <input onkeyup="generate_doi_url();" type="text" value="<?=$paper_id?>" name='paper_id' id='paper_id' placeholder="Enter  Paper Id" class="form-control" />
                </div>
                <?php
                if($modification_type!="Retraction"){
                ?>
                <div class="form-group col-md-3">
                    <label class='lbl' for="">Article Type</label>
                    <select  class='form-control' name="article_type" id="article_type">
                            <?php
                            $q="select * from article_type";
                            $stmt = $conn->query($q);
                            $i=1;
                            while(($row1=$stmt->fetchAssociative())!==false){
                              extract($row1);
                            ?>
                            <option <?=($row1['article_type_id']==$row['article_type_id'])?"selected":''?> value="<?=$article_type_id?>"><?=$article_type?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class='lbl' for="">Discipline  <span class='req'>*</span></label>
                    <select class='form-control' name="discipline" id="discipline">
                         <option value="">Select</option>
                        <?php
                            $q2="select * from discipline";
                            $stmt2 = $conn->query($q2);
                            $i=1;
                            while(($row2=$stmt2->fetchAssociative())!==false){
                             // extract($row2);
                            ?>
                            <option <?=($row['discipline']==$row2['discipline_id'])?"selected":''?> value="<?=$row2['discipline_id']?>"><?=$row2['discipline']?></option>
                            <?php
                            }
                          ?>
                    </select>
                </div>
                <?php
                }else{
                ?>
                <input type="hidden" name="discipline" id="discipline" value="0">
                <input type="hidden" name="article_type" id="article_type" value="0">
                <?php
                }
                ?>
                <div class="form-group col-md-6">
                    <?php
                   
                    $rec_date=date('d-m-Y',strtotime($recieved_date));
                    $ac_date=date('d-m-Y',strtotime($accepted_date));
                    $rev_date=date('d-m-Y',strtotime($revised_date));

                    ?>
                    <label class='lbl' for="">Title <span class='req'>*</span></label>
                    <input type="text" name='paper_title' value="<?=$title?>" id='paper_title' placeholder="Enter  Paper Title " class="form-control" />
                </div>

                <div class="form-group col-md-2">
                    <label class='lbl' for="">Received Date <span class='req'>*</span></label>
                    <input  type="text" required name='recieved_date' id='recieved_date' value="<?=$rec_date?>" placeholder="" class="form-control" />
                </div>

                <div class="form-group col-md-2">
                    <label class='lbl' for="">Revised Date <span class='req'>*</span></label>
                    <input  type="text" required name='revised_date' id='revised_date' value="<?=$rev_date?>"   placeholder="" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Accepted Date <span class='req'>*</span></label>
                    <input  type="text" required name='accepted_date' id='accepted_date' value="<?=$ac_date?>"  placeholder="" class="form-control" />
                </div>
               
        </div>
        <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6" style='margin-top:-25px'>
                <label class='error' for="" id='lblrecieved_date'></label>
                <label  class='error'  for="" id='lblrevised_date'></label>
                <label  class='error'  for="" id='lblaccepted_date'></label>
          </div>
        </div>
        <div class="row" style='padding:5px;'>
                <div class="form-group col-md-12">
                    <label class='lbl' for="">DOI <span class='req'>*</span> </label>
                    <input readonly type="text" value="<?=$do?>" name='doi' id='doi' value="" placeholder="" class="form-control" />
                </div>
        </div>
        <div class="row" style='padding:5px;'>
                <div class="form-group col-md-8">
                    <label class='lbl' for="">Hyperlink <span class='req'>*</span> </label>
                    <input type="hidden" name="abbri" id='abbri' value="<?=$journal_abbri?>">
                    <input type="hidden" name="month" id='month' value="<?=$month?>">
                    <input type="hidden" name="year" id='year' value="<?=$year?>">
                    <input type="hidden" name="record_type" id='record_type' value="<?=$record_type?>">
                    <input type="hidden" name="old_fullpaper" id='old_fullpaper' value="<?=$fullpaper?>">
                    <input type="hidden" name="old_full_graphical_abstract" id='graphical_abstract' value="<?=$full_graphical_abstract?>">
                    <input type="text"  value="<?=$doilink?>"  readonly name='doilink' id='doilink'   placeholder="" class="form-control" />
                </div>  
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Page <span class='req'>*</span></label><br/>
                    <input type="text" name='page_no_start' value="<?=$page_no_start?>" id='page_no_start' placeholder="Start" style='width:48%;float:left' class="form-control" />
                    <input type="text" name='page_no_end'  value="<?=$page_no_end?>"  id='page_no_end' placeholder="End" style='width:48%;float:right' class="form-control" />
                </div>
                <?php
                 if($modification_type!="Retraction"){
                 ?> 
                   <div class="form-group col-md-2">
                      <label class='lbl' for="">Authors <span class='req'>*</span></label><br/>
                      <input required type="number" onkeyup="get_authors();" value="<?=$no_authors?>"  onchange="get_authors();" id='no_authors' name='no_authors' placeholder="No of Authors"   class="form-control" />
                  </div> 
                <?php
                 }else{
                ?>
                  <input type="hidden" name="no_authors" id="no_authors" value="0">
                <?php
                 }
                ?>
        </div>
        <div class="row authordata">

        </div>
        <div class="row" style='padding:5px;'>
                 <div class="form-group col-md-12">
                    <label class='lbl' for="">Citation</label>
                    <textarea style='color:black;font-size:16px' onclick="generate_citations('paper');" placeholder='Click for generate citation' readonly class='form-control' name="citation" id="citation" cols="30" rows="10"><?=$citation?></textarea>
                 </div>
        </div>
        <div class="row" style='padding:5px;'>
                 <div class="form-group col-md-6">
                    <label class='lbl' for="">Citation MLA</label>
                        <textarea style='color:black;font-size:16px'  placeholder=''  class='form-control' name="citation_mla" id="citation_mla" cols="30" rows="10"><?=$citation_mla?></textarea> 
                  </div>
                  <div class="form-group col-md-6">
                    <label class='lbl' for="">Citation APA</label>
                        <textarea style='color:black;font-size:16px'   placeholder=''  class='form-control' name="citation_apa" id="citation_apa" cols="30" rows="10"><?=$citation_apa?></textarea> 
                </div>
        </div>
        <div class="row" style='padding:5px;'>
                 <div class="form-group col-md-6">
                    <label class='lbl' for="">Citation IEEE</label>
                        <textarea style='color:black;font-size:16px'  placeholder=''  class='form-control' name="citation_ieee" id="citation_ieee" cols="30" rows="10"><?=$citation_ieee?></textarea> 
                </div>
                <div class="form-group col-md-6">
                    <label class='lbl' for="">Citation Harvard</label>
                        <textarea style='color:black;font-size:16px' placeholder=''  class='form-control' name="citation_h" id="citation_h" cols="30" rows="10"><?=$citation_h?></textarea> 
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
                    <label class='lbl' for="">Refference <span class='req'>*</span></label>
                    <textarea required class='form-control' name="refference" id="reffrence" cols="30" rows="10"><?=$refference?></textarea>
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
                             $sql = "SELECT * FROM refrence where journalpaper_id='$journalpaper_id'";
                             $stmt = $conn->query($sql);
                             $i=1;
                             while(($row=$stmt->fetchAssociative())!==false){
                                extract($row);
                             ?>
                             <tr>
                                <td><b>[<?=$i?>]</b><?=$name?></td>
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
        <?php
        if($modification_type!="Retraction"){
        ?>
        <div class="row"  style='margin-top:10px'>
                 <div class="form-group col-md-12">
                    <label class='lbl' for="">Keywords <span class='req'>*</span></label>
                    <input style='width:100%' required  value="<?=$keyword?>"   autocomplete="off"  data-role="tagsinput"   type="text" Placeholder="Separated with comma"  name='keywords' id='keywords' class='form-control'  />     
                 </div>
        </div>
        <?php
        }else{
        ?>
        <input type="hidden" name='keywords' id='keywords' value=''>
        <?php
        }
        ?>
        <div class="row"  style='margin-top:10px'>
                <?php
                if($mode=="mix"){
                ?>
                 <div class="form-group col-md-4">
                    <label class='lbl' for="">Type</label>
                    <select name="type" id="type">
                         <option value="<?=$type?>" selected><?=$type?></option>
                         <option value="regualr">Regular</option>
                         <option value="special">Special</option>
                    </select>
                 </div>
                 <?php
                 }else{
                 ?>
                  <input type="hidden" name='type' value="<?=$type?>">
                 <?php
                 }
                 ?>
        </div>

        <div class="row" style='margin-top:10px'>
           <div class="col-md-6">
               <label class='lbl' for=""> Graphical Abstract <span class="req"></span></label>
               <input accept="image/*" type="file" onchange="getImg(this,graphical_img,'400','400');"    name='full_graphical_abstract' id='full_graphical_abstract'>
          </div>

          <div class="col-md-6">
               <label class='lbl'  for=""> Paper <span class="req">*</span></label>
             
               <input type="file"   onchange="chkDoc(0,'full_paper',5)";  <?=($fullpaper=="")?"required":""?>  name='full_paper' id='full_paper'>
          </div>
 
          <div class="col-md-6">
             <?php
              $month=$month+1;
              if($paperimage!=""){
                 $l2=base_url("PaperDirectory/Journal/$journal_abbri/$year/$month/").$paperimage;
               ?>
                   
                   <a target='_blank'    href="<?=$l2?>" ><img id='graphical_img' src="<?=$l2?>" style='width:100px;margin-top:10px'/></a>  
                 <?php
                }else{?>
                  <a target='_blank'     ><img id='graphical_img' src="https://via.placeholder.com/200x200" style='width:100px;margin-top:10px'/></a>  
                <?php
                }
                ?>
              
          </div>

          <div class="col-md-6">
              <?php
               if($fullpaper!=""){
                $l=base_url("PaperDirectory/Journal/$journal_abbri/$year/$month/").$fullpaper;
               ?>
                 
                 <a class='btn btn-success' style='margin-top:10px' href="<?=$l?>" target='_blank' ><i class='fa fa-download'></i>Download</a>
                 <?php
                }
              ?>
          </div>

          
          <?php
               if($mode=="mix"||$mode=="Mix"||$mode=="MIX"){
                ?>
                 <div class="form-group col-md-3" >
                    <label class='lbl' for="">Mode  <span class='req'>*</span></label>
                    <select required class='form-control' name="type" id="type">
                         <option value="<?=$type?>"><?=ucfirst($type)?></option>
                         <option value="regular">Regular</option>
                         <option value="special">Special</option>
                    </select>
                 </div>
                 <?php
                 }
                 else{
                 ?>
                  <input required type="hidden" name='type' value="<?=$mode?>">
                 <?php
              }
               
          ?>
          <?php
          if($st!="Current"){
            
          ?>
            <div class="col-md-2" style='margin-top:10px'>
                <label class='lbl' for="">Modification Type <span class="req"></span></label>
                <select onchange="set_modifi(this.value)" class='form-control' name="modification_type" id="modification_type">
                      <option value="<?=$modification_type?>" selected><?=($modification_type!="")?$modification_type:'Select'?></option>
                      <option value="Retraction">Retraction</option>
                      <option value="Correction">Correction</option>
                </select>
            </div>
          <?php
          }else{
            if($modification_type!=""){
           ?>
             <div class="col-md-2" style='margin-top:10px'>
                <label class='lbl' for="">Modification Type <span class="req"></span></label><br/>
                <label style='font-size:20px' for=""><?=$modification_type?></label>
                <input type="hidden" id='modification_type' name='modification_type' value="<?=$modification_type?>">
             </div>
           <?php
            }
          }
          ?> 
           <div class="col-md-12 <?=($modification_type=="")?'hidden':''?>" id='msg_modification' style='margin-top:10px'>
               <label class='lbl' for="">Modification Message<span class="req"></span>   [#linkurl#,#linkpdf# is a dynamic variable]</label>
               <textarea class='form-control' name="modification_message" id=""><?=$modification_message?></textarea>
          </div>
          <div class="col-md-12 <?=($modification_type=="")?'hidden':''?>" id='modi_alert_block' style='margin-top:10px'>
               <label class='lbl' for="">Modification Alert Message<span class="req"></span></label>
               <input class='form-control' name="modifi_alert_message" id="modifi_alert_message" value="<?=$modifi_alert_message?>"/>
          </div>

          <div class="col-md-12 <?=($modification_type=="")?'hidden':''?>" id='link_form' style='margin-top:10px'>
               <label class='lbl' for="">Link Url<span class="req"></span></label>
               <input type="text" name='link_url' value="<?=$link_url?>" class='form-control'/>
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
      </div><!-- panel -->
      </form>
  
 
 
    
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
        <h4 class="modal-title" id='title'>Add  University </h4>
      </div>
      <div class="modal-body">
        <form  method='post' >
          <div class="row">
                  <div class="form-group col-md-6">
                       <label class='lbl' for="">University Name</label>
                       <input type="text" value="" name='university'  id='university' placeholder="Enter University" class="form-control" />
                  </div>
                  <div class="form-group col-md-3">
                       <label class='lbl' for="">Country</label>
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
                       <label class='lbl' for="">State</label>
                       <select onchange="get_city()" class='form-control' name="state" id="state">
                           <option value="">select</option>
                       </select>
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">City</label>
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
 
 CKEDITOR.replace( 'abstract' );  
 CKEDITOR.replace( 'modification_message' );      
 
$(document).ready(function(){
    get_authors();    
    $(window).keydown(function(event){
      // if(event.keyCode == 13) {
      //   event.preventDefault();
      //   return false;
      // }
    });
   <?php
   if(isset($_REQUEST['journal'])) { 
   ?>
      abbr=<?=$_REQUEST['journal']?>+"#"+"<?=$_REQUEST['abbr']?>";
      $("#journals_id").val(abbr);
      get_issue();
     
   <?php
   }
   ?>
});

function get_issue(){
   burl="../ajax/get_journals_issue.php";
   journals_id=$("#journals_id").val();
   $.post(burl,{"id":journals_id},function(data,status){
       $("#issue").html(data); 
   }); 
}

function generate_doi_url(){
  paper_id=$("#paper_id").val();
  doi_journal="<?=$doi?>";
  complete_doi=doi_journal+""+paper_id;
  complete_doi_url="https://dx.doi.org/"+doi_journal+paper_id;
  $("#doi").val(complete_doi);
  $("#doilink").val(complete_doi_url);
}

function show_modal(i){
  $("#pos").val(i);
  $("#myModal").modal('show');
}
 
// function generate_citations(){
//   author_name_cite="";
//   no_of_author=$('#no_authors').val();
//   for(var i=1;i<=no_of_author;i++){
//       if($("#first_name_"+i).val()!=""){        
//         first_name=$("#first_name_"+i).val();
//         last_name=$("#last_name_"+i).val(); 
//         middle_name=$("#middle_name_"+i).val();
//         fn=first_name.trim();
//         mn=middle_name.trim();
//         ln=last_name.trim();
//         fnLen=fn.length;
//         mnLen=mn.length;
//         lnLen=ln.length;
        
//         if(i==no_of_author){

//                 if(lnLen>1) {   
//                     if(fn!=="" &&  mn!==""){
//                       author_name_cite += ln+" "+fn[0]+mn[0]+"";
//                     }
//                     else if(fn!=="" &&  mn==""){
//                         author_name_cite += ln+" "+fn[0]+"";
//                     }
//                     else if(mn!=="" &&  fn==""){
//                       author_name_cite += ln+" "+mn[0]+"";
//                     }           
//                 }            
//                 else if(mnLen>1){
//                     if(fn!=="" &&  ln!==""){
//                       author_name_cite += mn+" "+fn[0]+ln[0]+"";
//                     }
//                     else if(fn!=="" &&  ln==""){
//                       author_name_cite += mn+" "+fn[0]+"";
//                     }
//                     else if(ln!=="" &&  fn==""){
//                       author_name_cite += mn+" "+ln[0]+"";
//                   }            
//                 }
//               else if(fnLen>1){
                
//                   if(mn!=="" &&  ln!==""){
//                       author_name_cite += fn+" "+ln[0]+"";
//                   }
//                   if(ln!=="" &&  mn!==""){
//                       author_name_cite += fn+" "+mn[0]+"";
//                   }else{
                    
//                       author_name_cite += fn+" "+mn[0]+ln[0]+"";
//                   }
//               }
//               else if(fnLen==1 && mnLen==1 && lnLen==1){
//                     author_name_cite += ln+" "+fn[0]+mn[0]+"";
//               }
//         }
//         else{
//         if(lnLen>1) {   
//               if(fn!=="" &&  mn!==""){
//                 author_name_cite += ln+" "+fn[0]+mn[0]+", ";
//               }
//               else if(fn!=="" &&  mn==""){
//                   author_name_cite += ln+" "+fn[0]+", ";
//               }
//               else if(mn!=="" &&  fn==""){
//                 author_name_cite += ln+" "+mn[0]+", ";
//               }           
//           }            
//           else if(mnLen>1){
//               if(fn!=="" &&  ln!==""){
//                 author_name_cite += mn+" "+fn[0]+ln[0]+", ";
//               }
//               else if(fn!=="" &&  ln==""){
//                 author_name_cite += mn+" "+fn[0]+", ";
//               }
//               else if(ln!=="" &&  fn==""){
//                 author_name_cite += mn+" "+ln[0]+", ";
//              }            
//           }
//          else if(fnLen>1){
//             if(mn!=="" &&  ln!==""){
//                 author_name_cite += fn+" "+ln[0]+", ";
//             }
//             if(ln!=="" &&  mn!==""){
//                 author_name_cite += fn+" "+mn[0]+", ";
//             }else{
//               // author_name_cite += fn+" "+mn[0]+ln[0]+", ";
//                 author_name_cite += fn+",";
//             }
//         }
//         else if(fnLen==1 && mnLen==1 && lnLen==1){
//                author_name_cite += ln+" "+fn[0]+mn[0]+",";
//         }
//       }
//     }
//   }
//   author_name_cite;
//   page_no_start =$("#page_no_start").val();
//   page_no_end =$("#page_no_end").val();
//   paper_title =$("#paper_title").val();
//   author_name_cite+="."+paper_title+"."+"<?=$journal_name?>"+"." +"<?=$year?>"+"; "+"<?=$volume?>"+"("+<?=$issue?>+")"+":"+page_no_start+ "-" + page_no_end;
//   $("#citation").val(author_name_cite);
// }


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
// function add_university(){
//    pos=$("#pos").val();
//    university=$("#university").val();
//    country=$("#country").val();
//    state=$("#state").val();
//    city=$("#city").val(); 
//    zipcode=$("#zipcode").val();
//    address=$("#address").val();
//    burl="../ajax/adUniversity.php"; 
//    $.post(burl,{"university":university,"country":country,"state":state,"city":city,"zipcode":zipcode,"address":address},function(data,status){
//         if(data!="0"){
//           get_univerlist(pos,data);
//         }
//    });
// }


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
               $("#University Already Added").html("University Already Added");
               //already addres
            }     
            //$("#university_id").html(data);
        }
    });
}
else{
  //fillrequired
  $("#University Already Added").html("Please Select All Required Fields");
}
}
function delete_paper(id){
  if(confirm("Are you sure")){
       burl="../action/deleteNews.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

function get_authors(){
  cnt=$("#no_authors").val();
  burl="../ajax/get_authors.php"; 
  $.post(burl,{"authors":cnt,"type":"edit","cnt_author":<?=$no_authors?>,"jp_id":<?=$journalpaper_id?>,"p":"paper"},function(data,status){
     $(".authordata").html(data);
     get_univerlist(0,0,'edit');
     }); 
 }

   function get_univerlist(pos=0,id=0,type=""){
    burl="../ajax/get_univer_list.php"; 
    $.post(burl,{},function(data,status){
     $(".univerlist").html(data);
     if(id!=0){
       $("#university_"+pos).val(id);
       $("#myModal").modal('hide');
     }
     if(type!=""){
        sp=$("#unisellist").val();
         spd=sp.split(',');
         l=parseInt(spd.length);
         for(let i=0;i<l; i++){
              pos=i+1;
              $("#university_"+pos).val(spd[i]);
            } 
        //  setTimeout(function(){
         
        //  },1000);
        
     }

   }); 
}

function generate_issue_session(){
  journals_id=$("#journals_id").val();
  issue=$("#issue").val(); 
  burl="../action/generatepaperSession.php"; 
  $.post(burl,{"jid":journals_id,"issuid":issue},function(data,status){
      window.location.reload();
   }); 
}

function clear_session(){
  burl="../action/clearpaperSession.php"; 
  $.post(burl,{},function(data,status){
      window.location.reload();
   }); 
 }


 $(document).ready(function() {
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
t=true;


 
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

  //(recieved_date>accepted_date)?((recieved_date>revised_date)?)
  // act= (if(accepted_date!="")&&accepted_date>)?((accepted_date>recieved_date)?true: false):false;
  // revt=(revised_date>recieved_date)?((revised_date<accepted_date)?true:false):false;
  // rect=(recieved_date<accepted_date)?((recieved_date<revised_date)?true:false):false;
  // t=act*revt*rect;
  // return t;
  //(accepted_date>revised_date)?((accepted_date>recieved_date)?true:false):false;
  if (element == "lblrecieved_date") {
    if (accepted_date_ != "") {
      // alert(accepted_date+"<"+recieved_date);
      //alert(accepted_date);
      if (accepted_date <= recieved_date) {
        //alert("1");
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

function set_modifi(v){
  if(v!=""){
      $("#msg_modification").removeClass("hidden");
      $("#link_form").removeClass("hidden");
      $("#modi_alert_block").removeClass("hidden");
  }
  else{
      $("#msg_modification").addClass("hidden");
      $("#link_form").addClass("hidden");
      $("#modi_alert_block").addClass("hidden");
  }
}
</script>
