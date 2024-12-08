<?php
include "basic/admin_header.php";
?>
<div class="mainpanel">
<div class="contentpanel">
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Edit User</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
    <form action="../action/udateUser.php" method='post'>
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Edit User</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
        <?php
         extract($_REQUEST);
         $sql = "SELECT * FROM users where users_id='$id'";
         $stmt = $conn->query($sql);
         $row=$stmt->fetchAssociative();
         extract($row);
        ?>
        <div class="row">
                <div class="form-group col-md-5">
                    <label class='lbl' for=""> Name</label>
                    <input type="hidden" name='id' value="<?=$id?>">
                    <input name='name' id='name' value="<?=$name?>" type="text" placeholder="Enter  Name" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label class='lbl' for="">Mobile No</label>
                    <input name='mobile' id='mobile' value="<?=$mobile?>"  type="text" placeholder="Enter  Mobile" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Email</label>
                    <input name='email' id='email'  value="<?=$email?>" readonly   type="text" placeholder="Enter  Email" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Password</label>
                    <input name='password' id='password'  value="<?=$password?>"   type="text" placeholder="Enter Password" class="form-control" />
                </div>
        </div>
       <div class="row">
        
          <?php
              $sql = "SELECT * FROM `menu` where status='Enable'";
              $stmt = $conn->prepare($sql);
              $resultSet = $stmt->executeQuery();
              $chk_array=array();
              $m=array();
              while (($r = $resultSet->fetchAssociative()) !== false) {   
                ?>
                <div class='col-md-3' >
                            <ul style='list-style:none;border:1px solid #efefef;padding:5px;min-height:200px'>
                            <li><input type="checkbox" class="role_<?=$r['menu_id']?>"  onclick="role_apply('role_<?=$r['menu_id']?>','P','0','<?=$r['menu_id']?>');" value="<?=$r['menu_id']?>"  name='menu[]' id="chk_<?=$r['menu_id']?>" /><label for="chk_<?=$r['menu_id']?>"><b style='color:#145388;margin-left:3px;font-weight:bold'><?=$r['menu_name']?></b></label>
                                <ul style='list-style:none'>
                                    <?php
                                        $q3="select * from sub_menu where menu_id=".$r['menu_id'];
                                        $stmt = $conn->prepare($q3);
                                        $resultSet2 = $stmt->executeQuery();
                                        $sttl=0;
                                        $sttlchk=0;
                                        while (($r2 = $resultSet2->fetchAssociative()) !== false) {

                                                $chk=""; 
                                                $q4="select count(*) as cnt from permission where menu_id=".$r['menu_id']." and sub_menu_id=".$r2['sub_menu_id']." and users_id=".$id;
                                                $stmt2 = $conn->prepare($q4);
                                                $resultSet3 = $stmt2->executeQuery();
                                                $r3=$resultSet3->fetchAssociative();
                                                if($r3["cnt"]==1){
                                                $chk="checked";
                                                $sttlchk=$sttlchk+1;
                                                }
                                                else{
                                                $chk="";
                                                }
                                        ?>
                                            <li style='font-size:12px;font-weight:300'><input  <?=$chk?>  class="role_<?=$r['menu_id']?>" onclick="role_apply('role_<?=$r['menu_id']?>','C','0','<?=$r2['sub_menu_id']?>');"  value="<?=$r2['menu_id']?>-<?=$r2['sub_menu_id']?>"  name='submenu[]' type="checkbox" id="chks_<?=$r2['sub_menu_id']?>" name=''/><label style='margin-left:3px;font-size:14px' for="chks_<?=$r2['sub_menu_id']?>"><?=strtolower($r2['sub_menu_name'])?></label></li>
                                        <?php
                                        	$sttl=$sttl+1;
                                        }
                                    ?>
                                </ul>
                            </li>									   
                            </ul>	
                        </div>
        
                        <?php
                            if($sttlchk==$sttl){
                                if($sttlchk!=0){
                                    array_push($chk_array,"chk_".$r['menu_id']);
                                }	
                            }
                        }
                        $strcls=implode(",",$chk_array);
                        $mch=implode(",",$m);
                        ?>
                        <input type="hidden" id='m_array' name='m_array' value="<?=$strcls?>"> 
                        <input type="hidden" id='mchk' name='mchk' value="<?=$mch?>"> 
                        
        
       </div>
    
      <div class="row">
        <div class="col-md-12">
             <hr>
        </div>
      </div>
       <div class="row">
           <div class="col-md-12" style='margin-top:10px'>
           <button  class='btn btn-info'>Update User</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>	
	$(document).ready(function(){
	getselectedmenu();
	});

	function getselectedmenu(){
	m=$("#m_array").val();
	me=m.split(',');
	for(i=0;i<me.length; i++){
		$("#"+me[i]).prop('checked',true);
	}
 }

function role_apply(cl,t,cnt,id){
	 if(t=="P"){
        chk=$("."+cl).prop("checked");
		 if(chk){
			$("."+cl).each(function( index ) {
				$(this).prop('checked',true);
			}); 
		  }
		else{
			$("."+cl).each(function( index ) {
				$("."+cl).prop('checked',false);
				
			}); 
     	}  
	 }
	 else{ 
			chk=$("#chks_"+id).prop("checked");
			if(chk){
				$("#chks_"+id).prop('checked',true);
			}
			else{
				$("#chks_"+id).prop('checked',false);
			}
			count= $('input.'+cl+':checkbox:checked').length
			sp=cl.split('_');
			if($("#chk_"+sp[1]).prop('checked')){
				count=count-1;
			}
			if(count==cnt){	
				$("#chk_"+sp[1]).prop('checked',false);
			}
			else{
				$("#chk_"+sp[1]).prop('checked',true);
			}
			
	 }
}

</script>

<?php
include "basic/admin_footer.php";
?>
