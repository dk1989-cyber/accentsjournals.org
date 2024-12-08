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
											<h2 style='margin-bottom:10px'>For Librarians</h2>
											<p>Please complete this form and submit. The details you provide will be sent to your librarian.</p>
										  </div>
										   <form style='background-color:#f5f4f4' method='post' action="action/submitLibrarian.php" class="sj-formtheme sj-formaddtemplates">
											 <fieldset>
												<?php
												if(isset($_REQUEST['success'])){
												?>
												<div style='margin-bottom:10px' class="form-group col-md-12 msg-block <?=($_REQUEST["success"]=='1')?'success':'error'?>">
													<p class="msg-text"><?=$_REQUEST["msg"]?></p>
                                                </div>
												<?php
												}
												?> <legend style='font-size:18px;color:black'  >Your Personal Detail</legend>
												<div class="form-group col-md-4">
													<label for="" class='lbl'>Name <span class='req'>*</span></label>
													<input type="text" required name="name" class="form-control" placeholder="Name">
												</div>
												 
                                                <div class="form-group col-md-8">
												<label for="" class='lbl'>Email <span class='req'>*</span></label>
													<input type="text" required name="email" class="form-control" placeholder="Email">
												</div>

												<div class="form-group col-md-12">
												<label for="" class='lbl'>Affilation </label>
													 <textarea class='form-control' name="affilation" id="affilation"></textarea>
												</div>
                                    
                                            </fieldset>
                                               <fieldset style='margin-top:10px'>
                                                <legend style='font-size:18px;color:black;'  >Your Personal Detail</legend>
                                                <p>
                                                Please enter your librarian's contact details. A copy of this form will automatically be sent to them.</p>
												 


                                                <div class="form-group col-md-4">
												<label for="" class='lbl'>Recipient's  Name <span class='req'>*</span></label>
													<input type="text" required name="rec_name" class="form-control" placeholder="Recipient Name">
												</div>
                                              

												<div class="form-group col-md-4">
												<label for="" class='lbl'>Librarian Name <span class='req'>*</span></label>
													<input type="text" required name="librarian_name" class="form-control" placeholder="Librarian Name">
												</div>

                                                <div class="form-group col-md-4">
												    <label for="" class='lbl'>Country <span class='req'>*</span></label>
													<input type="text" name="rec_country" id='rec_country' class="form-control" placeholder="Country">
												</div>

                                                <div class="form-group col-md-4">
												    <label for="" class='lbl'>Email <span class='req'>*</span></label>
													<input type="text" name="rec_email" id='rec_email' class="form-control" placeholder="Email">
												</div>

												<div class="form-group col-md-4">
												    <label for="" class='lbl'>City <span class='req'>*</span></label>
													<input type="text" name="rec_city" id='rec_city' class="form-control" placeholder="City">
												</div>

                                                <div class="form-group col-md-12" style='margin-top:10px'>
												<label for="" class='lbl'>I recommend that my library subscribes to this Journal because </label>
													 <textarea class='form-control' name="reason" id="reason"></textarea>
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