 <?php
 $sql = "SELECT * FROM journals where journals_id='$journalsId'";
 $stmt = $conn->query($sql);
 $i=1;
  $row__=$stmt->fetchAssociative();
 extract($row__);
 ?>
 <div class="sj-innerbanner" >
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<div class="sj-innerbannercontent">
								<div class="box">
									<img style='width:15%;float:left;margin-right:10px' src="<?=base_url('upload/')?><?=$journal_logo?>" alt="">
									<div class="containt" style='padding-top:10px;padding-left:10px;'>
										<span style='font-size:22px;padding-top:40px;color:#0c5c8d;margin-top:10px;font-weight:bold'><?=$row__['name']?> (<?=$journal_abbri?>)</span>
										<span style='font-size:18px;display:block;color:#212529'> <?php if($issnprint!=""){?><b>ISSN (P)</b>: <?=$issnprint?> <?php }if($issnonline!=""){?><b>ISSN (O)</b>: <?=$issnonline?><?php }?> </span>
										<?php if(isset($issue)){?>
										<span style='font-size:16px;display:block;color:#212529;margin-top:5px;margin-left:15%'><b>Vol - <?=$volume?>, Issue - <?=$issue?>, <?=get_month($month)?>  <?=$year?></b></span>
										<?php
										}
										?>
								     </div>
								</div>
								<ol class="sj-breadcrumb">
									<li style='list-style:none'>
									 <a href="<?=$google_scholar_link?>"><span style='text-align:center;display:block;color:#0c5c8d' ><?=$google_scholar_v?></span></br/>Google Scholar</a></li>
									 <?php
									 if($citation_link!=""){
									 ?>
									 <li style='list-style:none'> <a href="<?=$citation_link?>"><span style='text-align:center;display:block;color:#0c5c8d' ><?=$citation_v?></span></br/>Citation </a></li>
								 	<?php
									 }
									 if($impact_factor_link!=""){
									?>
									 <li style='list-style:none'> 
									   <a  href="<?=$impact_factor_link?>">	<span style='text-align:center;display:block;color:#0c5c8d' ><?=$impact_factor_v?></span></br/>Impact Factor</a>
								   </li>
								   <?php
									 }  
								   ?>
								</ol>
							</div>
							
						</div>
						
					</div>
						
				</div>		
</div>
 
