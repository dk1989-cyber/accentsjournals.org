<?php
include "header.php";
?>
			
			<!--************************************
					Inner Banner End
			*************************************-->
			<!--************************************
					Main Start
			*************************************-->
			
			<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div class="container">
					<div class="row">
						<div id="sj-twocolumns" class="sj-twocolumns">
					     	 
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
								<div id="sj-content" class="sj-content">
									<div class="sj-addarticleholdcontent">
													<div class="sj-dashboardboxtitle">
														<?php
														$q="select * from content where type='SUPPORT'";
														$stmt = $conn->query($q);
														$row=$stmt->fetchAssociative();
														extract($row);
														?>
										              <?=$content?>
													
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