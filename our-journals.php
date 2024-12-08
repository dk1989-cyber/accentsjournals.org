<?php
include "header.php";
?>
			
			 
			<!--************************************
					Inner Banner End
			*************************************-->
			<!--************************************
					Main Start
			*************************************-->
 


			<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div class="container">
                    <?php
                    
                     $sql = "SELECT * FROM journals";
                     $stmt = $conn->query($sql);
                     $i=1;
                    while(($row=$stmt->fetchAssociative())!==false){
                        extract($row);
                    
                    ?>
                        
					 <div class="row journal_row" style='margin-bottom:50px'>
                         <div class="col-md-3">
                            <img style='width:100%' src="<?=base_url('upload/')?><?=$cover_image?>" alt="">
                         </div>
                         <div class="col-md-9">
                              <h3><a style='color:black' href="<?=base_url('journals.php?journalsId=')?><?=$journals_id?>"><b><?=$name?></b></a></h3>
                              <p style='margin-top:-18px'><?php if($issnprint!=""){?><b>ISSN (P)</b>: 2394-5443 <?php }if($issnonline!=""){?><b>ISSN (O)</b>: 2394-7454<?php }?></p>
                               <h4 style='color:black;margin-top:-18px'>Manuscripts Turnaround Time:</h4>
                                <label class="lblj"><b>Editorial Review Time</b>: <?=$editorial_review_duration?></label>
                                <label class="lblj"><b>Time to First Decision (Peer-Review Decision)</b>: <?=$first_review_duration?></label>
                                <label class="lblj"><b>Overall Estimated Time from Submission to Decision</b>: <?=$over_s_to_d?></label>
                                <label class="lblj"><b>Publication</b>: within  <?=$publication_duration?> after being accepted</label>
                                <label class="lblj"><b>Starting year of the Journal</b>: <?=$starting_year?></label>
                                <label class="lblj"><b>Frequency</b>: <?=$frequency?> issues per year</label>
                                <label class="lblj"><b>Acceptance Rate</b>: Paper acceptance rate is <?=$acceptance_rate?></label>
                                <label class="lblj"><b>DOI</b>: <?=$doi?></label>
                                <?php
                                if(trim($citation_v)!=""){
                                ?>
                                 <label class="lblj"><b>CiteScore</b>: <a href="<?=$citation_link?>"><?=$citation_v?></a></label>
                                <?php
                                 }
                                 if(trim($impact_factor_v)!=""){
                                   ?>
                                   <label class="lblj"><b>Impact Factor</b>: <a href="<?=$impact_factor_link?>"><?=$impact_factor_v?></a></label>
                                   <?php
                                 }
                                ?>
                          </div>
                     </div>
                     <?php
                    }
                     ?>
				</div>
			</main>
			<!--************************************
					Main End
			*************************************-->
			<!--************************************
					Footer Start
			*************************************-->
		 <?php
         include "footer.php";
         ?>