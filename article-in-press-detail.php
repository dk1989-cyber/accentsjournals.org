  
            <?php
			extract($_REQUEST);
            include "header.php";
			include 'service/JournalsService.php';

			$journalsService = new JournalsService($conn);
			$c_authors = $journalsService->getAuthorNamesById($press_id,1,"press");

			$sql4 = "SELECT p.*,jr.journals_id 
			FROM press_paper p
			LEFT JOIN journals jr ON p.journals_id=jr.journals_id
			where p.press_paper_id='$press_id'";

			$stmt4 = $conn->query($sql4);
			$row4=$stmt4->fetchAssociative();
			extract($row4);
			$journalsId=$row4['journals_id'];
			include "journal_header.php";
			?>
		    
			<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12">
								<div id="sj-content" class="sj-content">
									<div class="sj-articledetail">
										<ul class="sj-downloadprint">
										 	<li><a href="<?=base_url('PaperDirectory/Journal/')?><?=$journal_abbri?>/press/<?=$fullpaper?>" target='blank' class='btn btn-sm btn-light'   ><i style='color:red' class="fa fa-file-pdf-o"></i><span style='color:black'>Download PDF</span></a></li>
											<li><a class='btn btn-sm btn-danger' href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
										</ul>
										 
										<div class="sj-articledescription sj-sectioninnerspace">
										    <div class="row">
												<div class="col-md-12">
														<h5><label style='margin-bottom:-4px;color:#0066a1;display:block'><b>Paper Title</b></label ><b style='color:black'><?=$title?></b></h5>
													    
														<?php
														$data=json_decode($json_data);
														$cnt= count($data);
														$combination_data=array();
														   for($i=0;$i<$cnt;$i++){
															   $combination=$data[$i]->university_id."-".$data[$i]->designation_id."-".$data[$i]->department_id."-".$data[$i]->affilation;
															   array_push($combination_data,$combination);
														   }
														   $q="select a.* from authornamespp a where a.press_paper_id='$press_id'";
														   $stmt = $conn->query($q);
														   $k=1;	
														   $author="";			
														   while(($row=$stmt->fetchAssociative())!==false){
															   $combination_key=$row["university_id"]."-".$row["designation_id"]."-".$row["department_id"]."-".$row["affilation"];
															   $p=array_search($combination_key,$combination_data)+1;
															   if($k==$no_authors){
																   if($k==1){
																   $author.=ucfirst($row['firstname'])." ".ucfirst($row['middlename'])." ".ucfirst($row['lastname'])."<sup><b>$p</b></sup>";
																   }else{
																	   $author.=" and ".ucfirst($row['firstname'])." ".ucfirst($row['middlename'])." ".ucfirst($row['lastname'])."<sup><b>$p</b></sup>";
																   }
															 }
															 else{
														  
																   if($no_authors==2){
																	   $author.=ucfirst($row['firstname'])." ".ucfirst($row['middlename'])." ".ucfirst($row['lastname'])."<sup><b>$p</b></sup> ";
																   }
																   else{
																	   $author.=ucfirst($row['firstname'])." ".ucfirst($row['middlename'])." ".ucfirst($row['lastname'])."<sup><b>$p</b></sup>,";
																   }
															 }

															$k=$k+1;
														   }
														   $u=""; 
														   $j=1;
														   for($i=0;$i<$cnt;$i++){
															   $department=$data[$i]->department_name;
															   $designation=$data[$i]->designation_name;
															   $affilation=$data[$i]->affilation;
															   $university=$data[$i]->university_name;
															   $country=$data[$i]->country;
															   $state=$data[$i]->state;
															   $u.="<span style='color:black;line-height:13px'><span>$department</span>,<span style='margin-left:5px'>$designation</span>, <span style='margin-left:5px'>$affilation</span>, <span style='margin-left:5px'>$university</span>,<span style='margin-left:5px'>$state</span>,<span style='margin-left:5px'>$country</span></span><sup style='color:black;font-weight:bold'><b>$j</b></sup><br/>";
															   $j=$j+1;
													      }

														?>

                                                     <label style='margin-bottom:-4px;color:#0066a1'><b>Author Name</b></label><p><?=$author?><br/>
														
														<div class="sj-description" style='margin-top:-18px;line-height:13px;margin-bottom:10px'>
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
												<!-- <div class="col-md-3">
												  <aside id="sj-sidebar" class="sj-sidebar"  style='display:none'>
														 	<div class="sj-widget sj-widgetimpactfector">
															<div class="sj-widgetcontent">
																<ul>
																	 <li class='side_data' ><span  class='blck' ><span></span><b style='font-size:20px'></b><br/> <i class='fa fa-eye'></i> Views</span></li>
																	 <li class='side_data' >  <span  class='blck' ><b style='font-size:20px'></b><br/> <span><i class='fas fa-arrow-down'></i></span> Downloads</span></span></li> 
																	 <li class='side_data'><span  class='blck'  ><b style='font-size:20px'></b><br/> Dimension</span></span></li>
																	 <li class='side_data'><span class='blck'   ><span><i class="fa fa-school"></i></span>Google Scholar</span></li>
																  </ul>
															</div>
														</div>
												 	</aside>
												</div> -->
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
														$q5="select * from refrencep    where press_paper_id='$press_id'";
													
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
             include "footer.php";
             ?>
              <script>
				// function download_pdf(){


 
				// }
           </script>