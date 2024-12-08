
<?php
           include "header.php";
           extract($_REQUEST);
           $sql = "SELECT * FROM conference     WHERE conference_id=$id";
           $stmt = $conn->query($sql);
           $i=1;
           $row=$stmt->fetchAssociative();
           extract($row);
           ?>

			<!--************************************
					Header End
			*************************************-->
			<!--************************************
					Inner Banner Start
			*************************************-->

             
            <main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-3">
								<?php include "conferencemenu.php"?>
							</div>
							<div class="col-12 col-sm-12 col-md-8 col-lg-9">
								<div id="sj-content" class="sj-content">
                                    <!-- <h3 style='font-wright:bold;color:#000'><?=$title?></h3> -->
								     <?=$discription?>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</main>
			<!--************************************
					Inner Banner End
			*************************************-->
			<!--************************************
					Main Start
			*************************************-->
		 
			<!--************************************
					Main End
			*************************************-->
			<!--************************************
					Footer Start
			*************************************-->
            <?php
            include "footer.php";
            ?>
		 


 