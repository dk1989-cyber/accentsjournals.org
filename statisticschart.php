
<?php
        include "header.php";
     //   include "commonrequest.php";
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
           
            if($type=="monthly"){
            $q3="select * from statistics where issueId='$issueId'";
            $stmt2 = $conn->query($q3);
            $row2=$stmt2->fetchAssociative();
            
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
                         <?php
                           if(!empty($row2)){
                            extract($row2);
                         ?>
					      <table class='table'>
                            <tr>
                                <th style='width:25%'>Total Paper</th>
                                <th style='text-align:left'><?=$totalPaper?></th>
                            </tr>
                            <tr>
                                <th style='25%'>Accepted Paper</th>
                                <th  style='text-align:left'><?=$accepted?></th>
                            </tr>
                            <tr>
                                <th>Rejected Paper</th>
                                <th  style='text-align:left'><?=$rejected?></th>
                            </tr>
                            <tr>
                                <th style=''>Acceptance Percentage</th>
                                <th  style='text-align:left'><?=round(($accepted/$totalPaper)*100,2)?>%</th>
                            </tr>
                            <tr>
                                <th>Geographical Coverage</th>
                                <th  style='text-align:left'><?=$coverage?></th>
                            </tr>
                          </table>
                          <?php
                           }
                          ?>
					</div>
				</div>
			</main>
            <?php
            }else{
                $q="SELECT * FROM `paper_acceptance_rate` where journals_id='$journalsId' and volume='$volume'";
                $stmt1 = $conn->query($q);
                $row1=$stmt1->fetchAssociative();
            
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
                          <?php
                          if(!empty($row1)){
                            extract($row1);
                          
                            if($row1["record_type"] =="NEW"){

                                $journals_id=$row1["journals_id"];
                                $volume_year=$row1["volume_year"];
                                $q3="select group_concat(distinct university_id) as uid from authornamesjp where journals_id='$journals_id' and year='$volume_year'";
                                $stmt3=$conn->query($q3);
                                $row3=$stmt3->fetchAssociative();
                                if(!empty($row3)){
                                    extract($row3);
                                    if(!is_null($uid)){
                                        $q4="select group_concat(c.name) as cntry from country c 
                                        LEFT JOIN ad_university u ON  u.country=c.country_id where u.ad_university_id IN ($uid)";
                                        $stmt4=$conn->query($q4);
                                        $row4=$stmt4->fetchAssociative();
                                        extract($row4);
                                    }
                                    else{
                                        $cntry="Not Available";
                                    }
                                }
                                else{
                                    $cntry="Not Available";
                                }


                           ?>  
                          <table>
                            <tr>
                                <th>Total Paper</th>
                                <th style='text-align:left'><?=$totalpaper?></th>
                            </tr>
                            <tr>
                                <th style='25%'>Accepted Paper</th>
                                <th  style='text-align:left'><?=$accepted?></th>
                            </tr>
                            <tr>
                                <th>Rejected Paper</th>
                                <th  style='text-align:left'><?=$rejected?></th>
                            </tr>
                             <tr>
                                <th style=''>Acceptance Percentage</th>
                                <th  style='text-align:left'><?=round(($accepted/$totalpaper)*100,2)?>%</th>
                            </tr>
                            <tr>
                                <th>Geographical Coverage</th>
                                <th  style='text-align:left'><?=isset($cntry)?$cntry:""?></th>
                            </tr>
                          </table>
					      <?php
                          }
                          else{
                          ?>
                          <table>
                            <tr>
                                <th>Total Paper</th>
                                <th style='text-align:left'><?=$totalpaper?></th>
                            </tr>
                            <tr>
                                <th style='25%'>Accepted Paper</th>
                                <th  style='text-align:left'><?=$accepted?></th>
                            </tr>
                            <tr>
                                <th>Rejected Paper</th>
                                <th  style='text-align:left'><?=$rejected?></th>
                            </tr>
                            <tr>
                                <th style=''>Acceptance Percentage</th>
                                <th  style='text-align:left'><?=round(($accepted/$totalpaper)*100,2)?>%</th>
                            </tr>
                            <tr>
                                <th>Geographical Coverage</th>
                                <th  style='text-align:left'><?=$countries_name?></th>
                            </tr>
                          </table>
                   
                          <?php  
                          }
                          
                          }
                          else{
                          ?>
                          <div class="col-md-12">
                              <p>No Record Found</p>
                          </div>
                          <?php
                          }
                          ?>
					</div>
				</div>
			</main>
            <?php
            }
            ?>
            <?php
            include "footer.php";
            ?>

</script>
		 