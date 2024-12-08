 


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
          }else{
            ?>
                $.gritter.add({
                title: 'Execution  Failed',
                text: "<?=$_REQUEST['msg']?>",
                class_name: 'with-icon cross-circle danger'
                });

            <?php
          }
        }
        ?>        
        });

    

    function get_month(i){
      m=["January","February","March","April","May","June","July","August","September","October","November","December"];
      return m[i];
    } 

   <?php //include('generate_site_script.php') ?>

  function generate_citations(p) {
	if (p == "paper") {
		m = $("#modification_type").val();
		if (m == "Retraction") {
			$("#citation").removeAttr("readonly");
			return true;
		} else {
			$("#citation").attr("readonly", true);
		}
	}
	author_name_cite = "";  //done
	author_name_cite_mla = ""; //done
	author_name_cite_ieee = "";//done
	author_name_cite_apa = "";//dn
	author_name_cite_h = "";

    
	no_of_author = $('#no_authors').val();
	temp_mla = [];
	temp_ieee = [];
  temp_apa = [];
  temp_h = [];
	for (var i = 1; i <= no_of_author; i++) {
		if ($("#first_name_" + i).val() != "") {
			first_name = $("#first_name_" + i).val();
			last_name = $("#last_name_" + i).val();
			middle_name = $("#middle_name_" + i).val();
			fn = (first_name.trim() != "") ? (capitalizeFirstLetter(first_name.trim())) : "";
			mn = (middle_name.trim() != "") ? (capitalizeFirstLetter(middle_name.trim())) : "";
			ln = (last_name.trim() != "") ? (capitalizeFirstLetter(last_name.trim())) : "";
			fnLen = fn.length;
			mnLen = mn.length;
			lnLen = ln.length;
			//last author //if no of author 1 it will run first time
			if (i == no_of_author) {
        if (lnLen > 1) {
          //for Vancuvar Style
          if (fn !== "" && mn !== "") {
              author_name_cite += ln + " " + fn[0] + mn[0] + "";
              //mla
              if (i < 2) {
                  author_name_cite_mla += ln + ", " + fn + " " + mn;
                  temp_cite_mla = ln + ", " + fn + " " + mn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += " and " + fn + " " + mn + " " + ln;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //IEEE citation & Apa
              if (i <= 6) {
            
                  //apa
                  if(i!=1){
                     author_name_cite_ieee += " and " + fn[0] + " " + mn[0] + "." + " " + ln;
                     author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                     author_name_cite_h += " and " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";

                  }
                  else{
                     author_name_cite_ieee += "" + fn[0] + " " + mn[0] + "." + " " + ln;
                     author_name_cite_apa +=ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                     author_name_cite_h +=ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                  }

                  
                  temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
                  temp_ieee.push(temp_cite_ieee);

                  temp_cite_apa = ln + " " + fn[0] + "." + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_apa);

                  temp_cite_h = ln + " " + fn[0] + "." + " " + mn[0] + ".";
                  temp_h.push(temp_cite_h);



              } else if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";
                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";
              }
          }
          //Close Citation
          else if (fn !== "" && mn == "") {
              author_name_cite += ln + " " + fn[0] + "";
              //Ashutosh Kumar   (i=no of author)
              //middlename empty
              if (i < 2) {
                  //MLA Cite
                  author_name_cite_mla += ln + ", " + fn;
                  temp_cite_mla = ln + ", " + fn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += " and " + fn + " " + ln;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //Close MLA Cite
              //IEEE Cite
              if (i <= 6) {
                  //ieee
                
                  if (i != 1) {
                      author_name_cite_ieee += " and " + fn[0] + "." + " " + ln + "";
                      author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + "";
                      author_name_cite_h += " and " + ln + ", " + fn[0] + "." + "";

                  } else {
                      author_name_cite_ieee += "" + fn[0] + "." + " " + ln + "";
                      author_name_cite_apa += "" + ln + ", " + fn[0] + "." + " ";
                      author_name_cite_h += "" + ln + ", " + fn[0] + "." + "";
                  }
                 
                  temp_cite_ieee = fn[0] + "." + " " + ln;
                  temp_ieee.push(temp_cite_ieee);

                  temp_cite_apa = ln + "," + " " + fn[0] + "." ;
                  temp_apa.push(temp_cite_apa);

                  temp_cite_h = ln + "," + " " + fn[0] + "." ;
                  temp_apa.push(temp_cite_h);

              }
              if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";
                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";

                  author_name_cite_h = temp_h.join();
                  author_name_cite_h += " et al. ";
              }
              //Close IEEE Cite
          } 
          else if (mn !== "" && fn == "") {
              author_name_cite += ln + " " + mn[0] + "";
              // Kumar   (i=no of author)
              ///author_name_cite_mla+=ln+", "+kumar+"";
              //first name empty
              if (i < 2) {
                  author_name_cite_mla += ln + ", " + mn;
                  temp_cite_mla = ln + ", " + mn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += ", and " + ln;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //IEEE Cite
              if (i <= 6) {
                 
                  if(i!=1){
                    author_name_cite_ieee += " and " + mn[0] + "." + " " + ln + "";
                    author_name_cite_apa += " & " + ln + ", " + mn[0] + ".";
                    author_name_cite_h += " and " + ln + ", "+ mn[0] + ".";
                  }
                  else{
                    author_name_cite_ieee += "" + mn[0] + "." + " " + ln + "";
                    author_name_cite_apa += "" + ln + ", "+" " + mn[0] + ".";
                    author_name_cite_h += "" + ln + ", " + mn[0] + ".";
                  }
                 
                  temp_cite_ieee = ln;
                  temp_ieee.push(temp_cite_ieee);

                  temp_cite_apa = ln + "," + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_apa);

                  temp_cite_h = ln + "," + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_h);

              }
              if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";

                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";

                  author_name_cite_h = temp_h.join();
                  author_name_cite_h += " et al. ";
              }  
          } //Close IEEE Cite
      } 
        else if (mnLen > 1) {
          if (fn !== "" && ln !== "") {
              author_name_cite += mn + " " + fn[0] + ln[0] + "";
              // author_name_cite_mla+=ln+", "+fn+ " "+mn;
              //last name empty
              if (i < 2) {
                  author_name_cite_mla += ln + ", " + fn + " " + mn;
                  temp_cite_mla = ln + ", " + fn + " " + mn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += ", and " + ln;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //IEEE Cite
              if (i <= 6) {

                   
                  if(i!=1){
                    author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln + "";
                    author_name_cite_apa += " & " + ln + ", " + " " + mn[0] + ".";
                    author_name_cite_h += " and " + ln + ", " + " " + mn[0] + ".";
                  }
                  else{

                    author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln + "";
                    author_name_cite_apa += " & " + ln + ", " + " " + mn[0] + ".";
                    author_name_cite_h += " and " + ln + ", " + " " + mn[0] + ".";

                  }
                
                  temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
                  temp_ieee.push(temp_cite_ieee);                 
                
                  temp_cite_apa = ln + "," + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_apa);

                  temp_cite_h = ln + "," + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_apa);

              }
              if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";

                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";

                  author_name_cite_h = temp_h.join();
                  author_name_cite_h += " et al. ";

              } else {
                  // author_name_cite_ieee+=fn[0]+"."+" "+" "+ln;
                  if (author_name_cite_ieee != "") {
                      //	author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln;
                  } else {
                      //author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
                  }
              }
              //Close IEEE Cite
          } else if (fn !== "" && ln == "") {
              author_name_cite += mn + " " + fn[0] + "";
              //author_name_cite_mla+=ln+", "+fn+ " "+mn;
              //firt+middle+
              if (i < 2) {
                  author_name_cite_mla += fn + " " + mn;
                  temp_cite_mla = fn + " " + mn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += ", and " + mn;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //IEEE Cite
              //lname=empty
              if (i <= 6) {
                  author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + "";
                  temp_cite_ieee = fn[0] + "." + " " + mn[0] + ".";
                  temp_ieee.push(temp_cite_ieee);

                  //apa
                  if(i!=1){
                    author_name_cite_apa += " & " + mn + ", " + fn[0] + "." + "";
                    author_name_cite_h += " and " + mn + ", " + fn[0] + "." + "";
                  }
                  else{
                    author_name_cite_apa += "" + mn + ", " + fn[0] + "." + "";
                    author_name_cite_h += "" + mn + ", " + fn[0] + "." + "";
                  }
              
                  temp_cite_apa = mn + "," + " " + fn[0] + ".";
                  temp_apa.push(temp_cite_apa);

              }
              if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";

                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";

                  author_name_cite_h = temp_h.join();
                  author_name_cite_h += " et al. ";

              }  
              //Close IEEE Cite
          } else if (ln !== "" && fn == "") {
              author_name_cite += mn + " " + ln[0] + "";
              if (i < 2) {
                  author_name_cite_mla += ln + ", " + mn;
                  temp_cite_mla = ln + ", " + mn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += " and " + mn;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //IEEE Cite
              //fname empty
              if (i <= 6) {
                  
                  
                  if(i!=1){  
                  author_name_cite_ieee += " and " + mn[0] + "." + " " + ln + ", ";
                  author_name_cite_apa += " and " + mn + ", " + fn[0] + "." + "";
                  author_name_cite_h += " and " + mn + ", " + fn[0] + "." + "";
                  }
                  else{
                  author_name_cite_ieee += "" + mn[0] + "." + " " + ln + ", ";
                  author_name_cite_apa += "" + mn + ", " + fn[0] + "." + "";
                  author_name_cite_h += "" + mn + ", " + fn[0] + "." + "";
                  }

                  temp_cite_ieee = mn[0] + "." + " " + ln;
                  temp_ieee.push(temp_cite_ieee);

                  temp_cite_apa = mn + "," + " " + fn[0] + ".";
                  temp_apa.push(temp_cite_apa);

                  temp_cite_h= mn + "," + " " + fn[0] + ".";
                  temp_apa.push(temp_cite_h);
              }
              if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";

                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";

                  author_name_cite_h = temp_h.join();
                  author_name_cite_h += " et al. ";
              }
          }
          //Close IEEE Cite
      } 
      else if (fnLen > 1) {
          if (mn !== "" && ln !== "") {
              //fname+mname+lname
              author_name_cite += fn + " " + ln[0] + "";

              if (i < 2) {
                  author_name_cite_mla += ln + ", " + fn + " " + mn;
                  temp_cite_mla = ln + ", " + fn + " " + mn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += ", and" + fn + " " + mn + " " + ln;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //IEEE Cite
              if (i <= 6) {

                  
                  //apa
                  if(i!=1){
                    author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln[0] + "";
                    author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                    author_name_cite_h += " and " + ln + ", " + fn[0] + "." + "" + mn[0] + ".";
                  }
                  else{
                    author_name_cite_ieee += "" + fn[0] + "." + " " + mn[0] + "." + " " + ln[0] + "";
                    author_name_cite_apa += "" + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                    author_name_cite_h += "" + ln + ", " + fn[0] + "." + "" + mn[0] + ".";
                  }
                 
                  temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
                  temp_ieee.push(temp_cite_ieee);
                  
                  temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_apa);

                  temp_cite_h = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_h);

              }
              if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";

                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";

                  author_name_cite_h = temp_h.join();
                  author_name_cite_h += " et al. ";
              }
              //Close IEEE Cite
          }
          if (ln !== "" && mn !== "") {
              author_name_cite += fn + " " + mn[0] + "";
              if (i < 2) {
                  author_name_cite_mla += ln + ", " + fn + " " + mn;
                  temp_cite_mla = ln + ", " + fn + " " + mn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //IEEE Cite
              if (i <= 6) {
                 

                  if(i!=1){
                    author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln + "";
                    author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                    author_name_cite_h += " and " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                  }
                  else{
                    author_name_cite_ieee += "" + fn[0] + "." + " " + mn[0] + "." + " " + ln + "";
                    author_name_cite_apa += "" + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                    author_name_cite_h += "" + ln + ", " + fn[0] + "." + "" + mn[0] + ".";
                  }

                  temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
                  temp_ieee.push(temp_cite_ieee);
               
                  temp_cite_apa = ln + "," + fn[0] + "." + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_apa);

                  
                  temp_cite_h = ln + "," + fn[0] + "." + " " + mn[0] + ".";
                  temp_apa.push(temp_cite_h);

              }
              if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";

                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";

                  author_name_cite_h = temp_h.join();
                  author_name_cite_h += " et al. ";

              }
              //Close IEEE Cite
          } else {
              author_name_cite += fn+",";
              if (i < 2) {
                  author_name_cite_mla += fn;
                  temp_cite_mla = fn;
                  temp_mla.push(temp_cite_mla);
              } else if (i == 2) {
                  author_name_cite_mla = temp_mla[0];
                  author_name_cite_mla += ", and " + fn;
              } else if (i > 2) {
                  author_name_cite_mla = temp_mla[0] + " et al. ";
              }
              //IEEE Cite
              if (i <= 6) {
                  
                  temp_cite_ieee = fn[0] + ".";
                  temp_ieee.push(temp_cite_ieee);

                  if(i!=1){
                    author_name_cite_ieee += " and " + fn + " ";
                    author_name_cite_apa += " & " + fn;
                   
                  }
                  else{
                    author_name_cite_ieee += " and " + fn + " ";
                    author_name_cite_apa += fn;
                    author_name_cite_h += " and " + fn;
                  }
                  
                  temp_cite_apa = fn;
                  temp_apa.push(temp_cite_apa);

              }
              if (i > 6) {
                  author_name_cite_ieee = temp_ieee.join();
                  author_name_cite_ieee += " et al. ";

                  author_name_cite_apa = temp_apa.join();
                  author_name_cite_apa += " et al. ";

                  author_name_cite_h = temp_h.join();
                  author_name_cite_h += " et al. ";
              }
              //Close IEEE Cite
          }
      } else if (fnLen == 1 && mnLen == 1 && lnLen == 1) {
          author_name_cite += ln + " " + fn[0] + mn[0] + "";
          if (i < 2) {
              author_name_cite_mla += ln + ", " + fn + " " + mn;
              temp_cite_mla = ln + ", " + fn + " " + mn;
              temp_mla.push(temp_cite_mla);
          } else if (i == 2) {
              author_name_cite_mla = temp_mla[0];
              author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
          } else if (i > 2) {
              author_name_cite_mla = temp_mla[0] + " et al. ";
          }
          //IEEE Cite
          if (i <= 6) {
             
              if(i!=1){
                author_name_cite_ieee += " and " + fn[0] + "." + "  " + mn[0] + "." + " " + ln + "";
                author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                author_name_cite_h += " and " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
              }
              else{
                author_name_cite_ieee += "" + fn[0] + "." + "  " + mn[0] + "." + " " + ln + "";
                author_name_cite_apa += "" + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                author_name_cite_h += "" + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                
              }
           
              temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
              temp_ieee.push(temp_cite_ieee);

              temp_cite_apa = ln + "," + fn[0] + "." + " " + mn[0] + ".";
              temp_apa.push(temp_cite_apa);

              temp_cite_h = ln + "," + fn[0] + "." + " " + mn[0] + ".";
              temp_apa.push(temp_cite_h);

          } else if (i > 6) {
              author_name_cite_ieee = temp_ieee.join();
              author_name_cite_ieee += " et al. ";

              author_name_cite_apa = temp_apa.join();
              author_name_cite_apa += " et al. ";

              author_name_cite_h = temp_h.join();
              author_name_cite_h += " et al. ";
          }
          //Close IEEE Cite
      }
	 }  
			//rest authour//
    //================rest authour=========================
	   else {   
          if (lnLen > 1) {
              if (fn !== "" && mn !== "") {
                  author_name_cite += ln + " " + fn[0] + mn[0] + ", ";
                  //fname+mname+lname
                  if (i < 2) {
                      author_name_cite_mla += ln + ", " + fn + " " + mn;
                      temp_cite_mla = ln + ", " + fn + " " + mn;
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }
                  //IEEE Citation
                  if (i <= 6) {

                      author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln + ", ";
                      temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
                      temp_ieee.push(temp_cite_ieee);

                      author_name_cite_apa += ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_apa.push(temp_cite_apa);

                      author_name_cite_h += ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_cite_h = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_h.push(temp_cite_h);

                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";

                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";

                      author_name_cite_h = temp_h.join();
                      author_name_cite_h += " et al. ";

                  } else {
                      //author_name_cite_ieee += fn[0] + "." + " " +mn[0]+"."+ " " + ln;
                  }
                  //Close IEEE Citation
              } else if (fn !== "" && mn == "") {
                  author_name_cite += ln + " " + fn[0] + ", ";
                  if (i < 2) {
                      author_name_cite_mla += ln + ", " + fn;
                      temp_cite_mla = ln + ", " + fn;
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + fn + " " + ln;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }
                  //IEEE Citation
                  if (i <= 6) {
                      author_name_cite_ieee += fn[0] + "." + " " + ln + ", ";
                      temp_cite_ieee = fn[0] + "." + " " + ln;
                      temp_ieee.push(temp_cite_ieee);

                      author_name_cite_apa += ln + ", " + fn[0] + ".";
                      temp_cite_apa = ln + ", " + fn[0] + ".";
                      temp_apa.push(temp_cite_apa);

                      author_name_cite_h += ln + ", " + fn[0] + ".";
                      temp_cite_h = ln + ", " + fn[0] + ".";
                      temp_h.push(temp_cite_h);

                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";

                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";

                      author_name_cite_h = temp_h.join();
                      author_name_cite_h += " et al. ";

                  }
                  //Close IEEE Citation
              } else if (mn !== "" && fn == "") {
                  author_name_cite += ln + " " + mn[0] + ", ";
                  //mname+lanme;
                  if (i < 2) {
                      author_name_cite_mla += ln + ", " + mn;
                      temp_cite_mla = ln + ",  " + mn;
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + mn + " " + ln;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }
                  //IEEE Citation
                  if (i <= 6) {
                      author_name_cite_ieee += mn[0] + "." + " " + ln + ", ";
                      temp_cite_ieee = mn[0] + "." + " " + ln;
                      temp_ieee.push(temp_cite_ieee);

                      author_name_cite_apa += ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_apa.push(temp_cite_apa);

                      author_name_cite_h += ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_cite_h = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_h.push(temp_cite_h);
                      
                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";

                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";

                      author_name_cite_h = temp_h.join();
                      author_name_cite_h += " et al. ";

                  }
                  //Close IEEE Citation
              }
          } else if (mnLen > 1) {
              if (fn !== "" && ln !== "") {
                  author_name_cite += mn + " " + fn[0] + ln[0] + ", ";
                  if (i < 2) {
                      author_name_cite_mla += ln + ", " + fn + " " + mn;
                      temp_cite_mla = ln + ",  " + fn + " " + mn;
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }
                  //IEEE Citation
                  if (i <= 6) {
                      author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + "  " + ln + ", ";
                      temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + "  " + ln;
                      temp_ieee.push(temp_cite_ieee);

                      author_name_cite_apa += ln + ", " + fn[0] + "." + "  " + mn[0] + ".";
                      temp_cite_apa = ln + "," + fn[0] + "." + " " + mn[0] + ".";
                      temp_apa.push(temp_cite_apa);

                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";

                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";

                  } else {

                  }
                  //Close IEEE Citation
              } else if (fn !== "" && ln == "") {
                  author_name_cite += mn + " " + fn[0] + ", ";
                  //fname+mn
                  if (i < 2) {
                      author_name_cite_mla += fn + " " + mn;
                      temp_cite_mla = fn + " " + mn;
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + fn + " " + mn;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }
                  //IEEE citation
                  if (i <= 6) {
                      author_name_cite_ieee += fn[0] + "." + " " + mn + ", ";
                      temp_cite_ieee = fn[0] + "." + " " + mn + ".";
                      temp_ieee.push(temp_cite_ieee);


                      author_name_cite_apa += mn + ", " + fn[0] + ".";
                      temp_cite_apa = mn + "," + fn[0] + ".";
                      temp_apa.push(temp_cite_apa);

                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";

                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";


                  } else {
                      //	author_name_cite_ieee += fn[0] + "." + " " + mn[0] + ".";
                  }
                  //Close IEEE Cite
              } else if (ln !== "" && fn == "") {
                  author_name_cite += mn + " " + ln[0] + ", ";
                  if (i < 2) {
                      author_name_cite_mla += ln + ", " + mn;
                      temp_cite_mla = ln + ",  " + mn;
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + mn + " " + ln;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }
                  //IEEE citation
                  if (i <= 6) {
                      author_name_cite_ieee += mn[0] + "." + " " + ln + ", ";
                      temp_cite_ieee = mn[0] + "." + " " + ln;
                      temp_ieee.push(temp_cite_ieee);

                      author_name_cite_apa += ln + ", " + "  " + mn[0] + ".";
                      temp_cite_apa = ln + ", " + mn[0] + ".";
                      temp_apa.push(temp_cite_apa);

                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";
                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";
                  }
                  //Close IEEE Cite
              }
          } else if (fnLen > 1) {
              if (mn !== "" && ln !== "") {
                  author_name_cite += fn + " " + ln[0] + ", ";
                  if (i < 2) {
                      author_name_cite_mla += ln + ", " + fn + " " + mn;
                      temp_cite_mla = ln + ",  " + fn + " " + mn;
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }
                  //IEEE citation
                  if (i <= 6) {
                      author_name_cite_ieee += fn[0] + "." + mn[0] + "." + " " + " " + ln + ", ";
                      temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
                      temp_ieee.push(temp_cite_ieee);

                      author_name_cite_apa += ln + ", " + fn[0] + "." + "  " + mn[0] + ".";
                      temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
                      temp_apa.push(temp_cite_apa);
                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";
                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";
                  }
                  //Close IEEE Cite
              }
              if (ln !== "" && mn !== "") {
                  author_name_cite += fn + " " + mn[0] + ", ";
                  if (i < 2) {
                      author_name_cite_mla += ln + ", " + mn;
                      temp_cite_mla = ln + ",  " + mn;
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }

                  //IEEE citation
                  if (i <= 6) {
                      author_name_cite_ieee += fn[0] + "." + " " + ln + ", ";
                      temp_cite_ieee = fn[0] + "." + " " + ln;
                      temp_ieee.push(temp_cite_ieee);

                      author_name_cite_apa += ln + ", " + fn[0] + ".";
                      temp_cite_apa = ln + "," + fn[0] + ".";
                      temp_apa.push(temp_cite_apa);

                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";

                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";
                  } else {
                      //author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
                  }

              } else {
                  author_name_cite += fn+", ";
                  if (i < 2) {
                      author_name_cite_mla += fn + ", ";
                      temp_cite_mla = fn + ", ";
                      temp_mla.push(temp_cite_mla);
                  } else if (i == 2) {
                      author_name_cite_mla = temp_mla[0];
                      author_name_cite_mla += ", and " + fn;
                  } else if (i > 2) {
                      author_name_cite_mla = temp_mla[0] + " et al. ";
                  }

                  if (i <= 6) {
                      //only first name
                      author_name_cite_ieee += fn + ", ";
                      temp_cite_ieee = fn;
                      temp_ieee.push(temp_cite_ieee);
                      //apa
                      author_name_cite_apa +=  fn+", ";
                      temp_cite_apa = fn;
                      temp_apa.push(temp_cite_apa);

                      //h
                      author_name_cite_h += fn + ", ";
                      temp_cite_h = fn;
                      temp_h.push(temp_cite_h);

                  }
                  if (i > 6) {
                      author_name_cite_ieee = temp_ieee.join();
                      author_name_cite_ieee += " et al. ";

                      author_name_cite_apa = temp_apa.join();
                      author_name_cite_apa += " et al. ";

                      author_name_cite_h = temp_h.join();
                      author_name_cite_h += " et al. ";

                  }  
              }
          } else if (fnLen == 1 && mnLen == 1 && lnLen == 1) {
              author_name_cite += ln + " " + fn[0] + mn[0] + ",";
           }
		   }
  }
 }
	// 

	//author_name_cite="";
	page_no_start = $("#page_no_start").val();
	page_no_end = $("#page_no_end").val();
	paper_title = $("#paper_title").val();
	if (p == "paper") {
  
        month="<?=(isset($_SESSION['PAPER_MONTH'])?$_SESSION['PAPER_MONTH']:'')?>";
       
        day=1;
        author_name_cite += "." + paper_title + "." + "<?=(isset($_SESSION['PAPER_JNAME'])?$_SESSION['PAPER_JNAME']:'-')?>" + "." + <?= (isset($_SESSION['PAPER_YEAR']) ? $_SESSION['PAPER_YEAR'] : "-") ?> +"; " + <?= (isset($_SESSION['PAPER_VOLUME']) ? $_SESSION['PAPER_VOLUME'] : "-") ?> +"(" + <?= (isset($_SESSION['PAPER_ISSUE']) ? $_SESSION['PAPER_ISSUE'] : "-") ?> +")" + ":" + getpageno();
        author_name_cite_mla += "." + paper_title + "." + " “<?=(isset($_SESSION['PAPER_JNAME'])?$_SESSION['PAPER_JNAME']:'')?>.” " + ",vol. " + "<?=(isset($_SESSION['PAPER_VOLUME'])?$_SESSION['PAPER_VOLUME']:" - ")?>" + ",no." + "<?=(isset($_SESSION['PAPER_ISSUE'])?$_SESSION['PAPER_ISSUE']:"  ")?> " + month + " <?=(isset($_SESSION['PAPER_YEAR'])?$_SESSION['PAPER_YEAR']:"")?>" + ", " + "pp." + getpageno();
        author_name_cite_ieee += "," + "“"+paper_title +",”"+" <?=(isset($_SESSION['PAPER_JNAME'])?$_SESSION['PAPER_JNAME']:'')?>,"+" vol. "+"<?=(isset($_SESSION['PAPER_VOLUME'])?$_SESSION['PAPER_VOLUME']:" - ")?>,"+"no. "+"<?=(isset($_SESSION['PAPER_ISSUE'])?$_SESSION['PAPER_ISSUE']:"")?>,"+"pp. "+getpageno()+","+"<?=(isset($_SESSION['PAPER_YEAR'])?$_SESSION['PAPER_YEAR']:"")?>"
        author_name_cite_apa += "." +"(<?=(isset($_SESSION['PAPER_YEAR'])?$_SESSION['PAPER_YEAR']:"")?>, "+month+" "+day+" ). "+ paper_title +"."+" <?=(isset($_SESSION['PAPER_JNAME'])?$_SESSION['PAPER_JNAME']:'')?>, "+"<?=(isset($_SESSION['PAPER_VOLUME'])?$_SESSION['PAPER_VOLUME']:"")?>(<?=(isset($_SESSION['PAPER_ISSUE'])?$_SESSION['PAPER_ISSUE']:"")?>),"+ getpageno()+".";
        author_name_cite_h += "." +"<?=(isset($_SESSION['PAPER_YEAR'])?$_SESSION['PAPER_YEAR']:"")?>. "+ paper_title +"."+" <?=(isset($_SESSION['PAPER_JNAME'])?$_SESSION['PAPER_JNAME']:'')?>, "+"<?=(isset($_SESSION['PAPER_VOLUME'])?$_SESSION['PAPER_VOLUME']:"")?>(<?=(isset($_SESSION['PAPER_ISSUE'])?$_SESSION['PAPER_ISSUE']:"")?>),"+"pp."+ getpageno()+".";
  }
   else if (p == "press") {
        jname = $("#journals_id").val().split("#")[3];
        year = "#year#";
        volume = "#volume#";
        issue = "#issue#";
        month="#month#";
        day="#day#";
		author_name_cite += "." + paper_title + "." + jname + "." + year + ";" + volume + "(" + issue + "):" + getpageno();
        author_name_cite_mla += "." + paper_title + "." + " “'"+jname+"'.” " + ",vol. " + volume + ",no." +issue+" "+month+" "+year+ ", " + "pp." + getpageno();
        author_name_cite_ieee += "," + "“"+paper_title +",”"+" "+jname+","+" vol. "+volume+","+"no. "+issue+","+"pp. "+getpageno()+","+year
        author_name_cite_apa += "." +"("+year+","+month+" "+day+"). "+ paper_title +"."+jname+", "+volume+"("+issue+"),"+ getpageno()+".";
        author_name_cite_h += "." +year+". "+ paper_title +"."+jname+", "+volume+"("+issue+"),"+"pp."+ getpageno()+".";

	}
	  $("#citation").val(author_name_cite);
	  $("#citation_mla").val(author_name_cite_mla);
	  $("#citation_ieee").val(author_name_cite_ieee);
      $("#citation_apa").val(author_name_cite_apa);
      $("#citation_h").val(author_name_cite_h);
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




 

