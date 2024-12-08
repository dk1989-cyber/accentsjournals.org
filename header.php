<?php
include 'vendor/autoload.php';
include "config/config.php";
include_once 'service/ReadPagesFromPDFFIle.php';
?>
<!doctype html>
 
<html class="no-js" lang="zxx"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 
	<title>Accent Journal</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/fontawesome/fontawesome-all.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/dashboard.css">
	<link rel="stylesheet" href="css/chartist.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/transitions.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="https://theaccents.org/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://theaccents.org/assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link rel="stylesheet" href="<?=base_url('admin/dist/bootstrap-tagsinput.css')?>">

	<style>
	.toolip:hover .tooltiptext {
		visibility: visible;
	}

	p{
		text-align: justify;
	}
	
	strong{
		text-align:justify;
	}

    .content{
		padding:20px;
		max-height:900px;
		overflow:auto;  
		overflow-x: hidden;
	
	}

	.content div{
		color:black;
		font-size:16px;
	}

	select option{
		padding:3px !important;
		border-bottom:1px solid gray !important;
	}
	.content p,.content li,.content span{
		font-size:16px !important;
		color:black;
		line-height:20px;
		text-align:justify !important;
	}
	.content ul{
		padding-left:40px !important;
		margin-bottom:10px;
	}
	.content li{
		margin-bottom:5px !important;
	}
	.content p,.content span{
		margin-bottom:10px !important;
	}
	h3>span{
		font-size:18px;
	}
	.toolip{
    color: #c3c3c3;
    font-size: 15px;
    bottom: 2px;
    position: relative;
    display: inline-block;
	}	
	
	.toolip .tooltiptext {
			visibility: hidden;
			background-color: #fff;
			color: #000;
			text-align: left;
			padding: 5px 0;
			position: absolute;
			top:-50px;
			z-index: 999;
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
			width:300px;
         }
		.lblj{
			display:block;
			margin:0px;
			line-height:20px;
		}
		.msg-block{
			border-radius:10px;
			height:50px;
			padding:5px;
			margin:10px;
			padding-top:10px !important;

	
		}
		.success{
			border: 1px solid #50c76c;
			background-color:#ccffd8;
		}
		.error{
			border: 1px solid #f54554;
			background-color:#ffdcdf;
		}
		
		.side_data{
			text-align:center;
		}
		.blck{
			border: 1px solid #efefef;
    margin: 0px;
    text-align: center;
    /* background-color: #efefef; */
    width: 100%;
    /* display: block; */
    display: flex;
		}
		.dispheader:after{
			/* content:'';
			position: relative;
			background-color: pink;
			width: 30%;
			height: 3px;
			bottom: 0;
			left:0; */
		}
		.j_menu{
			color:#325e87;
		}
		.j_menu i{
			float:right;
		}
		.nav-link{
			padding:5px;
		}
		body{
			font-family:'times new roman'
		}
		.card{
			border:0px;
		}
		.nav-pills .nav-link{
			border-radius:0px;
		}
		.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
			color: #020202 !important;
			font-weight: bold !important;
			border-bottom: 2px solid black;
		}

	  body{
        font-family: "times new roman !important";
	  }


		.blockjournal{
		width:100%;
		height:100%;
		display:flex;
		align-items:center;
		flex-direction:column;
		padding:20px;
		}

		.blockjournal h4{
			font-weight:bold;
			color:black;
		}

		.btnmy{
			border-radius:50px;
			background-color:#608fb1;
			color:white;

		}

	.blockhead{
	width:100%;
	height:100%;
	display:flex;
	align-items:center;
	flex-direction:column;
	border-radius:10px;
	box-shadow:0px 0px 5px #d7d9d6;
	padding:50px;
	}
	.blockhead h4{
		font-size:18px;
		margin-top:10px;
		font-weight:400;
		font-weight:bold;
	}
	.blockhead a{
		text-align:center;
	}
	#blockhead1{
		background-color: #f2fff1;
	}
	#blockhead2{
		background-color:#ffede6;
	}
	#blockhead3{
		background-color:#e7e6ff;
	}
	#blockhead4{
		background-color:#fff4d2;
	}

	#toph{
		/* background-image:linear-gradient(90deg, #d9dadb 0%, #494952 100%); */
		/* background-image:linear-gradient(90deg, #ab4374 0%, #3838a9 100%); */
		background-color: #5e81a5;
	}
	.sj-innerbanner{
		/* background-image:url('images/topimg.jpg'); */
		background-position: center center;
		background-repeat: no-repeat;
		background-size: cover;
		padding:20px;
		box-sizing: border-box;
		background-color:#b5b5b5;
	}

	.sj-breadcrumb a{
		color:#0c5c8d;
		font-size:16px;
	}

	.lbl{
		font-size:16px;
		 display:block;
	}

	.lbl2{
		font-size:18px;
		font-weight:bold;
		margin-top:-10px;
		display:block;

	}

	.journal_row{
		background-color: #f9f9f9;
    padding: 10px;
    box-shadow: 0px 10px 2px #efefef;
    border: 1px solid #efefef;
	}
     .req{
		color:red;
		font-weight:bold;
	 }
	 .blckleft{
		padding:10px;display:flex;flex-direction:column;flex:1;justify-content: center;
		font-size: 18px;
		background-color:#efefef;
	 }
	 .blckright{
		flex: 2;
		padding: 4px;
		display: flex;
		flex-direction: column;
		background-color: #efefef;
	 }
	 .blckright>.lblv {
		font-size:18px;
	 }

	 .page-item.active .page-link{
		z-index: 1;
		color: #fff;
		background-color: #a4a4a5 !important;
		border-color: #5e656c !important;
	 }
	 .div.dataTables_wrapper div.dataTables_paginate ul.pagination{
		margin-bottom:100px !important; 
	 }

	 .hidden{
		display:none;
	 }

	 .left_font{
		font-weight:bold;
		font-size:18px;
		color:black;
	 }

	</style>
