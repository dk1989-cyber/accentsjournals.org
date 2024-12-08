<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> View User</a></li>
   
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>View User</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th style='width:5%'>Srno</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th style='width:10%'> Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM users where status='Enable' and type='GENERAL'";
                $stmt = $conn->query($sql);
                $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                   extract($row);
                ?>
                 <tr>
                   <td><?=$i?></td>
                   <td><?=$name?></td>
                   <td><?=$mobile?></td>
                   <td><?=$email?></td>
                   <td><?=$password?></td>
                   <td>
                     <a class='btn btn-info btn-sm' href="edit_user.php?id=<?=$users_id?>"><i class='fa fa-edit'></i></a>
                     <a class='btn btn-danger btn-sm' onclick="del_user()"><i class='fa fa-trash'></i></a>
                   </td>
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

<?php
include "basic/admin_footer.php";
?>
<script>
$(document).ready(function() {
  'use strict';
  $('#dataTable1').DataTable();
});

function del_user() {
  if(confirm('Are you sure you want to delete')) {
   window.location.replace('../action/deleteUser.php?id=<?=$users_id?>');
  }
}
</script>