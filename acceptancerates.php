
<?php
            include "header.php";
		    extract($_REQUEST);
            include "commonrequest.php";
			$sql = "SELECT * FROM journals where journals_id='$journalsId'";
			$stmt = $conn->query($sql);
			$i=1;
			 $row=$stmt->fetchAssociative();
			extract($row);
           ?>
	 
		   <?php
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
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3">
								 <?php
                                  include "journalsidemenu.php";
                               
                                 ?>
							</div>
							<div class="col-12 col-sm-12 col-md-8 col-lg-9">
								<div id="sj-content" class="sj-content">
									<div class="sj-articledetail">
									  	<div class="sj-articledescription sj-sectioninnerspace">
                                        <div class="row card shadow d-flex justify-content-center ">
                                         <div class="col-md-12 content"  style='padding:20px;max-height:600px;'>
                                            <table class='table'>
                                                <thead>
                                                     <tr style='background-color:#5b5b5b;color:#fff'>
                                                         <th colspan='5'>Acceptance Rate</th>
                                                     </tr>
                                                    <tr  style='background-color:#5b5b5b;color:#fff'>
                                                        <th>Year</th>
                                                        <th>Recieved Paper</th>
                                                        <th>Accepted Paper</th>
                                                        <th>Ar(%)</th>
                                                        <th>Countries</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $q4="select * from paper_acceptance_rate where journals_id='$journalsId'";
                                                    $stmt2=$conn->query($q4);
                                                     while(($row2=$stmt2->fetchAssociative())!==false){
                                                         extract($row2);
                                                          
                                                         if($record_type=="NEW"){
                                                                $q3="select group_concat(distinct university_id) as uid from authornamesjp where journals_id='$journals_id' and year='$volume_year'";
                                                                
                                                                $stmt3=$conn->query($q3);
                                                                $row3=$stmt3->fetchAssociative();
                                                                if(!empty($row3)){
                                                                    extract($row3);
                                                                    if(!is_null($uid)){
                                                                        $q4="select  group_concat( DISTINCT c.name) as cntry from country c 
                                                                        LEFT JOIN ad_university u ON  u.country=c.country_id where u.ad_university_id IN ($uid)";
                                                                        
                                                                      //  echo $q4;
                                                                        
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
                                                        }
                                                        else{
                                                            $cntry=$countries_name;
                                                        }
 
                                                    ?>
                                                    <tr>
                                                        <td><?=$volume_year?></td>
                                                        <td><?=$totalpaper?></td>
                                                        <td><?=$accepted?></td>
                                                        <td><?=round(($accepted/$totalpaper)*100,2)?></td>
                                                        <td><?=$cntry?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                         </div>   
                                        </div>
                                      </div>	 
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
		 