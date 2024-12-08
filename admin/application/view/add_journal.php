<?php
include "basic/admin_header.php";
?>

<div class="mainpanel">
<div class="contentpanel">
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Add Journal</a></li>
   
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Add Journal</h4>
        </div>
        <form onsubmit="return validation();" action="../action/adJournal.php" method='post'  enctype='multipart/form-data'>
        <div class="panel-body" style='margin-top:10px'>
        <div class="row">
          <div class="col-md-12">
              <ul class='msg'></ul>
          </div>
        </div>
        <div class="row">
                <div class="form-group col-md-5">
                    <label class='lbl' for="">Journal Name <span class='req'>*</span></label>
                    <input required type="text" name='name' placeholder="Enter  Journal Name" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label class='lbl' for="">Journal Abbreviation  <span class='req'>*</span></label>
                    <input onkeyup="check_abbr();" required type="text" name='journal_abbri' id='journal_abbri' placeholder="Enter  Journal Abbriviation" class="form-control" />
                  <p id='abbrimsg'></p>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">ISSN(P)</label>
                    <input  type="text" name='issnprint' id='issnprint' placeholder="Enter  Issn Print" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">ISSN(O)</label>
                    <input type="text" name='issnonline' id='issnonline'  placeholder="Enter  Issn Online" class="form-control" />
                </div>
        </div>
        <div class="row">
                <div class="form-group col-md-10">
                    <label class='lbl' for=""> DOI  <span class='req'>*</span></label>
                    <input required type="text" name='doi' placeholder="Enter  DOI" class="form-control" />
                </div>
              
                <div class="form-group col-md-12">
                    <label class='lbl' for="">About Journal<span class='req'>*</span></label>
                    <textarea  required class='form-control' name="journal_about" id="journal_about" cols="30" rows="10"></textarea>
                </div>
        </div>
        <div class="row" style='margin-top:10px'>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Logo</label>
                    <input  onchange="getImg(this,img_journal_logo,'400','400');" type="file" name='journal_logo' id='journal_logo'   class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Cover Page</label>
                    <input  onchange="getImg(this,img_cover_page,'400','400');" type="file" name='cover_page' id='cover_page'  class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Starting Year  <span class='req'>*</span></label>
                    <select required class='form-control' name="starting_year" id="starting_year">
                        <option value="">Year</option>
                        <?php
                        for($i=2011;$i<=2024;$i++){
                        ?>
                          <option value="<?=$i?>"><?=$i?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Current Year  <span class='req'>*</span></label>
                    <select required class='form-control' name="current_year" id="current_year">
                        <option value="">Year</option>
                        <?php
                        for($i=2011;$i<=2024;$i++){
                        ?>
                          <option value="<?=$i?>"><?=$i?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Frequency <span class="req">*</span></label>
                    <select class='form-control' name="frequency" id="frequency">
                          <?php
                           $sql = "SELECT * FROM frequency";
                           $stmt = $conn->query($sql);
                           $i=1;
                          while(($row=$stmt->fetchAssociative())!==false){
                              extract($row);
                           ?>
                            <option value="<?=$frequency_id?>-<?=$no?>"><?=$frequency?></option>
                          <?php
                          }
                         ?>
                    </select>
                </div>
               <div class="form-group col-md-2">
                    <label class='lbl' for="">Month <span class="req">*</span></label>
                    <select name='months[]'   required  data-dropdown-css-class="select2-purple"  data-placeholder="Select Month"   multiple    id="months" class="form-control select2">
                            <?php
                            for($i=0;$i<12;$i++){   
                             ?>
                             <option value="<?=$i?>"><?=get_month($i)?></option>
                            <?php
                            }
                           ?>
                    </select>
                </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <img style='width:100%' src="https://via.placeholder.com/200x200" alt="" id='img_journal_logo'>   
          </div>
          <div class="col-md-2">
            <img  style='width:100%' src="https://via.placeholder.com/200x200" alt="" id='img_cover_page'>  
          </div>
       </div>
      <div class="row">
        <div class="col-md-12">
             <hr>
        </div>
      </div>
       <div class="row">
           <div class="col-md-12" style='margin-top:10px'>
           <button  id='btn_journal'  class='btn btn-info'>Add Journal</button>
           </div>
       </div>
     </div>
     </div><!-- panel -->
     </div>
    </div><!-- col-sm-6 -->
    <!-- ####################################################### -->
  </div><!-- row -->

</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?>
<script>

function validation(){
  issnb=false;
  imgb=false;
  fqb=false;
  li="";
  issnp=$("#issnprint").val();
  issno=$("#issnonline").val();
  frq=$("#frequency").val();
  spl=frq.split("-");
  no=spl[1];
  count = $("#months").find(":selected").length;
  if(issnp!=""||issno!=""){
   issnb=true;
  }
  else{
    li+="<li style='color:red'>Please enter one or both ISSN numbers </li>";
   
    issnb=false;
  }
  if($("#journal_logo")[0].files.length != 0||$("#cover_page")[0].files.length != 0){
    imgb=true;
  }
  else{
    li+="<li style='color:red'>Please upload Cover Page or Logo</li>";
    imgb=false;
  }

  if(count!=no){
    li+="<li style='color:red'>Please Select Any "+no+" Month</li>";
    imgb=false;
  }
  else{
    imgb=true;
  }

  $(".msg").html(li);
  tt=Boolean(imgb*issnb*imgb);
  if(tt==true){
    $('#btn_journal').attr("disabled","disabled");
  }
  return tt;

}

function check_abbr(){
     abbri=$("#journal_abbri").val();
      burl="../ajax/checkAbbriviation.php"; 
      $.post(burl,{"abbri":abbri},function(data,status){
        if(data!="1"){
         $("#abbrimsg").html("<span style='color:red'>Abbriviation Already Exists</span");
         $('#btn_journal').attr("disabled","disabled");
        }
        else{
          $("#abbrimsg").html("");
          $('#btn_journal').removeAttr("disabled");
        }
      });
}

$(document).ready(function() {
    $('#months').select2({
       tags: true,
      tokenSeparators: [',', ' ']
    });
});






   
</script>
