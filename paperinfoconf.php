
<?php
           include "header.php";
           extract($_REQUEST);
           $ReadPDFPages = new ReadPagesFromPDFFIle();

           $sql = "select * from confpaper where confpaperId=$confpaperid";
           $stmt = $conn->query($sql);
           $i=1;
           $detail=$stmt->fetchAssociative();
           extract($detail);

           ?>

		  
<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				<div id="sj-twocolumns" class="sj-twocolumns">
					<div class="container">
						<div class="row">
                            
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                               <div id="sj-content" class="sj-content">
                                 <ul class="sj-downloadprint">
                                    <li><a class='btn btn-sm' style='background-color:gray'  href="javascript:history.back();"><i style='color:white' class="fa fa-reply"></i><span style='color:white'>Back</span></a></li>
                                  </ul>
                                    <table class='table' border='0'>
                                         <tbody>
                                          <tr>
                                            <td colspan="3"  style='text-align:right'>
                                                <a class='btn btn-info btn-sm' href="<?php print($detail['fullPaper']); ?>" onclick=" " target="_blank"><i class='fa fa-file-pdf-o'></i> Full-Text PDF</a><br/>
                                                <a href="<?php print($detail['doiLink']); ?>" target="_blank"><?php isset($detail['doi'])?print($detail['doi']):print(''); ?></a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="left_font" width="15%">Paper Title</td>
                                            <td>:</td>
                                            <td style="font-size:15px; font-family:'Times New Roman', Times, serif;text-align:left;color:black"><strong><?php isset($detail['tittle']) ? print($detail['tittle'])  : ''; ?></strong></td>
                                            </tr>
                                            <tr>
                                            <td class="left_font" width="15%">Author Name</td>
                                            <td>:</td>
                                            <td style="font-size:15px; font-family:'Times New Roman', Times, serif;text-align:left;color:black"><?php isset($detail['author']) ? print($detail['author'])  : ''; ?></td>
                                            </tr>
                                            <tr>
                                            <td class="left_font" width="15%">Abstract</td>
                                            <td>:</td>
                                            <td style="font-size:15px; font-family:'Times New Roman', Times, serif;text-align:left;color:black"><?php isset($detail['abstract']) ? print($detail['abstract'])  : ''; ?></td>
                                            </tr>
                                            <tr>
                                            <td class="left_font" width="15%">Keywords</td>
                                            <td>:</td>
                                            <td style="font-size:15px; font-family:'Times New Roman', Times, serif;text-align:left;color:black"><?php isset($detail['keyword']) ? print($detail['keyword'])  : ''; ?></td>
                                            </tr>

                                            <tr>
                                            <td style="font-size: 18px;font-weight: bold;color:black">Cite this article</td>
                                            <td>:</td>
                                            <td style="font-size:15px; font-family:'Times New Roman', Times, serif;text-align:left;color:black">
                                                <?php print ($detail['author'] . ' " ' . $detail['tittle'] . ' " '); ?>
                                              
                                                ,<?php print "Page No : " . $_REQUEST['pageno'] . "."; ?> 
                                            <?php print($detail['doi']); ?>
                                            </td>
                                            </tr>
                                         </tbody>
                                    </table>
                                </div>   
							</div>
						</div>
					</div>
				</div>
			</main>
			 
            <?php
            include "footer.php";
            ?>
		 


 