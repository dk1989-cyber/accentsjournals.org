
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
                                 extract($_REQUEST);
                              
                                 ?>
							</div>
						 	<div class="col-12 col-sm-12 col-md-8 col-lg-9">
								<div id="sj-content" class="sj-content">
									<div class="sj-articledetail">
									  	<div class="sj-articledescription sj-sectioninnerspace">
                                        <div class="row card shadow d-flex justify-content-center">
										<div class="col-md-12">
											<?php
											if($editorial_board_position=="TOP"){
											?>
											<p><?=$editorial_board_discription?></p>
											<?php
											}
											?>
										</div>
                                         <div class="col-md-12 content-e"  style='padding:20px;max-height:10 00px;overflow:scroll; overflow-x: hidden;'>
                                          	  
											   <?php
												$q="select * from editorial_board_category";
												$stm=$conn->query($q);
												while(($row2=$stm->fetchAssociative())!==false){
												$eid=$row2["editorial_board_category_id"];
												$sql = "SELECT e.*,d.designation,dep.department,c.name as cntry,st.name as stt,ct.name as ctt 
												FROM editorial_board e
												LEFT JOIN designation d ON e.designation = d.designation_id
												LEFT JOIN department dep ON e.department = dep.department_id
												LEFT JOIN country c ON e.country = c.country_id
												LEFT JOIN states st ON e.state = st.states_id
												LEFT JOIN cities ct ON e.city = ct.cities_id
												where e.journals_id='$journalsId' and e.editorial_board_category_id='$eid' order by e.ordby";
												$stmt = $conn->query($sql);
												?>
												<h4 style='font-size:20px'><?=$row2['category']?></h4>
												<?php
												while(($row=$stmt->fetchAssociative())!==false){
													extract($row); 
											    ?>
										         <article class="sj-post sj-editorchoice"  style="margin-bottom:5px;border: 1px solid #efefef;box-shadow: 0px 3px 5px #efefef;padding: 10px;">
														<figure class="sj-postimg">
															<img style='height:150px;width:150px' src="<?=base_url('upload/journal_content/editorial_board/')?><?=$photo?>" alt="image description">
														</figure>
														<div class="sj-postcontent">
															<div class="sj-head">
																<h3 style='margin-bottom:3px'><a style='font-weight:bold;font-size:18px'><?=$name?></a></h3>
																<p style='font-size:14px !important;margin-top:-4px;'><?=$designation?></p>
																<p style='font-size:14px !important;margin-top:-25px'><?=$department?></p>
																 <p style="font-size: 14px !important;line-height: 16px;margin-top:-20px"><?=strip_tags($university)?></p>
																 <div style='margin-top:-18px;margin-bottom:5px'>
																 	<span style='color:black;font-size:14px'>
																		<b>Domain Research :</b> <?=$domain_research?>
																	</span>
																	<span style='color:black;font-size:14px'><br/>
																		<b>Scoupus ID :</b>
																		<a target='_blank' href="https://www.scopus.com/authid/detail.uri?authorId=<?=$scopus_id?>"><?=$scopus_id?></a>
																	</span>
												                </div>
															     
																<?php
																// if($domain_research!=""){
																// 	$epc=explode(",",$domain_research);
																// 	$cnt=count($epc);
																// 	for($i=0;$i<$cnt;$i++){
																//     ?>
																    <label class='badge badge-info'></label>
																  	<?php
																// 	}
																//    }
																?>
																
																</div>
															
																<p style='margin-top:-20px'><?=$email?></p>
															 </div>
															 
														</div>
												  </article>
												   
												 <?php
												  }
												 ?>
												  <?php
										     }
										    ?>
										   </div>   
											 
                                         </div>
										 <div class="col-md-12">
											<?php
											if($editorial_board_position=="BOTTOM"){
											?>
											<p><?=$editorial_board_discription?></p>
											<?php
											}
											?>
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
		 