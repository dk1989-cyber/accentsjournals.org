 


 <script src="<?=base_url('admin/lib/jquery/jquery.js')?>"></script>
<script src="<?=base_url('admin/lib/jquery-ui/jquery-ui.js')?>"></script>
<script src="<?=base_url('admin/lib/bootstrap/js/bootstrap.js')?>"></script>
<script src="<?=base_url('admin/lib/jquery-toggles/toggles.js')?>"></script>
 <script src="<?=base_url('admin/lib/morrisjs/morris.js')?>"></script>
<script src="<?=base_url('admin/lib/raphael/raphael.js')?>"></script>
<script src="<?=base_url('admin/lib/flot/jquery.flot.js')?>"></script>
<script src="<?=base_url('admin/lib/flot/jquery.flot.resize.js')?>"></script>
<script src="<?=base_url('admin/lib/flot-spline/jquery.flot.spline.js')?>"></script> 
<script src="<?=base_url('admin/lib/jquery-knob/jquery.knob.js')?>"></script>
<script src="<?=base_url('admin/js/quirk.js')?>"></script>
 <script src="<?=base_url('admin/lib/datatables/jquery.dataTables.js')?>"></script>  
 <script src="<?=base_url('admin/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js')?>"></script> -->

 
<script src="<?=base_url('admin/lib/jquery.gritter/jquery.gritter.js')?>" ></script>
<script src="<?=base_url('admin/js/dashboard.js')?>"></script>
<script src="https://theaccents.org/assets/backend/plugins/select2/js/select2.full.min.js"></script>


