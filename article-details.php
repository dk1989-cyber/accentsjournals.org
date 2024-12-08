  
            <?php
			extract($_REQUEST);
            include "header.php";
			include 'service/JournalsService.php';
		    $jpid=$journalPaperId;

			$journalsService = new JournalsService($conn);
			$authors = $journalsService->getAuthorNamesById($jpid);
			$l=get_author($authors);
			$l2=get_author($authors,"citation");	

			$c_authors = $journalsService->getAuthorNamesById($jpid,1);
 
			$sql4 = "SELECT j.*,i.issue,i.volume,i.month,i.year,jr.journals_id 
			FROM journalpaper j
			LEFT JOIN issue i ON i.issue_id=j.issue_id
			LEFT JOIN journals jr ON i.journals_id=jr.journals_id
			where j.journalpaper_id='$journalPaperId'";

			$stmt4 = $conn->query($sql4);
			$row4=$stmt4->fetchAssociative();
			extract($row4);
			$id=$row4['journals_id'];
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
										 	<li><a onclick="download_pdf()" class='btn btn-sm btn-light'   ><i style='color:red' class="fa fa-file-pdf-o"></i><span style='color:black'>Download PDF</span></a></li>
											<li><a class='btn btn-sm btn-danger' href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
										</ul>
										 
										<div class="sj-articledescription sj-sectioninnerspace">
										    <div class="row">
												<div class="col-md-9">
														<h5><label style='margin-bottom:-4px;color:#0066a1'><b>Paper Title</b></label ><b style='color:black'><?=$title?></b></h5>
													    <h5><label style='margin-bottom:-4px;color:#0066a1'><b>Author Name</b></label><p><?=$authors?><br/><b>Corresponding Author :</b><a href="mailto:<?=$c_authors[0]['email']?>"><i class='fa fa-envelope'></i><?=$c_authors[0]['firstname']?> <?=$c_authors[0]['middlename']?>  <?=$c_authors[0]['lastname']?></a></p></h5>
													<div class="sj-description" style='margin-top:10px;'>
														<div class="row">
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
																	 <li class='side_data' ><span  class='blck' ><span></span><b style='font-size:20px'>2000</b><br/> <i class='fa fa-eye'></i> Views</span></li>
																	 <li class='side_data' >  <span  class='blck' ><b style='font-size:20px'>2000</b><br/> <span><i class='fas fa-arrow-down'></i></span> Downloads</span></span></li>
																	 

																	 
																	 <li class='side_data'><span  class='blck'  ><b style='font-size:20px'></b><br/> Dimension</span></span></li>
																	 <li class='side_data'><span class='blck'   ><span><i class="fa fa-school"></i></span>Google Scholar</span></li>
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
													<div class="sj-description" style='margin-top:10px;'>
														<h5 style='margin-bottom:-5px;color:#0066a1'><b>Keyword</b></h5>
														<p><?=$keyword?></p>
													</div>

													<div class="sj-description" style='margin-top:10px;'>
														<h5 style='margin-bottom:-5px;color:#0066a1'><b>Cite this article</b></h5>
														<p><?=$citation?></p>
													</div>
													<div class="sj-description" style='margin-top:10px;'>
														<h5 style='margin-bottom:-5px;color:#0066a1'><b>Refference</b></h5>
														<?php
														$q5="select * from refrence    where journalpaper_id='$journalPaperId'";
													
														$stmt4=$conn->query($q5);
														while(($row5=$stmt4->fetchAssociative())!==false){
															extract($row5);
														?>
														<p style='color:black'><?=$name?></p>
														<div style='margin-top:-20px;margin-bottom:10px'>
																<a href="<?=$crossref?>">[Crossref]</a>
																<a href="<?=$googlescholar?>">[Google Scholar]</a>
														</div>
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
										 
											<li><a class='btn btn-sm btn-light' href="javascript:void(0);" ><i style='color:red' class="fa fa-file-pdf-o"></i><span style='color:black'>Download PDF</span></a></li>
											<li><a class='btn btn-sm btn-danger' href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
										</ul>
										 
										<div class="sj-articledescription sj-sectioninnerspace">
										 
											<h5><label style='margin-bottom:-4px;color:#0066a1'><b>Paper Title</b></label ><b style='color:black'><?=$title?></b></h5>
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
												 $q5="select * from refrence    where journalpaper_id='$journalPaperId'";
											 
												 $stmt4=$conn->query($q5);
												while(($row5=$stmt4->fetchAssociative())!==false){
													extract($row5);
												?>
												   <p style='color:black'><?=$name?></p>
												   <div style='margin-top:-20px;margin-bottom:10px'>
														<a href="<?=$crossref?>">[Crossref]</a>
														<a href="<?=$googlescholar?>">[Google Scholar]</a>
												   </div>
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
			<?php
			}
			?>
	      	<!-- Modal -->
			
			 <?php
             include "footer.php";
             ?>

			 <script>
				function download_pdf(){
				   
				}
 	
			 </script>