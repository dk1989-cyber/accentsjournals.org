<?php
extract($_REQUEST);
include "basic/admin_header.php";

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
          $sql = "SELECT i.*,dep.department as depa,des.designation as design,j.journal_abbri FROM invitation i
          INNER JOIN department dep ON i.department=dep.department_id
          INNER JOIN designation des ON i.position=des.designation_id
          INNER JOIN journals j ON i.journals_id=j.journals_id
          WHERE invitation_id =$id";
          $stmt = $conn->query($sql);
          $i=1;
          $row=$stmt->fetchAssociative();
          extract($row);
         ?>
         <div class="panel-body" style='margin-top:10px'>
          <div class="row">
             <div class="col-md-3">
                 <label for="" class='q_l'>Journal</label>
                 <label for="" class='q_lv'><?=$journal_abbri?></label>
             </div> 
             <div class="col-md-3">
                 <label for="" class='q_l'>Title</label>
                 <label for="" class='q_lv'><?=$title?></label>
             </div>  
             <div class="col-md-3">
                 <label for="" class='q_l'>Name</label>
                 <label for="" class='q_lv'><?=$first_name?></label>
             </div>    
             <div class="col-md-3">
                 <label for="" class='q_l'>Position</label>
                 <label for="" class='q_lv'><?=$design?></label>
             </div>    
             <div class="col-md-3">
                 <label for="" class='q_l'>Department</label>
                 <label for="" class='q_lv'><?=$depa?></label>
             </div> 
             <div class="col-md-3">
                 <label for="" class='q_l'>University/Company</label>
                 <label for="" class='q_lv'><?=$university?></label>
             </div>  
             <div class="col-md-3">
                 <label for="" class='q_l'>Higher Education</label>
                 <label for="" class='q_lv'><?=$higher_education?></label>
             </div> 
            
             <div class="col-md-3">
                 <label for="" class='q_l'>Telephone</label>
                 <label for="" class='q_lv'><?=$telephone?></label>
             </div> 
            
             <div class="col-md-12">
                 <label for="" class='q_l'>Address</label>
                 <label for="" class='q_lv'><?=$address?></label>
             </div>     
             
             
             <div class="col-md-3">
                 <label for="" class='q_l'>Brief Bio</label>
                 <label for="" class='q_lv'><?=$b_bio?></label>
             </div> 
        
             <div class="col-md-3">
                 <label for="" class='q_l'>Scopus ID</label>
                 <label for="" class='q_lv'><?=$scopus_id?></label>
             </div> 

             <div class="col-md-12">
                 <label for="" class='q_l'>Weblink</label>
                 <label for="" class='q_lv'><?=$weblink?></label>
             </div> 

             <div class="col-md-12">
                 <label for="" class='q_l'>Google Scholar</label>
                 <label for="" class='q_lv'><?=$g_scholar?></label>
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
                 <label for="" class='q_l'>ORC ID</label>
                 <label for="" class='q_lv'><?=$email?></label>
             </div> 

             <div class="col-md-12">
                 <label for="" class='q_l'>Domain of Research</label>
                 <label for="" class='q_lv'><?=$dom_r?></label>
             </div> 
 
             <?php
             $r=base_url('upload/invitation/').$resume;
             $p=base_url('upload/invitation/').$photo;
             ?>
             <div class="col-md-6">
                 <label for="" class='q_l'>Photograph</label><br/>
                 <img style='width:250px' src="<?=$p?>" alt="">
             </div> 
             <div class="col-md-6">
                 <label for="" class='q_l'>Resume</label><br/>
                 <a href="<?=$r?>" class='btn btn-success'><i class='fa fa-download'></i> Download Resume</a>
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
