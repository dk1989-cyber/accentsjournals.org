<?php
include "basic/admin_header.php";
extract($_REQUEST);
?>
<div class="mainpanel">
<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Feedback Query Detail </h4>
        </div>
         <?php
          $sql = "SELECT * FROM feedback where feedback_id=$feedback_id";
          $stmt = $conn->query($sql);
          $i=1;
          $row=$stmt->fetchAssociative();
           extract($row);
         ?>
         <div class="panel-body" style='margin-top:10px'>
          <div class="row">
             <div class="col-md-3">
                 <label for="" class='q_l'>Name</label>
                 <label for="" class='q_lv'><?=$name?></label>
             </div>    
             <div class="col-md-3">
                 <label for="" class='q_l'>Mobile</label>
                 <label for="" class='q_lv'><?=$mobile?></label>
             </div>    
             <div class="col-md-3">
                 <label for="" class='q_l'>Email</label>
                 <label for="" class='q_lv'><?=$email?></label>
             </div> 
             <div class="col-md-3">
                 <label for="" class='q_l'>Country</label>
                 <label for="" class='q_lv'><?=$country?></label>
             </div>  
             <div class="col-md-3">
                 <label for="" class='q_l'>City</label>
                 <label for="" class='q_lv'><?=$country?></label>
             </div>  
             <div class="col-md-12">
                 <label for="" class='q_l'>Address</label>
                 <label for="" class='q_lv'><?=$address?></label>
             </div>     
             <div class="col-md-12">
                 <label for="" class='q_l'>Comment</label>
                 <label for="" class='q_lv'><?=$comment?></label>
             </div>    

          </div> 
         </div><!-- panel -->
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?> 
