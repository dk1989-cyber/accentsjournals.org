<?php
include "basic/admin_header.php";
$dt=array( 
            ["title"=>"PES","url"=>"journal_content.php","type"=>"PES","index"=>0],
            ["title"=>"LES","url"=>"journal_content.php","type"=>"LES","index"=>1],
            ["title"=>"ABOUT US","url"=>"journal_content.php","type"=>"ABOUT","index"=>2],
            ["title"=>"AIM & SCOPE","url"=>"journal_content.php","type"=>"AIM","index"=>3],
            ["title"=>"AUTHOR GUIDE","url"=>"journal_content.php","type"=>"GUIDE","index"=>4],
            ["title"=>"SUBMIT","url"=>"journal_content.php","type"=>"SUBMIT","index"=>5],
            ["title"=>"ANNOUCE","url"=>"journal_content.php","type"=>"ANNOUNCE","index"=>6],
            ["title"=>"CALL FOR PAPER","url"=>"journal_content.php","type"=>"CALL","index"=>7],
            ["title"=>"PUB. CHARGES","url"=>"journal_content.php","type"=>"CHARGES","index"=>8],
            ["title"=>"PUB. POLICY","url"=>"journal_content.php","type"=>"PUBLICATION_POLICY","index"=>9],
            ["title"=>"ABS. AND INDEXING","url"=>"journal_content.php","type"=>"INDEXING","index"=>10],
            ["title"=>"OPEN ACESS OPTION","url"=>"journal_content.php","type"=>"OPEN_OPTION","index"=>11],
            ["title"=>"OPEN ACESS POLICY","url"=>"journal_content.php","type"=>"OPEN_POLICY","index"=>12],
            ["title"=>"Review Process","url"=>"journal_content.php","type"=>"REVIEW_PROCESS","index"=>13],
            ["title"=>"NEWS","url"=>"journal_content_news.php","type"=>"NEWS","index"=>14],
            ["title"=>"EDITORIAL BOARD","url"=>"journal_content_editorial_board.php","type"=>"BOARD","index"=>15],
            ["title"=>"E. BOARD CONTENT","url"=>"journal_content_editorial_board_content.php","type"=>"BOARD","index"=>16],
);

?>

<div class="mainpanel">
<div class="contentpanel">
  <?php
  extract($_REQUEST);
  $sql = "SELECT * FROM journals where journals_id='$id'";
  $stmt = $conn->query($sql);
  $row=$stmt->fetchAssociative();
  extract($row);
  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Journal Content for <?=$journal_abbri?> </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Journal Content for <?=$name?> (<?=$journal_abbri?>)</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
        <div class="row panel-quick-page">
             <?php
              for($i=0;$i<count($dt); $i++){
             ?>
                <a href="<?=$dt[$i]['url']?>?type=<?=$dt[$i]["type"]?>&t=<?=$dt[$i]['title']?>&id=<?=$id?>&index=<?=$dt[$i]['index']?>"><div class="col-xs-3 col-sm-3 col-md-3 page-user" style='margin-top:2px'>
                    <div class="panel">
                       
                        <div class="panel-body" style='padding-top:10px'>
                        <div class="page-icon"><i class="fa fa-navicon"></i></div>
                        </div>
                        <div class="panel-heading">
                        <h3 class="panel-title"><?=$dt[$i]['title']?></h3>
                        </div>
                    </div>
                </div></a>
             <?php
               }
             ?>
        </div>
        </div><!-- panel -->
     </div>
    </div><!-- col-sm-6 -->
    
  </div><!-- row -->

</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?>
