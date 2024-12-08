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
											<h2 style='margin-bottom:10px'>Book Seller</h2>
											 
										</div>
										<form style='background-color:#f5f4f4' method='post' action="action/submitBookseller.php" class="sj-formtheme sj-formaddtemplates">
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
													<label for="" class='lbl'>Company Name <span class='req'>*</span></label>
													<input type="text" required name="company" class="form-control" placeholder="Company">
												</div>
                                                <div class="form-group col-md-3">
													<label for="" class='lbl'>Company Person <span class='req'>*</span></label>
													<input type="text" required name="name" class="form-control" placeholder="Name">
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