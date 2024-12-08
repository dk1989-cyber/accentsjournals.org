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
											<h2 style='margin-bottom:10px'>Email Alert System</h2>
											
										</div>
										<form style='background-color:#f5f4f4' method="post" action="action/submitEmailAlert.php" class="sj-formtheme sj-formaddtemplates">
											<fieldset>
												<?php
												if(isset($_REQUEST['success'])){
												?>
												<div style='margin-bottom:10px' class="form-group col-md-12 msg-block <?=($_REQUEST["success"]=='1')?'success':'error'?>">
													<p class="msg-text"><?=$_REQUEST["msg"]?></p>
                                                </div>
												<?php
												}
												?>
												<div class="form-group col-md-4">
													<label for="" class='lbl'>Name <span class='req'>*</span></label>
													<input type="text" required name="name" class="form-control" placeholder="Name">
												</div>
												
                                                <div class="form-group col-md-4">
												<label for="" class='lbl'>Email <span class='req'>*</span></label>
													<input type="text" required name="email" class="form-control" placeholder="Email">
												</div>
												<div class="form-group col-md-4">
												<label for="" class='lbl'>Purpose </label>
													 <select class='form-control' name="purpose" id="purpose">
														 <option value="">Select Purpose</option>
														 <option value="Call for papers">Call for papers</option>
														 <option value="Special issue">Special issue</option>
														 <option value="All Journal alert">All Journal alert</option>
														 <option value="All">All</option>
													 </select>
												</div>

												
												
										          <div class="form-group col-md-12">
										             <div class="g-recaptcha" data-sitekey="6LdFrwkqAAAAAFpOekgvEoqRX9zSCcbUgcQR7sPC">
													</div>
												 </div>
												<div class="form-group col-md-12">
													<button class="sj-btn sj-btnactive">Submit</button>
												</div>
											</fieldset>
										</form>
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