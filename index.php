<?php
include "header.php";
?>
			<!--************************************
					Home Banner Start
			*************************************-->
			<!-- <div id="sj-homebanner" class="sj-homebanner">
				<div class="container">
					<div class="row">
					 
					</div>
				</div>
			</div> -->
			<!--************************************
					Home Banner End
			*************************************-->
			<!--************************************
					Main Start
			*************************************-->
			<main id="sj-main" class="sj-main sj-haslayout ">
				<div class="sj-haslayout">
					<?php
					$burl=base_url('images/banner.jpg');
					?>
					<div class="container-fluid" style="background-image:url('<?=$burl?>');background-position:center;background-size:cover">
						<div class="row" style='text-align:center'>
							<div class="col-md-12">
							   <h1 style="font-weight: 600;padding: 100px;font-size:70px;color: #fff;text-shadow: 0px 0px 20px #000;text-transform: none;">Publisher of Peer Reviewed<br>Open Access Journals</h1>
							 </div>
						</div>
					</div>    
				</div>
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
				  	  <div class="row" style='margin-top:-100px;margin-bottom:50px'>
							 <div class="col-md-3">
								   <div id='blockhead1' class="blockhead">
									   <a href="<?=base_url('our-journals.php')?>">
									     <img style='width:30%' src="<?=base_url('images/gridimg/research-2.png')?>" alt="">
									      <h4>ACCENTS</h4>
									   </a>
								   </div>
							 </div>
							 <div class="col-md-3">
								   <div id='blockhead2' class="blockhead">
                                      <a href="<?=base_url('our-journals.php')?>">
									  <img style='width:30%'  src="<?=base_url('images/gridimg/diary.png')?>"   alt="">
									  <h4>Our Journals</h4>
                                      </a>
								   </div>
							 </div>
							 <div class="col-md-3">
								   <div id='blockhead3' class="blockhead">
								    <a href="https://theaccents.org/our-journals">
									 <img style='width:30%'   src="<?=base_url('images/gridimg/customer-feedback.png')?>"  alt="">
									  <h4>ACCENTS MSS</h4>
                                      </a>
								   </div>
							 </div>
							 <div class="col-md-3">
								   <div id='blockhead4' class="blockhead">
								    <a href="<?=base_url('conference.php')?>">
								     <img style='width:30%' src="<?=base_url('images/gridimg/conference.png')?>"   alt="">
									  <h4>Conferences</h4>
                                     </a>
								   </div>
							 </div>
						</div>
						<div class="row" style='margin-top:-100px;margin-bottom:100px'>
							  
						 
						</div>
					</div>
				</div>
				

				<div id="sj-twocolumns" class="sj-twocolumns" style='margin-bottom:-100px'>
					<div class="container">
				  	  <div class="row" style='margin-top:-30px;margin-bottom:100px'>
						<div class="sj-welcomegreeting">
								<div class="col-12 col-sm-12 col-md-5 col-lg-5 sj-verticalmiddle">
									<img style='width:100%' src="https://theaccents.org/assets/images/detail/009097600_1687614061.jpg" alt="">
								</div>
								<div class="col-12 col-sm-12 col-md-7 col-lg-7 sj-verticalmiddle">
									<div class="sj-welcomecontent">
										<div class="sj-welcomehead" style='margin-top:10px'>
										 <h2>About Accent</h2>
										</div>
										<div class="sj-description">
											 <p>The Association of Computer, Communication and Education for National Triumph Social and Welfare Society (ACCENTS) is a registered non-profitable organization for engineers and researchers in the field of computer science, electronics and electrical engineering.Our main aim is to extend help in the field of education to those students who belong to weaker section of society, specially girls.</p>
											 <p>The Association of Computer, Communication and Education for National Triumph Social and Welfare Society (ACCENTS) is a registered non-profitable organization for engineers and researchers in the field of computer science, electronics and electrical engineering.Our main aim is to extend help in the field of education to those students who belong to weaker section of society, specially girls.</p>	
										</div>
										 
									</div>
								</div>
							</div>
						</div>
						 
					  </div>
				</div>

				
				<div id="sj-twocolumns" class="sj-twocolumns">
				<div class="container-fluid" style="/* background-image:url('https://png.pngtree.com/thumb_back/fh260/background/20230713/pngtree-3d-rendered-news-form-or-article-image_3872311.jpg'); */background-position:center;background-size:cover;background-color: #f1f1f1;">
						<div class="row" style='margin:30px;text-align:center;padding:80px'>
							<div class="col-md-12">
									<h3 style='color:black'>Journals</h3>
									<p style='color:black'>Explore our portfolio to stay abreast of the latest advancements and contribute to
									the advancement of knowledge in your field.</p>
							</div>
						</div>
				   </div>
				   <div class="container" style='margin-top:-100px;margin-bottom:40px;' >
				  	  <div class="row" >
							<?php
							$sql = "SELECT * FROM journals limit 4";
							$stmt = $conn->query($sql);
							$i=1;
							while(($row=$stmt->fetchAssociative())!==false){
							extract($row);
							?>
							 <div class="col-md-3">
								   <div   class="blockjournal" style=''>
									  <img style='width:100%' src="<?=base_url('upload/').$cover_image?>" alt="">
									  <h4><?=$journal_abbri?></h4>
									  <a class='badge badge-info' href="<?=base_url('journals.php?journalsId=')?><?=$journals_id?>">View </a>
								   </div>
							 </div>
							 <?php
							  }
							 ?>
						 </div>
						 <div class="row">
							<div class="col-md-12" style='text-align:center;margin-top:-5px'>
							<a class='badge badge-info' href="<?=base_url('our-journals.php')?>">View All</a>
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