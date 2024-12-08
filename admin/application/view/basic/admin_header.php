<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";


if(!isset($_SESSION['id'])){
  header("refresh:0;url=".base_url("admin/"));
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="<?=base_url('admin/lib/Hover/hover.css')?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" integrity="sha512-XJ3ntWHl40opEiE+6dGhfK9NAKOCELrpjiBRQKtu6uJf9Pli8XY+Hikp7rlFzY4ElLSFtzjx9GGgHql7PLSeog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?=base_url('admin/lib/weather-icons/css/weather-icons.css')?>">
  <link rel="stylesheet" href="<?=base_url('admin/lib/ionicons/css/ionicons.css')?>">
  <link rel="stylesheet" href="<?=base_url('admin/lib/jquery-toggles/toggles-full.css')?>">
  <link rel="stylesheet" href="<?=base_url('admin/lib/morrisjs/morris.css')?>">
  <link rel="stylesheet" href="<?=base_url('admin/css/quirk.css')?>">

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="<?=base_url('admin/lib/jquery.gritter/jquery.gritter.css')?>">
  
  <link rel="stylesheet" href="<?=base_url('admin/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')?>">
  <script src="<?=base_url('admin/lib/modernizr/modernizr.js')?>"></script>

  <link rel="stylesheet" href="<?=base_url('admin/dist/bootstrap-tagsinput.css')?>">
  <link rel="stylesheet" href="https://theaccents.org/assets/backend/plugins/select2/css/select2.min.css">
 
  
 <style>
   .select2-container--default .select2-selection--single{
			height:36px !important;
	 }	
  .q_l{
    font-size: 14px;
  margin-bottom: -5px;
  }

  .q_lv{

  display:block !important;
  font-size:16px;
  font-weight:bold;
  }
  .names {text-transform:capitalize !important;}
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #0e0e0e !important;
   }
  body{
    font-family:'times new roman' !important;
  }
  .req{
    color:red;
  }
  .lbl{
    font-size:14px;
    font-weight:bold;
  }
  .bootstrap-tagsinput{
    width:100%;
  }
 </style> 
</head>
<body>
<header>
  <div class="headerpanel">
    <div class="logopanel">
      <h2><a href="#">Accent Journal</a></h2>
    </div><!-- logopanel -->

    <div class="headerbar">

      <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
 

      <div class="header-right">
        <ul class="headermenu">
           
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-logged" data-toggle="dropdown">
                <img src="../images/photos/loggeduser.png" alt="" />
                Hello <?=$_SESSION['name']?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu pull-right">
                <li><a href=""><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
               
                <li><a href="../action/logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
          
        </ul>
      </div><!-- header-right -->
    </div><!-- headerbar -->
  </div><!-- header-->
</header>

<section>

  <div class="leftpanel">
    <div class="leftpanelinner">

      <!-- ################## LEFT PANEL PROFILE ################## -->

      <div class="media leftpanel-profile">
        <div class="media-left">
          <a href="#">
            <img src="https://via.placeholder.com/10x10" alt="" class="media-object img-circle">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading"> <?=$_SESSION['name']?><a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
         
        </div>
      </div><!-- leftpanel-profile -->

       
    <div class="tab-content">
        <!-- ################# MAIN MENU ################### -->
          <div class="tab-pane active" id="mainmenu">
            <?php
             if($_SESSION['type']=="SUPER"){
              $sql = "SELECT * FROM `menu` where status='Enable'";
              $stmt = $conn->prepare($sql);
              $resultSet = $stmt->executeQuery();
             ?>
              <ul class="nav nav-pills nav-stacked nav-quirk">
              <?php
              while (($row = $resultSet->fetchAssociative()) !== false) {
              ?> 
                  <li class="nav-parent"><a href="<?=$row['menu_url']?>"><i class="fa fa-suitcase"></i> <span><?=$row['menu_name']?></span></a>
                  <ul class="children">
                    <?php
                    extract($row);
                    $menu_id=$menu_id;
                    $q2="select * from sub_menu where menu_id='$menu_id'";
                    $stmt = $conn->prepare($q2);
                    $resultSet2 = $stmt->executeQuery();
                    while (($row2 = $resultSet2->fetchAssociative()) !== false) {
                      extract($row2);
                      ?>
                      <li><a href="<?=base_url($url)?>"><?=$sub_menu_name?></a></li>
                      <?php
                      }
                      ?>
                  </ul>
                </li>
            <?php
               }
            ?>
          </ul>
          <?php
             }
            else
            { 
            ?>
            <ul class="nav nav-pills nav-stacked nav-quirk">
            <?php 
            $mid=$_SESSION['menu_id'];
            $sid=$_SESSION['submenu_id'];
            
            
            if($mid!=""){
            
            $q="select * from menu where status='Enable' and menu_id IN ($mid)";
  
            $stmt_ = $conn->prepare($q);
            $resultSet_ = $stmt_->executeQuery();
            while (($row_= $resultSet_->fetchAssociative()) !== false) { 
                  extract($row_);
                 ?>
                  <li class="nav-parent"><a href="#"><i class="fa fa-suitcase"></i> <span><?=$menu_name?></span></a>
                   <ul class="children">
                     <?php
                    $q2="select * from sub_menu where  status='Enable' and menu_id=$menu_id and sub_menu_id IN ($sid)";
                    $stmt3 = $conn->prepare($q2);
                    $resultSet3 = $stmt3->executeQuery();
                    while (($row3= $resultSet3->fetchAssociative()) !== false) {
                      extract($row3);
                     ?>
                    <li><a href="<?=base_url($url)?>"><?=$sub_menu_name?></a></li>
                    <?php
                    }
                    ?>
                    </ul>
                  </li>
                <?php
                }
            }
            }
            ?>
             <ul class="nav nav-pills nav-stacked nav-quirk">
               <li class="nav-parent"><a href="#"><i class="fa fa-suitcase"></i> <span>Others</span></a>
                     <ul class="children">
                      <li><a href="menu-generate.php">Create Menu</a></li>
                      <li><a href="copy-menu.php">Copy Menu</a></li>
                    </ul>
                  </li>
              </ul>
        </div><!-- tab-pane -->
      </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
