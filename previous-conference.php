
<?php
           include "header.php";
           ?>
			<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3">
								<?php include "conferencemenu.php"?>
							</div>
							<div class="col-12 col-sm-12 col-md-8 col-lg-9">
                                 <div class="row">
                                 <?php
                                        $sql = "SELECT * FROM conference ";
                                        $stmt = $conn->query($sql);
                                        $i=1;
                                        while(($row=$stmt->fetchAssociative())!==false){
                                            extract($row);
                                        ?>
										   <div class="col-md-4" style='margin-bottom:20px' >
											   <a href="conference-detail.php?id=<?=$conference_id?>">
												<div class="box" style='background-color:#0077B5;padding:10px'>
													<h3 style='text-align:center;color:white'><?=$short_title?></h3>
													<p style='text-align:center;color:white'><i style='margin-right:5px' class='fa fa-calendar'></i><?=$dates?> </p>
													<p style='text-align:center;margin-top:-20px;color:white'><i class='fa fa-map-marker' style='margin-right:5px'></i><?=$city?>, <?=$location?></p>
												</div>
												</a>
											</div>
                                    <?php
                                    }
                                    ?>
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
		 


 