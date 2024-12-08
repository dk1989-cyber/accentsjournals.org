
<?php
        include "header.php";
        include "commonrequest.php";
        extract($_REQUEST);
        $sql = "SELECT * FROM journals where journals_id='$journalsId'";
        $stmt = $conn->query($sql);
        $i=1;
        $row=$stmt->fetchAssociative();
        extract($row);
        ?>
		   <?php
		    $id=$journalsId;
		    include "journal_header.php";
		   ?>
            <main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
               <div class="col-md-12">
							   <ul class="sj-downloadprint">
									 	   <li><a class='btn btn-sm btn-danger' href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
							  </ul>
							</div>
					      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							   	<div id="sj-content" class="sj-content">
                                   <div class="sj-issuesweeks">
                                     <div id="sj-accordion" class="sj-accordion" role="tablist" aria-multiselectable="true">
										                  <?php
                                        
                                          $q="select DISTINCT i.year,(select volume from issue WHERE year=i.year and journals_id='$journalsId' limit 1) as volume from issue i where i.journals_id='$journalsId' and i.status='previous' GROUP BY i.year DESC";
                                         
                                          $stmt= $conn->query($q);
                                          while(($row=$stmt->fetchAssociative())!==false){
                                          extract($row);
                                          if($year<=2018){
                                         ?>	
                                           <div class="sj-panel">
                                                <h4><?=$year?>  Volume <?=$volume?><i class="fa fa-angle-down"></i></h4>
                                                      <div class="sj-panelcontent">

                                                          <div class="sj-recordholder">
                                                                <?php
                                                                    $q2="select * from issue where year='$year' and journals_id='$journals_id'  ";
                                                                  
                                                                    $stmt2 = $conn->query($q2);
                                                                    while(($row2=$stmt2->fetchAssociative())!==false){
                                                                    extract($row2);
                                                                  ?>
                                                                    <a class="sj-btnrecord" href="statisticschart.php?issueId=<?=$issue_id?>&journalsId=<?=$journals_id?>&type=monthly"><span>ISSUE <?=$issue?></span><i class="fa fa-angle-right"></i></a>
                                                                  <?php
                                                                    }
                                                                ?>
                                                          </div>
                                                  </div>
                                           </div>
										                 <?php
                                      }
                                      else{
                                     ?>   
                                     
                                       <div class="sj-panel">
                                                <h4><?=$year?> <i class="fa fa-angle-down"></i></h4>
                                                      <div class="sj-panelcontent">
                                                          <div class="sj-recordholder">
                                                                <?php
                                                                    $q2="select distinct volume from issue where year='$year' and journals_id='$journals_id'   ";
                                                                    $stmt2 = $conn->query($q2);
                                                                    while(($row2=$stmt2->fetchAssociative())!==false){
                                                                    extract($row2);
                                                                    ?>
                                                                    <a class="sj-btnrecord" href="statisticschart.php?journalsId=<?=$journals_id?>&type=yearly&volume=<?=$volume?>"><span> Volume <?=$volume?></span><i class="fa fa-angle-right"></i></a>
                                                                    <?php
                                                                   }
                                                                ?>
                                                          </div>
                                                </div>
                                      </div>
                                   <?php    
                                     }
                                   }
                                 ?>
								 	       </div>
							      </div>
							</div>
						 
						</div>
					</div>
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
		 