
           <?php
           include "header.php";
		    extract($_REQUEST);

			$jid_arr=explode("&", $_SERVER['QUERY_STRING']);

			$issueId=explode("=", $jid_arr[0])[1];
			$journals_id=explode("=", $jid_arr[1])[1];
 	
			$sql2 = "SELECT i.*,i.issue_cover_image as c_img,j.* FROM issue i LEFT JOIN  journals j ON i.journals_id=j.journals_id where i.issue_id='$issueId'";
			$stmt2 = $conn->query($sql2);
			$i=1;
		    $row=$stmt2->fetchAssociative();
		    extract($row);

            $sql3 = "SELECT jp.*,ar.article_type FROM journalpaper jp LEFT JOIN article_type ar ON ar.article_type_id=jp.article_type_id where jp.issue_id='$issueId'";
			$stmt3 = $conn->query($sql3);
			$i=1;

            $m=$month+1;
            $dir="PaperDirectory/Journal/$journal_abbri/$year/$m/";
            $root=base_url($dir);

			$id=$journals_id;
			include "journal_header.php";
			if($record_type=="NEW"){
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
					        <div class="col-md-8">
                             <p></p>
						   </div>
						   <div class="col-md-4" style='text-align:center'>
							 <img src="<?=$root."/".$c_img?>" alt=""><br/>
							   <a  href=""><?=$content?></a>
						   </div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div id="sj-content" class="sj-content">
									
									<div class="sj-articles">
										<?php
                                        while(($row3=$stmt3->fetchAssociative())!==false){
                                         extract($row3);
                                         
                                         $paperimage=$root.$paperimage;
                                        ?> 
										<article class="sj-post sj-editorchoice">
											<a target='_blank' href="<?=$paperimage?>">
											<figure class="sj-postimg">
												<img style='width:200px;height:200px' src="<?=$paperimage?>" alt="image description">
											</figure>
										    </a>
											<div class="sj-postcontent">
												<div class="sj-head">
													<?php
													if($modification_type!=""){
													  if($modification_type=="Retraction"){
														$m="<b style='color:red'>[Retracted]</b>";
													  }
													  else{
														$m="";													  }
													}
													else{
														$m="";
													}
													?>
													<span class="sj-username"><a style='font-weight:bold;color:#017398'><?=$article_type?> Article  <i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i> <?=$m?></a>
                                                   </span>
													<h3><a style='font-family:times new roman; color:black;font-weight:bold'  href="paperinfo.php?journalPaperId=<?=$journalpaper_id?>"><?=$title?></a></h3>

												</div>
												<div class="sj-description">
                                                     <p>Authors :<?=$authors?></p>													  
                                                     <p><b>DOI : <a target='_blank' href="<?=$doilink?>"><?=$doilink?></a></b></p>
												</div>
												<a class="sj-btn" href="paperinfo.php?journalPaperId=<?=$journalpaper_id?>">View Full Article</a>
											</div>
										</article>
                                        <?php
                                        }
                                        ?>
                                	</div>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3">
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
							<div class="col-md-12">
							   <ul class="sj-downloadprint">
									 	   <li><a class='btn btn-sm btn-danger' href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
							  </ul>
							</div>
					        <div class="col-md-8">
                             <p></p>
						   </div>
						   <div class="col-md-4" style='text-align:center'>
							 <img src="<?=base_url($c_img)?>" alt=""><br/>
						   </div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div id="sj-content" class="sj-content">
									
									<div class="sj-articles">
										<?php
                                        while(($row3=$stmt3->fetchAssociative())!==false){
                                         extract($row3);
                                        ?> 
										<article class="sj-post sj-editorchoice">
											<figure class="sj-postimg">
												<img style='width:200px;height:200px' src="<?=base_url($paperimage)?>" alt="image description">
											</figure>
											<div class="sj-postcontent">
												<div class="sj-head">
													<span class="sj-username"><a style='font-weight:bold;color:#017398'><?=$article_type?> Article <i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i></a>
                                                   </span>
													<h3><a style='font-family:times new roman; color:black;font-weight:bold' href="paperinfo.php?journalPaperId=<?=$journalpaper_id?>"><?=$title?></a></h3>

												</div>
												<div class="sj-description">
                                                     <p>Authors :<?=$authors?></p>													  
                                                     <p><b>DOI : <a target='_blank' href="<?=$doilink?>"><?=$doilink?></a></b></p>
												</div>
												<a class="sj-btn" href="paperinfo.php?journalPaperId=<?=$journalpaper_id?>">View Full Article</a>
											</div>
										</article>
                                        <?php
                                        }
                                        ?>
                                	</div>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3">
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
			<!--************************************
					Main End
			*************************************-->
			<!--************************************
					Footer Start
			*************************************-->
            <?php
            include "footer.php";
            ?>
		 