<?php
include "header.php";
?>
<style>
    .tag{
        background: #808285;
        color: #fff;
        padding: 5px;
        border-radius:5px;
    }
    .bootstrap-tagsinput .tag [data-role="remove"] {
    margin-left: 8px;
    cursor: pointer;
    border: 1px solid white;
}  

.bootstrap-tagsinput{
    width:100%;
    padding:2px;
}
</style>
			
		
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
					     	 
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-right">
								<div id="sj-content" class="sj-content">
									<div class="sj-addarticleholdcontent">
										<div class="sj-dashboardboxtitle">
											<h2 style='margin-bottom:10px'><b>Call for Editorial Board / Reviewers Panel</b></h2>
                                            <p>ACCENT Society invites academicians and researchers to join as members of the Editorial/Reviewer Board of our journal. If you are interested in becoming an editorial board member or peer reviewer, please fill out and submit the following form.</p>
                                        </div>
										<form style='background-color:#f5f4f4' enctype="multipart/form-data" method="post" action="action/submitInvitation.php" class="sj-formtheme sj-formaddtemplates">
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
                                                     <label for="" class='lb'>Jouranl Name <span class='req'>*</span></label>
                                                     
												     <select required class='form-control' name="journals_id" id="journals_id">
                                                         <option value="" selected>Please Select Journal</option>
                                                         <?php
                                                          $sql = "SELECT * FROM journals";
                                                          $stmt = $conn->query($sql);
                                                         
                                                         while(($row=$stmt->fetchAssociative())!==false){
                                                            extract($row);
                                                         ?>
                                                         <option value="<?=$journals_id?>"><?=$journal_abbri?></option>
                                                         <?php
                                                         }
                                                         ?>
                                                     </select>
												</div>
                                                <div class="form-group col-md-3">
                                                     <label for="" class='lb'>Title <span class="req">*</span></label>
                                                     <select required class='form-control' name="title" id="title">
                                                     <option value="" selected>Please Select Journal</option>
                                                        <option value="Dr">Dr</option>
                                                        <option value="Prof">Prof</option>
                                                    </select>
												</div>

                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>First Name <span class='req'>*</span></label>
                                                     <input required class='form-control' type="text" name='first_name'>
												</div>

                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>Middle Name</label>
                                                     <input  class='form-control' type="text" name='middle_name'>
												</div>

                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>Last Name</label>
                                                     <input  class='form-control' type="text" name='last_name'>
												</div>

                                                <div class="form-group col-md-3">
                                                     <label for="" class='lb'>Department <span class='req'>*</span></label>
                                                     <select required class='form-control' name="department" id="department">
                                                     <?php
                                                          $sql = "SELECT * FROM department";
                                                          $stmt = $conn->query($sql);
                                                         
                                                         while(($row=$stmt->fetchAssociative())!==false){
                                                         extract($row);
                                                         ?>
                                                         <option value="<?=$department_id?>"><?=$department?></option>
                                                         <?php
                                                         }
                                                         ?>
                                                    </select>
												</div>

                                                


                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>Position <span class='req'>*</span></label>
                                                     <select required name="position" id="" class="form-control">
                                                          
                                                         <?php
                                                         $sql = "select * from designation";
                                                         $stmt = $conn->query($sql);
                                                         $i=1;
                                                        while(($row=$stmt->fetchAssociative())!==false){
                                                            extract($row);
                                                         ?>
                                                           <option value="<?=$designation_id?>"><?=$designation?></option>
                                                         <?php
                                                          }
                                                         ?>
                                                     </select>
												</div>
                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>University/Institute Name/Company Name <span class='req'>*</span></label>
                                                     <input type="text" required class='form-control' name='university'>
												</div>
                                                <div class="form-group col-md-12">
                                                     <label  for="" class='lb'>Address</label>
                                                     <textarea class='form-control' name="address" id=""></textarea>
                                                     
												</div>
                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>Higher Education <span class='req'>*</span></label>
                                                     <input required type="text" name='higher_education' class="form-control">
												</div>
                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>Telephone</label>
                                                     <input type="number" class='form-control' name='telephone' id='telephone'>
												</div>

                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>Mobile</label>
                                                     <input type="number" class='form-control' name='mobile' id='mobile'>
												</div>

                                                <div class="form-group col-md-3">
                                                     <label  for="" class='lb'>Email <span class='req'>*</span></label>
                                                     <input required type="text" class='form-control' name='email' id='email'>
												</div>
                                                <div class="form-group col-md-12">
                                                     <label  for="" class='lb'>Brief biography <span class='req'>*</span></label>
                                                     <textarea required class='form-control' name="b_bio" id=""></textarea>
												</div>
                                                <div class="form-group col-md-12">
                                                     <label  for="" class='lb'>Weblink (Personal)</label>
                                                   
                                                     <input type="text" name='weblink' class="form-control">
												</div>
                                                <div class="form-group col-md-6">
                                                     <label  for="" class='lb'>SCOPUS ID</label>
                                                     <input type="text" name='scopus_id' class="form-control">
												</div>
                                                <div class="form-group col-md-6">
                                                     <label  for="" class='lb'>ORCID ID</label>
                                                     <input type="text" name='orcid' class="form-control">
												</div>
                                                <div class="form-group col-md-12">
                                                     <label  for="" class='lb'>Google Scholar Link</label>
                                                     <input type="text" name='g_scholar' class="form-control">
												</div>
                                                
                                                <div class="form-group col-md-12">
                                                     <label  for="" class='lb'>Domain of Research <span class="req">*</span></label>
                                                     <span style='font-size:12px;color:red;display:block;margin-top:-15px'>Add at least four research areas separated by semicolon</span>
                                                     <input required style='width:100%' required    autocomplete="off"  data-role="tagsinput"   type="text" Placeholder="Separated with comma"  name='dom_r' id='dom_r' class='form-control'  />     
												</div>
                                               
                                               
                                                <div class="form-group col-md-6">
                                                     <label  for="" class='lb'>Photograph <span class='req'>*</span></label>
                                                     <input required type="file" name='photo' id='photo' onchange="getImg(this,img_img,'400','400');">
												</div>
                                                <div class="form-group col-md-6">
                                                     <label  for="" class='lb'>Upload CV <span class='req'>*</span></label>
                                                     <input required type="file" name='resume'>
												</div>
                                              
                                                <div class="form-group col-md-2">
                                                <img style='width:100%' src="https://via.placeholder.com/200x200" alt="" id='img_img'>  
                                              </div>

                                              <div class="form-group col-md-12">
										             <div class="g-recaptcha" data-sitekey="6LdFrwkqAAAAAFpOekgvEoqRX9zSCcbUgcQR7sPC">
													</div>
												 </div>
                                                
												<div class="form-group">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
        <script src="<?=base_url('admin/dist/bootstrap-tagsinput.js')?>"></script>
		