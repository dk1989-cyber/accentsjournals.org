
<?php
           include "header.php";
           include "commonrequest.php";
           ?>
 
			<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
                         <div class="col-md-12">
							   <ul class="sj-downloadprint">
									 	   <li><a class='btn btn-sm btn-danger' href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
							  </ul>
					     </div>
						 
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3">
								<?php include "conferencemenu.php"?>
							</div>
							<div class="col-12 col-sm-12 col-md-8 col-lg-9">
								<div id="sj-content" class="sj-content">
                                    <div class="row">
								      <?php
                                     $sql = "select * from confrence";
                                     $stmt = $conn->query($sql);
                                     $i=1;
                                    while(($row=$stmt->fetchAssociative())!==false){
                                        extract($row);
                                       ?> 
                                            <div class="col-md-3">
                                                  <a href="<?=base_url('conferencepaper.php?confrenceid='.$confrenceId)?>">
                                                      <img src="<?=base_url($confImage)?>" alt="">
                                                  </a>
                                            </div>
                                       
                                       <?php
                                      }
                                     ?>
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
		 


 