var r1 = /(\.pdf|\.PDF)$/i;
var r2 = /(\.jpg|\.jpeg\.JPG|\.JPEG|\.png|\.PNG|\.gif|\.GIF)$/i;
varray=[r1,r2];
varraytitle=[
              "Please Upload Pdf & Doc File",  
              "Pleae Upload Image File",
];



var _URL = window.URL || window.webkitURL; 
    function getImg(dobj,id,w="",h=""){
       idn=$(dobj).get(0).id;
        
       if(fileValidation(1,idn,1)){
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
      }else{
        $(rndimg).attr('src',null);	
        alert("Please Upload Image Only Size Not Greater than 1 MB");
      }
    }


    function readURL(input,ids){  
           if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $(ids).attr('src', e.target.result);						
                }
                reader.readAsDataURL(input.files[0]);
            }
            else
            { 
            }
  } 


  function chkDoc(t,file,s){
    if(!fileValidation(t,file,s)){
      alert("Upload valid pdf file. not greater than "+s+" MB")
    }
  }
  function fileValidation(t,file,s){
     fs_=false;
     ft_=false;
     f=$("#"+file).val().split('\\').pop();
    upsize=Math.round($('#'+file)[0].files[0].size/1048576);
    if (!varray[t].exec(f)) {  
      $("#"+file).val("");
         ft_=false;
    }
    else{
        ft_=true;
    }
    if(upsize>s){
         fs_=false;
         $("#"+file).val("");
    }
    else{
        fs_=true;
    }
    tf=fs_*ft_;
    return tf;
}

 
var form = document.getElementById('accentform');
var button = document.getElementById('btn');

form.addEventListener('submit', function(event) {
  button.disabled = true;
  // submit the form...
});

 
</script>

</body>
 
</html>
