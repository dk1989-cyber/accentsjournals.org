<?php
include "basic/admin_header.php";
?>
<div class="mainpanel">
<div class="contentpanel">
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Add User</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
    <form onsubmit="execute();" action="../action/adUser.php" method='post'>
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Add User</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
      
        <div class="row">
                <div class="form-group col-md-5">
                    <label class='lbl' for=""> Name <span class='req'>*</span></label>
                    <input required name='name' id='name' type="text" placeholder="Enter  Name" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label class='lbl' for="">Mobile No</label>
                    <input name='mobile' id='mobile' type="text" placeholder="Enter  Mobile" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Email  <span class='req'>*</span></label>
                    <input required name='email' id='email' type="text" placeholder="Enter  Email" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Password  <span class='req'>*</span></label>
                    <input required name='password' id='password' type="text" placeholder="Enter Password" class="form-control" />
                </div>
        </div>
       <div class="row">
        
          <?php
              $sql = "SELECT * FROM `menu` where status='Enable'";
              $stmt = $conn->prepare($sql);
              $resultSet = $stmt->executeQuery();
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
                                        while (($r2 = $resultSet2->fetchAssociative()) !== false) {
                                        ?>
                                            <li style='font-size:12px;font-weight:300'><input  class="role_<?=$r['menu_id']?>" onclick="role_apply('role_<?=$r['menu_id']?>','C','0','<?=$r2['sub_menu_id']?>');"  value="<?=$r2['menu_id']?>-<?=$r2['sub_menu_id']?>"  name='submenu[]' type="checkbox" id="chks_<?=$r2['sub_menu_id']?>" name=''/><label style='margin-left:3px;font-size:14px' for="chks_<?=$r2['sub_menu_id']?>"><?=strtolower($r2['sub_menu_name'])?></label></li>
                                        <?php
                                        }
                                    ?>
                                </ul>
                            </li>									   
                            </ul>	
                        </div>
        
            <?php
              }
            ?>
        
       </div>
    
      <div class="row">
        <div class="col-md-12">
             <hr>
        </div>
      </div>
       <div class="row">
           <div class="col-md-12" style='margin-top:10px'>
           <button id='btnu' class='btn btn-info'>Add User</button>
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

<?php
include "basic/admin_footer.php";
?>


<script>
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

			count= $('input.'+cl+':checkbox:checked').length;
      console.log(count);
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

function execute(){
    $('#btnu').attr("disabled","disabled");
 }


</script>
