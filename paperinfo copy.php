  
            <?php
			extract($_REQUEST);
            include "header.php";
			include 'service/JournalsService.php';

			if(($_SERVER['QUERY_STRING']!="")){
				$jid_arr=explode("=", $_SERVER['QUERY_STRING']);
				 
				$jpid=$jid_arr[1];
			}
			else{
			   header("Location: ".base_url(''));
			}
		   

			$journalsService = new JournalsService($conn);
			$authors = $journalsService->getAuthorNamesById($jpid);
			$l=get_author($authors);
			$l2=get_author($authors,"citation");	

			$c_authors = $journalsService->getAuthorNamesById($jpid,1);

			$sql4 = "SELECT j.*,i.issue,i.volume,i.month,i.year,jr.journals_id 
			FROM journalpaper j
			LEFT JOIN issue i ON i.issue_id=j.issue_id
			LEFT JOIN journals jr ON i.journals_id=jr.journals_id
			where j.journalpaper_id='$jpid'";

			$stmt4 = $conn->query($sql4);
			$row4=$stmt4->fetchAssociative();
			extract($row4);
			$journalsId=$row4['journals_id'];
			include "journal_header.php";
			?>
		    <?php
			if($record_type=="NEW"){
			?>
			<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
						 <div class="col-12 col-sm-12 col-md-12 col-lg-12">
								<div id="sj-content" class="sj-content">
									<div class="sj-articledetail">
										<ul class="sj-downloadprint">
										 	<li><a   class='btn btn-sm btn-light'  onclick="update_counter(<?=$jpid?>,'download')"  ><i style='color:red' class="fa fa-file-pdf-o"></i><span style='color:black'>Download PDF</span></a></li>
											<li><a class='btn btn-sm btn-danger' href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
										</ul>
										 
										<div class="sj-articledescription sj-sectioninnerspace">
										    <div class="row">
												<div class="col-md-9">
													        <?php
															if($modifi_alert_message!=""){
														     if($modification_stage=="BEFORE"){	
															?>
												            <div class="alert alert-danger" role="alert">
															    <i style='margin-right:10px;background-color:white;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;border-radius:50px' class='fa fa-info'></i><?=$modifi_alert_message?>
															</div> 
															<?php
															  }else{
															  ?>
															  <div class="alert alert-success" role="alert">
															    <i style='margin-right:10px;background-color:white;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;border-radius:50px' class='fa fa-info'></i><?=$modifi_alert_message?>
															  </div> 
															   <?php
															  }
															}
															?>
														<h5><label style='margin-bottom:-4px;color:#0066a1;display:block'><b style='display:block'>Paper Title</b></label ><b style='color:black'><?=$title?></b></h5>
														   <?php
														  if($modification_type!="Retraction" && $modification_stage!="AFTER"){

														   if($universitylists!=""){
															$q="select a.*,d.department,des.designation from authornamesjp a
															LEFT JOIN department d ON d.department_id=a.department_id
															LEFT JOIN designation des ON des.designation_id=a.designation_id
															where a.journalpaper_id='$journalpaper_id'";
															$stmt = $conn->query($q);
															$i=1;
															$author="";
															$dep=array();
															$desig=array();
															$unilist=explode(",",$universitylists);
															while(($row=$stmt->fetchAssociative())!==false){
															  extract($row);
															  $pos=array_search($university_id,$unilist);
															  $p=$pos+1;

															 array_push($dep,$department);
															 array_push($desig,$designation);

															  if($i==$no_authors){
																if($i==1){
																  $author.=$row['firstname']." ".$row['middlename']." ".$row['lastname']."<sup><b>$p</b></sup>";
																}else{
																	$author.=" and ".$row['firstname']." ".$row['middlename']." ".$row['lastname']."<sup><b>$p</b></sup>";
																}
															  }
															  else{
															       if($no_authors==2){
															  	     $author.=$row['firstname']." ".$row['middlename']." ".$row['lastname']."<sup><b>$p</b></sup> ";
															       }
															       else{
															          $author.=$row['firstname']." ".$row['middlename']." ".$row['lastname']."<sup><b>$p</b></sup>,";
															       }
															  }
                                                              $i++;
															 }
															}
                                                        else{
																$author=$authors;
															}
														   ?>
														      <?php
														   $u="";
														   if($universitylists!=""){

																	$q2="select u.*,st.name as st,c.name as cntry from ad_university u 
																	LEFT JOIN  states st ON u.ustate=st.states_id
																	LEFT JOIN  country c ON u.country=c.country_id
																	where ad_university_id IN ($universitylists)";
																	$stmt2 = $conn->query($q2);
																   $j=1;
                                                                   $i=0;
																	while(($row1=$stmt2->fetchAssociative())!==false){
																		extract($row1);
																		$u.=" <span style='color:black'><span>".$dep[$i]."</span>,<span style='margin-left:5px'>".$desig[$i]."</span>,<span style='margin-left:5px'>".$university."</span>,<span style='margin-left:5px'>$st</span>,<span style='margin-left:5px'>$cntry</span></span><sup style='color:black'>$j</sup><br/>";
																		$j=$j+1;
														  			}
														    }
														   }
														   ?>
														   
													       <h5><label style='margin-bottom:-4px;color:#0066a1'><b>Author Name</b></label><p><?=$author?><br/>
														   </h5>
														   <div class="sj-description" style='margin-top:-15px;margin-bottom:10px'>
														       <div class="row">
															       <div class="col-12 col-sm-12 col-md-12 col-lg-12">
															       	<?=$u?>
														          </div>	
														      </div>
														   </div>	
													      
												       <h5 style='color:black' > <b>Corresponding Author :</b>
													   <a  href="mailto:<?=$c_authors[0]['email']?>" style='color:black'><i class='fa fa-envelope'></i><?=$c_authors[0]['firstname']?> <?=$c_authors[0]['middlename']?>  <?=$c_authors[0]['lastname']?></a></p>
													   </h5>
													   <div class="sj-description" style='margin-top:10px;'>
														<div class="row" >
															<div class="col-12 col-sm-12 col-md-4 col-lg-3">
																<h5 style='margin-bottom:-5px;color:#0066a1'><b>Recieved Date</b></h5>
																<p><?=date('d-M-Y',strtotime($recieved_date))?></p>
															</div>
															<div class="col-12 col-sm-12 col-md-4 col-lg-3">
																<h5 style='margin-bottom:-5px;color:#0066a1'><b>Revised Date</b></h5>
																<p><?=date('d-M-Y',strtotime($revised_date))?></p>
															</div>
															<div class="col-12 col-sm-12 col-md-4 col-lg-3">
																<h5 style='margin-bottom:-5px;color:#0066a1'><b>Accepted Date</b></h5>
																<p><?=date('d-M-Y',strtotime($accepted_date))?></p>
															</div>
														</div>
                                                     </div>
												</div>
												<div class="col-md-3">
												  <aside id="sj-sidebar" class="sj-sidebar">
														 
														<div class="sj-widget sj-widgetimpactfector">
															<div class="sj-widgetcontent">
																<ul>
																	 <li class='side_data' >
																		 <span  class='blck'  >
																		      <div class='blckleft'> 
																				<i class='fa fa-eye'></i> 
														                      </div>
																			 <div class='blckright' >
																			  <span class='lblv' style='margin:5px' id='view_count'><?=$views_count?></span>
																			  <span>View</span>
																		    </div>
																	</li>

																	<li class='side_data' >
																		 <span  class='blck'  >
																		      <div class='blckleft'> 
																				<i class='fa fa-download'></i> 
														                      </div>
																			 <div class='blckright' >
																			  <span  class='lblv' style='margin:5px' id='download_count'><?=$download_count?></span>
																			  <span>Download</span>
																		    </div>
																	</li>
																	<li class="side_data">
																		 <span class="blck">
																		      <div class="blckleft" style="flex:1;background-color: #efefef;border-right: 1px solid lightgray;"> 
																			 
																				<span style="font-size:12px;">Dimension</span>
														                      </div>
																			 <div class="blckright" style="flex:1;background: #efefef;">
																				  
																				<span>G. Scholar</span>
																			</div>
																        </span>
													   			</li>
													
							                                    </ul>
															</div>
														</div>
												 	</aside>
												</div>
												<div class="col-md-12">
												    <div class="sj-description" style='margin-top:10px;'>
												    <h5 style='margin-bottom:-5px;color:#0066a1'><b>Abstract</b></h5>
													  <?=$abstract?>
													</div>
 
													<?php
													if($modification_type!=""){
													?>
														<div class="sj-description" style='margin-top:10px;background-color:#efefef;padding:10px'>
														<h5 style='margin-bottom:-5px;color:#0066a1'><b>Addition information about the article</b></h5>
														   <?php
														    $dynamic_variable=["#linkurl#","#linkpdf#"];
															$l_u="<a style='color:black;font-weight:bold' target='_blank' href='$link_url'>Article Link</a>";
															$l_p="<a style='color:black;font-weight:bold' target='_blank' href='$link_pdf'>Article Pdf</a>";
															$dynamic_data=[$l_u,$l_p];
														    $dyn=str_replace($dynamic_variable,$dynamic_data,$modification_message);
														   ?>
														   <?=$dyn?>
														</div>
													<?php
													}
													?>

<?php
													if($modification_type!="Retraction" && $modification_stage!="AFTER"){
													?>
													<div class="sj-description" style='margin-top:10px;'>
														<h5 style='margin-bottom:-5px;color:#0066a1'><b>Keyword</b></h5>
														<p><?=$keyword?></p>
													</div>
													<?php
													}
													?>

													<div class="sj-description" style='margin-top:10px;'>
														<h5 style='margin-bottom:-5px;color:#0066a1'><b>Cite this article</b></h5>
														<!-- <p><?=$citation?></p> -->
														<a class="btn btn-sm btn-success" style='color:white;cursor:pointer;margin-top:10px' onclick="cite(<?=$journalpaper_id?>,'paper');"  >Cite this Article</a>
													</div>
													<div class="sj-description" style='margin-top:10px;'>
														<h5 style='margin-bottom:-5px;color:#0066a1'><b>Refference</b></h5>
														<?php
														$q5="select * from refrence  where journalpaper_id='$journalPaperId'";
													
														$stmt4=$conn->query($q5);
														$i=1;
														while(($row5=$stmt4->fetchAssociative())!==false){
															extract($row5);
														?>
														<p  style='color:black'>[<?=$i?>]<?=$name?></p>
														<div style='margin-top:-20px;margin-bottom:10px'>
																<a target='_blank' href="<?=$crossref?>">[Crossref]</a>
																<a target='_blank' href="<?=$googlescholar?>">[Google Scholar]</a>
														</div>
														<?php
														$i=$i+1;
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
							 
						</div>
					</div>
				</div>
			</main>
			<?php
			}else{
			?>
			<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12">
								<div id="sj-content" class="sj-content">
									<div class="sj-articledetail">
										<ul class="sj-downloadprint">
										  <li><a class='btn btn-sm btn-light' onclick="update_counter(<?=$journalpaper_id?>,'download')" ><i style='color:red' class="fa fa-file-pdf-o"></i><span style='color:black'>Download PDF</span></a></li>
											<li><a class='btn btn-sm btn-danger' href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
										</ul>
										 <div class="sj-articledescription sj-sectioninnerspace">
											<h5><label style='margin-bottom:-4px;color:#0066a1;display:block'><b style='display:block'>Paper Title</b></label ><b style='color:black'><?=$title?></b></h5>
											<h5><label style='margin-bottom:-4px;color:#0066a1'><b>Author Name</b></label><p><?=$authors?></p></h5>
                                         	<div class="sj-description" style='margin-top:10px;'>
                                                <h5 style='margin-bottom:-5px;color:#0066a1'><b>Abstract</b></h5>
                                               <p><?=$abstract?></p>
											</div>
                                            <div class="sj-description" style='margin-top:10px;'>
                                                <h5 style='margin-bottom:-5px;color:#0066a1'><b>Keyword</b></h5>
                                                <p><?=$keyword?></p>
											</div>

											<div class="sj-description" style='margin-top:10px;'>
                                                <h5 style='margin-bottom:-5px;color:#0066a1'><b>Cite this article</b></h5>
                                                <p><?=$l2?></p>
											</div>
                                            <div class="sj-description" style='margin-top:10px;'>
                                                <h5 style='margin-bottom:-5px;color:#0066a1'><b>Refference</b></h5>
												<?php
												 $q5="select * from refrence    where journalpaper_id='$jpid'";
											     $stmt4=$conn->query($q5);
											     $i=1;
												 while(($row5=$stmt4->fetchAssociative())!==false){
													extract($row5);
												   ?>
												   <p style='color:black'>[<?=$i?>]<?=$name?></p>
												   <div style='margin-top:-20px;margin-bottom:10px'>
														<a  target='_blank' href="<?=$crossref?>">[Crossref]</a>
														<a target='_blank'  href="<?=$googlescholar?>">[Google Scholar]</a>
												   </div>
												<?php
												$i=$i+1;
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
			<?php
			}
			?>
	      	<!-- Modal -->
			
			 <?php
             include "footer.php";
             ?>

			 <script>
			    $(document).ready(function(){
					setTimeout(() => {
						update_counter(<?=$journalpaper_id?>,"view");
					}, 1000);
				});
			 </script>