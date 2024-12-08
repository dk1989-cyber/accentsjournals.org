
<?php
   ob_start();
	include "header.php";
    extract($_REQUEST);

    include "commonrequest.php";

 ?>

		   <style>
				a.nav-link span.tooltip {
			color: #c3c3c3;
			font-size: 15px;
			bottom: 2px;
			position: relative;
			display: inline-block;
        }
		a.nav-link>span.tooltip span.tooltiptext {
			visibility: hidden;
			background-color: #fff;
			color: #000;
			text-align: left;
			padding: 5px 0;
			position: absolute;
			z-index: 1;
			font-size: 12px;
			-moz-box-sizing: border-box;
			padding: 12px;
			border-radius: 0;
			line-height: 1.5;
			box-shadow: 0 0 16px 0 rgb(54 58 80 / 16%);
			box-sizing: border-box;
			white-space: normal;
			word-wrap: break-word;
			word-break: break-word;
		}
		a.nav-link>span.tooltip:hover span.tooltiptext {
            visibility: visible;
         }
		   </style>
	 
		<?php
		include "journal_header.php";
		?>
			<!--************************************
					Inner Banner End
			*************************************-->
			<!--************************************
					Main Start
			*************************************-->
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
										 	<div class="row">
                                              <div class="col-md-3">
                                                 <img src="<?=($cover_image!="")?base_url('upload/').$cover_image:base_url('upload/placeholder.jpg')?>" alt="">
                                              </div>
                                              <div class="col-md-9" style='text-align:justify'>
													<?php
													$short=substr($journal_about,0,840);
												    if(mb_strlen($journal_about, "UTF-8")>840){
													?>
													<p>
													  <span id='jabout'><?=$short?></span><span id='dot'>...</span>
													  <a id='view_action' onclick="view_more()" class='' style='cursor:pointer;color:blue'>More</a>
												    </p>
													<?php
												   }
												   else {
													?>
													 <p><?=$journal_about?></p>
													<?php
												    }
													?>
                                              </div>
                                         </div>

									 <?php
									 ?>	 
									 
									 <?php
									 ?>

									 <div class="sj-articledescription sj-sectioninnerspace">
                                        <div class="row card shadow d-flex justify-content-center ">
                                         <div class="col-md-12">
                                         <ul class="nav nav-pills mb-3 shadow-sm" id="pills-tab" role="tablist">
                                            <li class="nav-item tb">
                                            <a class="nav-link  active" id="pills-home-tab" data-toggle="pill" href="#pills-ls" role="tab" aria-controls="pills-ls" aria-selected="true">Latest article  
								        	<span  class='toolip'>
												<i style='border:1px solid gray;padding:2px;padding-left: 5px;padding-right: 5px;border-radius:100px;font-size:10px;color:black' class="fa fa-solid fa-info"></i>
												<span class="tooltiptext most-cited"><?=$latest_info?></span>
										     </span>
											</a>
                                            </li>
											<?php
											$q="select p.*,ar.article_type,j.* from press_paper p
											LEFT JOIN article_type ar ON ar.article_type_id=p.article_type_id 
											LEFT JOIN journals j ON j.journals_id=p.journals_id 
											where p.journals_id='$journals_id'";
											$stmt0 = $conn->query($q);
											$cnt=$stmt0->rowCount();
											if($cnt>0){
											//	latest_info,,most_download_info,most_view_info,most_cite_info
											?>
                                            <li class="nav-item tb">
                                            <a class="nav-link" id="pills-ap-tab" data-toggle="pill" href="#pills-ap" role="tab" aria-controls="pills-ap" aria-selected="false">Article in press 
												<span  class='toolip'>
													<i style='border:1px solid gray;padding:2px;padding-left: 5px;padding-right: 5px;border-radius:100px;font-size:10px;color:black' class="fa fa-solid fa-info"></i>
													<span class="tooltiptext most-cited"><?=$article_press_info?></span>
													</span>
												</span>
										    </a>
                                            </li>
											<?php
											}
											?>
                                            <li class="nav-item tb">
                                            <a class="nav-link " id="pills-md-tab" data-toggle="pill" href="#pills-md" role="tab" aria-controls="pills-md" aria-selected="false">Most downloaded 
											    <span  class='toolip'>
													<i style='border:1px solid gray;padding:2px;padding-left: 5px;padding-right: 5px;border-radius:100px;font-size:10px;color:black' class="fa fa-solid fa-info"></i>
													<span class="tooltiptext most-cited"><?=$most_download_info?></span>
												</span>
												
										   </a>
                                           </li>
                                            <li class="nav-item tb">
                                            <a class="nav-link "   id="pills-mv-tab" data-toggle="pill" href="#pills-mv" role="tab" aria-controls="pills-mv" aria-selected="false">Most Viewed 
											<span  class='toolip'>
													<i style='border:1px solid gray;padding:2px;padding-left: 5px;padding-right: 5px;border-radius:100px;font-size:10px;color:black' class="fa fa-solid fa-info"></i>
													<span class="tooltiptext most-cited"><?=$most_view_info?></span>
												</span>
												
											</a>
                                            </li>
                                            <li class="nav-item tb">
                                               <a class="nav-link" style='disply:inline-block;float:left' id="pills-mc-tab" data-toggle="pill" href="#pills-mc" role="tab" aria-controls="pills-mc" aria-selected="false">Most cited 
											   <span  class='toolip'>
													<i style='border:1px solid gray;padding:2px;padding-left: 5px;padding-right: 5px;border-radius:100px;font-size:10px;color:black' class="fa fa-solid fa-info"></i>
													<span class="tooltiptext most-cited"><?=$most_cite_info?></span>
												</span>
												
                                            </li>
                                        </ul>                                        
                                        <div class="tab-content" id="pills-tabContent p-3" style='max-height:600px;overflow: scroll;overflow-x: hidden;'>
                                            <div class="tab-pane fade show active" id="pills-ls" role="tabpanel" aria-labelledby="pills-la-tab">
                                               <?php
											   $sql2= "SELECT jp.*,i.*,ar.article_type 
											   FROM journalpaper jp 
											   LEFT JOIN issue i ON i.issue_id=jp.issue_id 
											   LEFT JOIN article_type ar ON ar.article_type_id=jp.article_type_id 
											   where jp.journals_id='$journals_id' 
											   and  jp.is_publish='1' and i.status='current'  order by jp.orders";
											   $stmt2 = $conn->query($sql2);
											   while(($row2=$stmt2->fetchAssociative())!==false){
												extract($row2);
											   ?>
											   <article class="sj-post sj-editorchoice">
											
                                                     <?php
													   if($row2['paperimage']!=""){
													    $m=$month+1;
														$pimg=base_url("PaperDirectory/Journal/$journal_abbri/$year/$m/").$row2['paperimage'];
													   }
													   else{
														$pimg=base_url('upload/placeholder.jpg');
													   }
													   ?>	
													 <a href="<?=$pimg?>" target='_blank'>
													  <figure class="sj-postimg">
														<img    style='width:200px;height:200px' src="<?=$pimg?>" alt="image description"/>
													  </figure>
													 </a>												
												    <div class="sj-postcontent">
													<div class="sj-head" >
														<span class="sj-username"><a style='font-weight:bold;font-size:16px;'><?=$row2['article_type']?> Article<i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i></a>
													</span>
														<h3 style='margin-top:10px'><a   href="<?=base_url('paperinfo.php?journalPaperId='.$journalpaper_id)?>" ><b><?=$row2['title']?></b></a></h3>
													</div>
													<div class="sj-description">
													<p>Authors :<?=$row2['authors']?> </p>
															<p>DOI  :<a style='color:black' target='_blank' href="<?=$row2['doilink']?>"><?=$row2['doilink']?></a> </p>
													</div>
													 
													<a class="sj-btn" style='color:white;cursor:pointer' href="<?=base_url('paperinfo.php?journalPaperId='.$journalpaper_id)?>"  >View Full Article</a>
												</div>
											</article>
											   <?php
											   }
											   ?>
                                            </div>
                                          
                                            <div class="tab-pane fade" id="pills-ap" role="tabpanel" aria-labelledby="pills-home-tab">
											<?php
											    while(($row2=$stmt0->fetchAssociative())!==false){
												extract($row2);
											   ?>
											    <article class="sj-post sj-editorchoice">
												
												     <?php
													   if($row2['paperimage']!=""){
													   	   $pimg=base_url("PaperDirectory/Journal/$journal_abbri/press/").$row2['paperimage'];
														   
													   }
													   else{
														$pimg=base_url('upload/placeholder.jpg');
													   }
													   $fullpaper=base_url("PaperDirectory/Journal/$journal_abbri/press/").$row2['fullpaper'];
													  ?>	
													  <a href="<?=$pimg?>" target='_blank'>
														<figure class="sj-postimg">
															<img style='width:200px;height:200px' src="<?=$pimg?>" alt="image description">
														</figure>
												     </a>
												    <div class="sj-postcontent">
													<div class="sj-head">
														<span class="sj-username"><a style='font-weight:bold;font-size:16px'><?=$row2['article_type']?> Article <i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i></a>
													 </span>
														<h3><a href="<?=base_url('article-in-press-detail.php?press_id='.$row2['press_paper_id'])?>"><b><?=$row2['title']?></b></a></h3>
													</div>
													<div class="sj-description">
													<p>Authors :<?=$row2['authors']?> </p>
													 <p>DOI     :<a style='color:black' target='_blank' href="<?=$row2['doilink']?>"><?=$row2['doilink']?></a> </p>
													</div>
													<a class="sj-btn" style='color:white;cursor:pointer' href="<?=base_url('article-in-press-detail.php?press_id='.$row2['press_paper_id'])?>"  >View Full Article</a>
												 </div>
											 </article>
											   <?php
											   }
											   ?>
                                            </div>
                                            <div class="tab-pane fade" id="pills-md" role="tabpanel" aria-labelledby="pills-home-tab">
											<?php
											   
											   if($view_range_from!=""){
												   $sql2= "SELECT jp.*,i.*,ar.article_type 
												   FROM journalpaper jp 
												   LEFT JOIN issue i ON i.issue_id=jp.issue_id 
												   LEFT JOIN article_type ar ON ar.article_type_id=jp.article_type_id 
												   where i.journals_id=$journals_id 
												   and  jp.is_publish='1' and (DATE(jp.`datetime`) BETWEEN '$download_range_from' AND '$download_range_to' ) order by jp.download_count DESC limit 10";
											   }
											   else{
													   $sql2= "SELECT jp.*,i.*,ar.article_type 
													   FROM journalpaper jp 
													   LEFT JOIN issue i ON i.issue_id=jp.issue_id 
													   LEFT JOIN article_type ar ON ar.article_type_id=jp.article_type_id 
													   where i.journals_id=$journals_id 
													   and  jp.is_publish='1'  order by jp.download_count DESC limit 10";

												 }
												   
												   //echo $sql2;
												   $stmt2 = $conn->query($sql2);
												   while(($row2=$stmt2->fetchAssociative())!==false){
												   extract($row2);
												  ?>
												  <article class="sj-post sj-editorchoice">
												  
														<?php
														  if($row2['paperimage']!=""){
														   $m=$month+1;
														   if($row2["record_type"]=="NEW"){
															$pimg=base_url("PaperDirectory/Journal/$journal_abbri/$year/$m/").$row2['paperimage'];
														   }
														   else{
															   $pimg=$row2["paperimage"];
														   }
														  }
														  else{
														   $pimg=base_url('upload/placeholder.jpg');
														  }
														  ?>	
													   <a href="<?=$pimg?>" target='_blank'>
													    <figure class="sj-postimg">	
													      <img style='width:200px;height:200px' src="<?=$pimg?>" alt="image description">
													    </figure>
													  </a>
												     <div class="sj-postcontent">
													    <div class="sj-head">
														  <span class="sj-username"><a style='font-weight:bold;font-size:16px'><?=$row2['article_type']?> Article<i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i></a>
													    </span>
													    <h3><a  href="<?=base_url('paperinfo.php?journalPaperId='.$journals_id)?>"><b><?=$row2['title']?></b></a></h3>
													   </div>
													   <div class="sj-description">
													   <p>Authors :<?=$row2['authors']?> </p>
													    <p>DOI  :<a style='color:black' target='_blank' href="<?=$row2['doilink']?>"><?=$row2['doilink']?></a> </p>
													   </div>
													   <a class="sj-btn" href="<?=base_url('paperinfo.php?journalPaperId='.$journals_id)?>"> View Full Article</a>
												   </div>
											      </article>
												  <?php
												  }
												  ?>
										   </div>
                                            <div class="tab-pane fade" id="pills-mv" role="tabpanel" aria-labelledby="pills-home-tab">
											  <?php
											   
												if($view_range_from!=""){
													$sql2= "SELECT jp.*,i.*,ar.article_type 
													FROM journalpaper jp 
													LEFT JOIN issue i ON i.issue_id=jp.issue_id 
													LEFT JOIN article_type ar ON ar.article_type_id=jp.article_type_id 
													where i.journals_id=$journals_id 
													and  jp.is_publish='1' and (DATE(jp.`datetime`) BETWEEN '$view_range_from' AND '$view_range_to' ) order by jp.views_count DESC limit 10";
												}
												else{
														$sql2= "SELECT jp.*,i.*,ar.article_type 
														FROM journalpaper jp 
														LEFT JOIN issue i ON i.issue_id=jp.issue_id 
														LEFT JOIN article_type ar ON ar.article_type_id=jp.article_type_id 
														where i.journals_id=$journals_id 
														and  jp.is_publish='1'  order by jp.views_count DESC limit 10";

											      }
											       $stmt2 = $conn->query($sql2);
												    while(($row2=$stmt2->fetchAssociative())!==false){
													extract($row2);
												   ?>
												   <article class="sj-post sj-editorchoice">
													
														 <?php
														   if($row2['paperimage']!=""){
															$m=$month+1;
															if($row2["record_type"]=="NEW"){
															 $pimg=base_url("PaperDirectory/Journal/$journal_abbri/$year/$m/").$row2['paperimage'];
															}
															else{
																$pimg=$row2["paperimage"];
															}
														   }
														   else{
															$pimg=base_url('upload/placeholder.jpg');
														   }
														   ?>	
														<a href="<?=$pimg?>" target='_blank'>
															 <figure class="sj-postimg">
																<img style='width:200px;height:200px' src="<?=$pimg?>" alt="image description">
													    	</figure>
														</a>
												    	<div class="sj-postcontent">
														<div class="sj-head">
															<span class="sj-username"><a style='font-weight:bold;font-size:16px'><?=$row2['article_type']?> Article<i style='color:#2dc12d;margin-left:10px' class='fas fa-lock-open'></i></a>
														 </span>
															<h3><a  href="<?=base_url('paperinfo.php?journalPaperId='.$journals_id)?>"><b><?=$row2['title']?></b></a></h3>
														</div>
														<div class="sj-description">
														<p>Authors :<?=$row2['authors']?> </p>
																<p>DOI  :<a style='color:black' target='_blank' href="<?=$row2['doilink']?>"><?=$row2['doilink']?></a> </p>
														</div>
														<a class="sj-btn" href="<?=base_url('paperinfo.php?journalPaperId='.$journals_id)?>"> View Full Article</a>
													 </div>
												 </article>
												   <?php
												   }
												   ?>

                                            </div>

                                            <div class="tab-pane fade" id="pills-mc" role="tabpanel" aria-labelledby="pills-home-tab">
											
                                            </div>
                                          
                                        </div>
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
<script>
	function show_info_modal(h,i){
		burl="ajax/get_journal_data.php"; 
		jid="<?=$journals_id?>";
		$.post(burl,{"jid":jid},function(data,status){
			    obj=JSON.parse(data);
				dis="";
				title=h;
				if(i==1){
				  dis=obj["latest_info"];
				}
				else if(i==2){	
				  dis=obj["article_press_info"];
				}
				else if(i==3){
				  dis=obj["most_download_info"];
				}
				else if(i==4){
				  dis=obj["most_view_info"];
				}
				else if(i==5){
					dis=obj["most_cite_info"];
				}
				$("#info_h").html(title);
				$("#info_").html(dis);
				$("#info_modal").modal('show');
		}); 
	}


	function view_more(){
		text=$("#view_action").text();
	    <?php
          $j_full = preg_replace("/[\r\n]*/","",$journal_about);
		  $j_half= preg_replace("/[\r\n]*/","",$short);

		?>
		about_full="<?=$j_full?>";
		if(text=="More"){
			text=="Hide";
			$("#view_action").text("Hide");
			$("#dot").addClass("hidden");
			$("#jabout").text(about_full);
		 }
		else{
			text="More";
			$("#view_action").text(text);
			$("#dot").removeClass("hidden");
			$("#jabout").text("<?=$j_half?>");
		}
		$("#cntaint").toggleClass("hidden");
		//$("#view_action").toggleClass("btn-info");
	}


	function open_image(l){
      alert();
	}
</script>