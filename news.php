
<?php
           include "header.php";
		    extract($_REQUEST);
			include "commonrequest.php";
			$sql = "SELECT * FROM journals where journals_id='$journalsId'";
			$stmt = $conn->query($sql);
			$i=1;
		    $row2=$stmt->fetchAssociative();
		    extract($row2);
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
								 $q="select * from journals_news where journals_id = '$journalsId'";
								 
								 $stm2=$conn->query($q);
								
                                 ?>
							</div>
							<div class="col-12 col-sm-12 col-md-8 col-lg-9">
								<div id="sj-content" class="sj-content">
									<div class="sj-articledetail">
									  	<div class="sj-articledescription sj-sectioninnerspace">
                                        <div class="row card shadow d-flex justify-content-center ">
                                         <div class="col-md-12 content" >
                                              <div class="row">
												<?php
												while(($row3=$stm2->fetchAssociative())!==false){
													extract($row3);
                                                    $date = date('d-m-Y', strtotime($created));
                                                    ?>
													<?php
													if($image!=""){
														$img="upload/journal_content/news/$image";
													?>

                                                  <div class="col-md-3">
													<img src="<?=$img?>" alt="">
												   </div>
												   <div class="col-md-9" style='margin-bottom:20px;margin-top:20px'>
												   <h5 style='color:black'><a style='text-decoration:underline'  href="news-detail.php?journalsId=<?=$journalsId?>&news_id=<?=$journals_news_id?>"><b><?=$title?></b><a></h5>
														<p style='margin-top:-10px'><?=$discription?></p>
														<span  style='float:right;font-weight:bold;font-size:12px !important' class="sj-date">Published On <?=$date?></span>
													</div>
                                                 <?php
													}else{
														
                                                  ?>
												  <div class="col-md-12" style='margin-bottom:20px;margin-top:20px'>
														<h5 style='color:black'><a style='text-decoration:underline'  href="news-detail.php?journalsId=<?=$journalsId?>&news_id=<?=$journals_news_id?>"><b><?=$title?></b><a></h5>
														<p style='margin-top:-10px;text-align:justify'><?=$discription?></p>
														<span   style='float:right;font-weight:bold;font-size:12px !important' class="sj-date">Published On <?=$date?></span>
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
		 