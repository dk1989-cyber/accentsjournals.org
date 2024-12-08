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
											<h2 style='margin-bottom:10px'>Journal Hard Copy Request</h2>
											 <p></p>
										</div>
										<form style='background-color:#f5f4f4' method='post' action="action/submitHardCopyRequest.php" class="sj-formtheme sj-formaddtemplates">
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
												<label for="" class='lbl'>Contact<span class='req'>*</span></label>
													<input type="text" required name="mobile" class="form-control" placeholder="Contact No">
												</div>
												<div class="form-group col-md-12">
												<label for="" class='lbl'>Postal Address </label>
													 <textarea class='form-control' name="address" id="address"></textarea>
												</div>
                                                <div class="form-group col-md-4">
												<label for="" class='lbl'>Journal <span class='req'>*</span></label>
													<select onchange="get_issue()" class='form-control' name="journals_id" id="journals_id">
                                                         <option value="">Select Journal</option>
                                                         <?php
                                                         $q="select * from journals";
                                                         $stmt=$conn->query($q);
                                                         while(($row=$stmt->fetchAssociative())!==false){
                                                            extract($row);
                                                         ?>
                                                         <option value="<?php echo $row['journals_id']?>"><?php echo $row['journal_abbri']?></option>
                                                         <?php
                                                         }
                                                         ?>
                                                    </select>
												</div>

												<div class="form-group col-md-4">
												<label for="" class='lbl'>Issue <span class='req'>*</span></label>
                                                        <select onchange="get_paper();" class='form-control' name="issue_id" id="issue_id">
                                                            <option value="">Select Issue</option>
                                                      </select>
												</div>

                                                <div class="form-group col-md-4">
												<label for="" class='lbl'>Paper   <span class='req'>*</span></label>
                                                      <select class='form-control' name="paper_id" id="paper_id">
                                                            <option value="">Select Paper</option>
                                                      </select>
												</div>                                          
												<div class="form-group col-md-12">
                                                <label for="" class='lbl'>Remark<span class='req'>*</span></label>
												<textarea class="form-control" name='comment' id='comment' rows='4' placeholder="Remark"></textarea>
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
		 
			<?php
			include "footer.php";
			?>


<script>
function get_issue(){
     var journal_id=document.getElementById('journals_id').value;
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
             document.getElementById("issue_id").innerHTML = this.responseText;
         }
     };
     xhttp.open("GET", "ajax/get_issue.php?journal_id="+journal_id, true);
     xhttp.send();
}

function get_paper(){
     var journal_id=document.getElementById('journals_id').value;
     var issue_id=document.getElementById('issue_id').value;
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
             document.getElementById("paper_id").innerHTML = this.responseText;
         }
     };
     xhttp.open("GET", "ajax/get_paper.php?issue_id="+issue_id, true);
     xhttp.send();
}
</script>
