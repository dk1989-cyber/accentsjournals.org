<?php
           include "header.php";
		    extract($_REQUEST);
			include "commonrequest.php";
			$sql = "SELECT jc.*,j.* FROM journal_content jc 
			LEFT JOIN journals j ON jc.journals_id = j.journals_id
			where jc.journals_id='$journalsId' and jc.type='Special_Issues'";
			$stmt = $conn->query($sql);
		    $i=1;
		    $row=$stmt->fetchAssociative();
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
                                         <div class="col-md-12 content" >
											<?php
									       if(is_array($row)){
											extract($row);
											?>
                                           <?=$discription?>
                                         </div>   
										  <div class="col-md-6" >
                                            <?php
											if($image!=""){
											 $url=base_url("upload/journal_content/").$image;
											?>
											<img src="<?=$url?>" alt="">
											<?php
											}
											?>
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
		 