</head>
<body class="sj-home">
 <!-- <div class="preloader-outer">
		<div class='loader'>
		    <img src="https://via.placeholder.com/100x100" alt="">
		</div>
	</div> -->
	 <div id="sj-wrapper" class="sj-wrapper">
    	<div class="sj-contentwrapper">
		 <header id="sj-header" class="sj-header sj-haslayout">
			<!-- <div class="container-fluid" id='toph'>
			    <div class="container">
				   <div class="row" style="padding:10px" >
						 <div class="col-md-6" >
							 <p style='color:white;padding-top:4px;padding-bottom:2px;font-size:20px;font-weight:bold;margin:0px'><i class='lnr lnr-envelope'></i>mail@theaccents.org</p>
						 </div>
						 <div class="col-md-6" >
							 <p style='color:white;padding-top:4px;padding-bottom:2px;font-size:20px;font-weight:bold;margin:0px;text-align:right'><i class='lnr lnr-phone'></i>91-755-4926968</p>
						 </div>
					</div>
				   </div>
			</div> -->
				<div class="container">
				   
					<div class="row">
						
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							 
							<div class="sj-navigationarea">
								<strong class="sj-logo" style='text-align:center'><a href="#">
								  <img style='width:50%;margin:auto' src="images/logo_.png" alt=""></a>
							     <span style='font-size:25px'>  ACCENTS Journals</span>
								 <span style='display:block;margin-top:-8px'>A Unit of ACCENTS</span>
							   </strong>
								<div class="sj-rightarea">
									<nav id="sj-nav" class="sj-nav navbar-expand-lg">
										<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
											<i class="lnr lnr-menu"></i>
										</button>
										<div class="collapse navbar-collapse sj-navigation" id="navbarNav">
											<ul>
												<li class='menus' style="margin:4px;color: white;">
													<a href="index.php"> <i style='margin-right:4px' class="lnr lnr-home"></i>Home</a>
												</li>
												<li class="menu-item-has-children page_item_has_children"  style="margin:4px;color: white;">
													<a href="our-journals.php">Journals</a>
													<ul class="sub-menu">
														<?php
														$sql = "SELECT journals_id,journal_abbri FROM journals";
														$stmt = $conn->query($sql);
														$i=1;
														while(($row=$stmt->fetchAssociative())!==false){
															extract($row);
														?>
														<li><a href="journals.php?journalsId=<?=$journals_id?>"><?=$journal_abbri?></a></li>
														<?php
														}
														?>
													</ul>
												</li>

												<li class="menu-item-has-children page_item_has_children"  style="margin:4px;color: white;">
													<a href="#">ADL</a>
													<ul class="sub-menu">
													<li><a href="adl.php">Search By Journal</a></li>
													<li><a href="searchbycontent.php">Search By Content</a></li>
												  </ul>
												</li>
												
												<!-- <li class='menus'  style="margin:4px ;color: white;">
													<a href="conference.php"> <i style='margin-right:4px' class="lnr lnr-calendar-full"></i>Conference</a>
												</li> -->
												<!-- <li class='menus'  style="margin:4px;color: white;">
													<a href="contact.php"> <i style='margin-right:4px' class="lnr lnr-envelope"></i>Contact Us</a>
												</li> -->
											</ul>
										</div>
									</nav>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			
