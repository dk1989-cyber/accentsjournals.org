
<?php
           include "header.php";
		    extract($_REQUEST);
			
		 
			$q="select * from journals_news where journals_news_id = '$news_id'";
			$stm2=$conn->query($q);
			$row3=$stm2->fetchAssociative();
		    extract($row3);

		    
			$sql = "SELECT * FROM journals where journals_id='$journals_id'";
			$stmt = $conn->query($sql);
			$i=1;
		    $row=$stmt->fetchAssociative();
		    extract($row);
			$journalsId=$journals_id;
           ?>
		  <?php
		   include "journal_header.php"; 
		  ?>
		   <main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
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
                                         <div class="col-md-12 content" >
                                              <div class="row">
												<?php
                                                     
                                                    $date = date('d-m-Y', strtotime($created));
                                                    ?>
													<?php
													if($image!=""){
														$img="upload/journal_content/news/$image";
													?>
                                                   <div class="col-md-12">
													<img src="<?=$img?>" alt="">
												   </div>
                                                   <?php
                                                    }
                                                   ?>
                                                    <div class="col-md-12" style='margin-bottom:20px;margin-top:20px'>
														<h5 style='color:black'><a href="news-detail.php?news_id=<?=$journals_news_id?>"><b><?=$title?></b><a></h5>
														<p style='margin-top:-10px'><?=$discription?></p>
														<span  class="sj-date">Published <?=$date?></span>
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
		 