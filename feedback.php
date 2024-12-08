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
											<h2 style='margin-bottom:10px'>Feedback</h2>
											<p>We are continually working to improve our publication processes to deliver the best research works, and we greatly value your opinion.</p>
										</div>
										<form style='background-color:#f5f4f4' method='post' action="action/submitFeedback.php" class="sj-formtheme sj-formaddtemplates">
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
												<div class="form-group col-md-3">
													<label for="" class='lbl'>Name <span class='req'>*</span></label>
													<input type="text" required name="name" class="form-control" placeholder="Name">
												</div>
												<div class="form-group col-md-4">
												<label for="" class='lbl'>University/Institute/Company <span class='req'>*</span></label>
													<input type="text" name="company" class="form-control" placeholder="Company">
												</div>
                                                <div class="form-group col-md-5">
												<label for="" class='lbl'>Email <span class='req'>*</span></label>
													<input type="text" required name="email" class="form-control" placeholder="Email">
												</div>
												<div class="form-group col-md-12">
												<label for="" class='lbl'>Address </label>
													 <textarea class='form-control' name="address" id="address"></textarea>
												</div>

												<div class="form-group col-md-4">
												<label for="" class='lbl'>Contact No <span class='req'>*</span></label>
													<input type="text" required name="mobile" class="form-control" placeholder="Contact No">
												</div>

												<div class="form-group col-md-4">
												    <label for="" class='lbl'>City <span class='req'>*</span></label>
													<input type="text" name="city" id='city' class="form-control" placeholder="City">
												</div>

                                                <div class="form-group col-md-4">
												<label for="" class='lbl'>Country <span class='req'>*</span></label>
													<input type="text" name="country" id='country' class="form-control" placeholder="Country">
												</div>
                                                
												<div class="form-group col-md-12">
												<textarea class="form-control" name='comment' id='comment' rows='4' placeholder="Comment"></textarea>
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