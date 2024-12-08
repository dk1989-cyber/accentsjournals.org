
<?php
           include "header.php";
		    extract($_REQUEST);
			include "commonrequest.php";
			$sql = "SELECT * FROM issue where journals_id='$journalsId' and status='Current'";
		    $stmt = $conn->query($sql);
			$i=1;
		    $row=$stmt->fetchAssociative();
			$month=$row['month'];
			$m_=$row['month'];
			$year=$row['year'];
			$month=$m_;
			$volume=$row['volume'];
			$issue=$row['issue'];
		    include "journal_header.php";
		    
		   if(is_array($row)){ 
		    extract($row);     
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
						     <?php
							 if($is_msgbox){
								if($message_box_type=="Fixed"){
							    ?>		
                                   <p><?=$message_box?></p>
                                <?php
								}
								else{
								?>	
                                  <marquee style='height:300px' behavior="" direction="up">
									   <p><?=$message_box?></p>
								  </marquee>
							    <?php		
								  }
								}
							 ?>
						   </div>
						   <div class="col-md-4" style='text-align:center'>
						    <?php
							  $img="";
							  $m=$month+1;
							  if($issue_cover_image!=""){
								  $img=base_url("PaperDirectory/Journal/$journal_abbri/$year/$m/$issue_cover_image");
							  }
							  else{
								$img="";
							  }
							?>
							 <a href="<?=$img?>"><img src="<?=$img?>" alt=""></a><br/>
                             <a  href=""><?=$content?>  </a>
						   </div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div id="sj-content" class="sj-content">
								 	<div class="sj-articles">
									    <?php
										 
									      if($is_discipline==1){
										     if($disciplines!=""){
												
												$sql="select * from discipline where discipline_id IN ($disciplines)";
												$stmt = $conn->query($sql);
												$m=$month+1;
												while(($row2=$stmt->fetchAssociative())!==false){
													extract($row2);
												?>
												<h3 class='dispheader' style='padding-top:30px;font-weight:bold'><?=$row2['discipline']?></h3>
												<?php
												$sql2= "SELECT jp.*,ar.article_type
												FROM journalpaper jp LEFT JOIN article_type ar 
												ON ar.article_type_id=jp.article_type_id where jp.issue_id='$issue_id' 
												and  jp.discipline=$discipline_id and jp.is_publish='1'  order by jp.orders";
												$stmt3 = $conn->query($sql2);
												
												while(($row3=$stmt3->fetchAssociative())!==false){
												?>
															<article class="sj-post sj-editorchoice">
																<figure class="sj-postimg">
																<?php
																$pimg="";
																if($row3['paperimage']!=""){
																	$m__=$m_+1;
																	$pimg=base_url("PaperDirectory/Journal/$journal_abbri/$year/$m__/").$row3['paperimage'];
																}
																else{
																	$pimg=base_url('upload/placeholder.jpg');
																}
																?>	
																<a href="<?=$pimg?>" target='_blank'><img style='width:200px;height:200px' src="<?=$pimg?>" alt="image description"></a>
																</figure>
																<?php
																if($row3['modification_type']!=""){
																if($row3['modification_type']=="Retraction"){
																	$m="<b style='color:red'>[Retracted]</b>";
																}
																else{
																	$m="";	
																}
																}
																else{
																	$m="";
																}
																?>
																<div class="sj-postcontent">
																	<div class="sj-head">
																		<span class="sj-username"><a href="<?=base_url('paperinfo.php').'?journalPaperId='.$row3['journalpaper_id']?>" style='font-weight:bold;color:#017398'><?=$row3['article_type']?> Article <i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i> <?=$m?></a>
																</span>
																		<h3><a href="<?=base_url('paperinfo.php').'?journalPaperId='.$row3['journalpaper_id']?>" style='color:black'><b><?=$row3['title']?></b></a></h3>
																	</div>
																	<div class="sj-description">
																		<p>Authors :<?=$row3['authors']?> </p>
																		<p>DOI     :<a style='color:black' target='_blank' href="<?=$row3['doilink']?>"><?=$row3['doilink']?></a> </p>
																	</div>
																	<a class="sj-btn" style='color:white;cursor:pointer' onclick="update_counter(<?=$row3['journalpaper_id']?>,'download')"><i class='fa fa-download'></i> PDF Download</a>
																	<a class="sj-btn" style='color:white;cursor:pointer' onclick="cite(<?=$row3['journalpaper_id']?>,'paper')"  >Cite this Article</a>
																</div>
															</article>
												<?php
												}
												}
										  }
								        } 
										else{

											$sql2= "SELECT jp.*,ar.article_type 
											FROM journalpaper jp LEFT JOIN article_type ar 
											ON ar.article_type_id=jp.article_type_id where jp.issue_id='$issue_id' 
											and   jp.is_publish='1'  order by jp.orders";
											$stmt2 = $conn->query($sql2);
											while(($row2=$stmt2->fetchAssociative())!==false){
											?>
									 
											<article class="sj-post sj-editorchoice">
											          <?php
													 $m=$month+1;
													   if($row2['paperimage']!=""){
														
														$pimg=base_url("PaperDirectory/Journal/$journal_abbri/$year/$m/").$row2['paperimage'];
													   }
													   else{
														$pimg=base_url('upload/placeholder.jpg');
													   }
													   ?>	
												 	<a href="<?=$pimg?>" target='_blank'>
													 <figure class="sj-postimg">
													    <img src="<?=$pimg?>" style='width:200px;height:200px' alt="image description">
													 </figure>
												    </a>
											   
												<div class="sj-postcontent">
													<div class="sj-head">
													<?php
													if($row2['modification_type']!=""){
													  if($row2['modification_type']=="Retraction"){
														$m="<b style='color:red'>[Retracted]</b>";
													  }
													  else{
														$m="";	
												       }
													}
													else{
														$m="";
													}
													?>
													  <span class="sj-username"><a style='font-weight:bold'><?=$row2['article_type']?> Article<i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i> <?=$m?></a>
												 	</span>
												   	<h3><a style='color:black' href="<?=base_url('paperinfo.php').'?journalPaperId='.$row2['journalpaper_id']?>"><?=$row2['title']?></a></h3>
													</div>
													<div class="sj-description">
													<p>Authors :<?=$row2['authors']?> </p>
												    <p>DOI     :<a style='color:black' target='_blank' href="<?=$row2['doilink']?>"><?=$row2['doilink']?></a> </p>
													</div>
													<a class="sj-btn" style='color:white;cursor:pointer'  onclick="update_counter(<?=$row2['journalpaper_id']?>,'download')"><i class='fa fa-download'></i> PDF Download</a>
													<a class="sj-btn" style='color:white;cursor:pointer' onclick="cite(<?=$row2['journalpaper_id']?>,'paper')"  >Cite this Article</a>
												</div>
											</article>
										<?php
										  }
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
		  
		   }
		   else{  
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

						    <?php
							 $issuid= $row['issue_id'];
							 $sql3 = "SELECT jp.*,ar.article_type FROM journalpaper jp LEFT JOIN article_type ar ON ar.article_type_id=jp.article_type_id where jp.issue_id='$issuid'";
							 $stmt3 = $conn->query($sql3);
							 $i=1;

							 $m=$month+1;
							 
							 $dir="PaperDirectory/Journal/$journal_abbri/$year/$m/";
							 $root=base_url($dir);

							 $c_img=base_url($issue_cover_image);
							 
							?>
							 <img style='width:100%' src="<?=$c_img?>" alt=""><br/>
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
											<a href="<?=base_url($paperimage)?>" target='_blank'>  
													<img style='width:200px;height:200px' src="<?=base_url($paperimage)?>" alt="image description">
											</a>
											</figure>
											<div class="sj-postcontent">
												<div class="sj-head">
													<span class="sj-username"><a style='font-weight:bold;color:#017398'><?=$article_type?> Article <i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i></a>
                                                   </span>
													<h3><a  style='font-family:times new roman; color:black;font-weight:bold' href="paperinfo.php?journalPaperId=<?=$journalpaper_id?>"><?=$title?></a></h3>

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
		    }
		    }
            include "footer.php";
            ?>
			
	<script>
		function pdf_download(jpid){
				url="<?=base_url('ajax/downloadPaper.php')?>";
				$.get(url,{"id":jpid},function(data,status){
					if(status=="success"){

						// let byteArray = new Uint8Array(data)
						// let file = new Blob(
						// [byteArray],
						// {type: 'application/pdf'}
						// )

						
							var file = new Blob([data], {type: "application/octet-stream"});
							var fileURL = URL.createObjectURL(file);
							var link = $("<a>").attr({href: fileURL, download: "test.pdf"}).click();
							window.open(fileURL);
							
					}
				});
			}

			function view_paper(){
				url="<?=base_url('ajax/viewPaper.php')?>";
				$.get(url,{"id":id},function(data,status){
					if(status=="success"){
						
					}
				});
			}
</script>

			
		 