<script>
    $(document).ready(function(){
        $('#datatable1').DataTable();
        <?php
        if(isset($_REQUEST['success'])){
          if($_REQUEST['success']=="1"){  
        ?>
        $.gritter.add({
          title: 'Execute  Successfully',
          text: "<?=$_REQUEST['msg']?>",
          class_name: 'with-icon check-circle success'
        });
        <?php
          }
        }
        ?>        
        });

    var _URL = window.URL || window.webkitURL; 
    function getImg(dobj,id,w="",h=""){
        rndfile=dobj;
        rndimg=id;
        var img_file = $(rndfile).get(0).files[0];
        img = new Image();
        var imgwidth = 0;
        var imgheight = 0;
        var maxwidth = 220;
        var maxheight = 326;    
        img.src = _URL.createObjectURL(img_file);
        obj=dobj;  
        img.onload = function(){
        imgwidth = this.width;
        imgheight = this.height;
        if(w!=""&h!=""){
            //if(imgwidth==w&&imgheight==h){
            if(1){
            readURL(obj,rndimg);
            }
            else{
                alert("Please Upload Proper Image Dimension");
                $(dobj).val("");
            }
        }
        else{
            readURL(obj,rndimg);
        }
    }
    }
    function readURL(input,ids){
           if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e)
                {
                    $(ids).attr('src', e.target.result);						
                }
                reader.readAsDataURL(input.files[0]);
            }
            else
            { 
            }
    } 

    function get_month(i){
      m=["January","February","March","April","May","June","July","August","September","October","November","December"];
      return m[i];
    } 

  function generate_citations(p){
    if(p=="paper"){
      m=$("#modification_type").val();
      if(m=="Retraction"){
        $("#citation").removeAttr("readonly");
        return true;
      }
      else{
        $("#citation").attr("readonly",true);
      }
    }
    author_name_cite="";
    author_name_cite_mla="";
    author_name_cite_apa="";
    authot_name_cite_ieee="";
    authot_name_cite_harward="";

    no_of_author=$('#no_authors').val();
    for(var i=1;i<=no_of_author;i++){
      if($("#first_name_"+i).val()!=""){        
          first_name=$("#first_name_"+i).val();
          last_name=$("#last_name_"+i).val(); 
          middle_name=$("#middle_name_"+i).val();
          fn=(first_name.trim()!="")?(capitalizeFirstLetter(first_name.trim())):"";
          mn=(middle_name.trim()!="")?(capitalizeFirstLetter(middle_name.trim())):"";
          ln=(last_name.trim()!="")?(capitalizeFirstLetter(last_name.trim())):"";    
          fnLen=fn.length;
          mnLen=mn.length;
          lnLen=ln.length;
          if(i==no_of_author){
                  if(lnLen>1) {   
                      if(fn!=="" &&  mn!==""){
                        author_name_cite += ln+" "+fn[0]+mn[0]+"";
                        author_name_cite_mla += ln+" "+fn[0]+mn[0]+"";
                      }
                      else if(fn!=="" &&  mn==""){
                          author_name_cite += ln+" "+fn[0]+"";
                          author_name_cite_mla += ln+" "+fn[0]+"";
                      }
                      else if(mn!=="" &&  fn==""){
                        author_name_cite += ln+" "+mn[0]+"";
                        author_name_cite_mla += ln+" "+mn[0]+"";
                      }           
                  }            
                  else if(mnLen>1){

                      if(fn!=="" &&  ln!==""){
                        author_name_cite += mn+" "+fn[0]+ln[0]+"";

                        author_name_cite_mla += mn+" "+fn[0]+ln[0]+"";

                      }
                      else if(fn!=="" &&  ln==""){
                        author_name_cite += mn+" "+fn[0]+"";

                        author_name_cite_mla += mn+" "+fn[0]+"";

                      }
                      else if(ln!=="" &&  fn==""){
                        author_name_cite += mn+" "+ln[0]+"";

                        author_name_cite_mla += mn+" "+ln[0]+"";
                    }            
                }
                else if(fnLen>1){
                    if(mn!=="" &&  ln!==""){
                        author_name_cite += fn+" "+ln[0]+"";

                        author_name_cite_mla += fn+" "+ln[0]+"";
                    }
                    if(ln!=="" &&  mn!==""){
                        author_name_cite += fn+" "+mn[0]+"";
                        author_name_cite_mla += fn+" "+mn[0]+"";
                    }else{
                      // author_name_cite += fn+" "+mn[0]+ln[0]+"";
                      author_name_cite+=fn;

                      author_name_cite_mla+=fn;
                    }
                }
                else if(fnLen==1 && mnLen==1 && lnLen==1){
                      author_name_cite += ln+" "+fn[0]+mn[0]+"";
                      author_name_cite_mla += ln+" "+fn[0]+mn[0]+"";
                }
          }
          else{
          if(lnLen>1) {   
                if(fn!=="" &&  mn!==""){
                  author_name_cite += ln+" "+fn[0]+mn[0]+", ";

                  author_name_cite_mla += ln+" "+fn[0]+mn[0]+", ";

                }
                else if(fn!=="" &&  mn==""){
                    author_name_cite += ln+" "+fn[0]+", ";

                    author_name_cite_mla += ln+" "+fn[0]+", ";
                }
                else if(mn!=="" &&  fn==""){
                  author_name_cite += ln+" "+mn[0]+", ";

                  author_name_cite += ln+" "+mn[0]+", ";
                }           
            }            
            else if(mnLen>1){
                if(fn!=="" &&  ln!==""){
                  author_name_cite += mn+" "+fn[0]+ln[0]+", ";

                  author_name_cite += mn+" "+fn[0]+ln[0]+", ";

                }
                else if(fn!=="" &&  ln==""){
                  author_name_cite += mn+" "+fn[0]+", ";
                  
                  author_name_cite += mn+" "+fn[0]+", ";

                  
                }
                else if(ln!=="" &&  fn==""){
                  author_name_cite += mn+" "+ln[0]+", ";

                  author_name_cite += mn+" "+ln[0]+", ";
              }            
            }
          else if(fnLen>1){
              if(mn!=="" &&  ln!==""){
                  author_name_cite += fn+" "+ln[0]+", ";

                  author_name_cite += fn+" "+ln[0]+", ";
              }
              if(ln!=="" &&  mn!==""){
                  author_name_cite += fn+" "+mn[0]+", ";

                  author_name_cite += fn+" "+mn[0]+", ";
              }else{
                  author_name_cite += fn+" "+mn[0]+ln[0]+", ";

                  author_name_cite += fn+" "+mn[0]+ln[0]+", ";
              }
          }
          else if(fnLen==1 && mnLen==1 && lnLen==1){
                author_name_cite += ln+" "+fn[0]+mn[0]+",";

                author_name_cite += ln+" "+fn[0]+mn[0]+",";
          }
        }
      }
  }
  author_name_cite;
  page_no_start =$("#page_no_start").val();
  page_no_end =$("#page_no_end").val();
  paper_title =$("#paper_title").val();

  if(p=="paper"){
      author_name_cite+="."+paper_title+"."+"<?=(isset($_SESSION['PAPER_JNAME'])?$_SESSION['PAPER_JNAME']:'-')?>"+"." +<?=(isset($_SESSION['PAPER_YEAR'])?$_SESSION['PAPER_YEAR']:"-")?>+"; "+<?=(isset($_SESSION['PAPER_VOLUME'])?$_SESSION['PAPER_VOLUME']:"-")?>+"("+<?=(isset($_SESSION['PAPER_ISSUE'])?$_SESSION['PAPER_ISSUE']:"-")?>+")"+":"+getpageno();
  }
  else if(p=="press"){
    jname=$("#journals_id").val().split("#")[3];
    year="#year#";
    volume="#volume#";
    issue="#issue#";
    author_name_cite+="."+paper_title+"."+jname+"." +year+";"+volume+"("+issue+"):"+getpageno();
  }
  $("#citation").val(author_name_cite);
}
 


function getpageno(){
  page_no_start=$("#page_no_start").val();
  page_no_end=$("#page_no_end").val();
  str="";
  //alert(page_no_start.length);
  // if(page_no_start>=20&&page_no_end>=20){
  //   for(i=0;i<page_no_start.length;i++){
  //       if(page_no_start[i]==page_no_end[i]){
  //         str+=""+page_no_start[i]; 
  //       }
  //   }
  //   rep=page_no_end.replace(str,"");
  //   return page_no_start+"-"+rep;
  // }
  // else{
  //    return page_no_start+"-"+page_no_end;    
  // } 
  return page_no_start+"-"+page_no_end;   
}


function capitalizeFirstLetter(string) {
return string.charAt(0).toUpperCase() + string.slice(1);
}
</script>

</body>
 
</html>
