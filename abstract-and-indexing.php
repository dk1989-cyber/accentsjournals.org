
           <?php
            include "header.php";
		    extract($_REQUEST);
			$sql = "SELECT * FROM journals where journals_id='$id'";
			$stmt = $conn->query($sql);
			$i=1;
			 $row=$stmt->fetchAssociative();
			extract($row);
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
                                         <div class="col-md-12 content"  style='padding:20px;max-height:600px;overflow:scroll;  overflow-x: hidden;'>
                                           <?=$journal_indexing?>
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
		 