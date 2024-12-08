
<?php
           include "header.php";
           extract($_REQUEST);
           $ReadPDFPages = new ReadPagesFromPDFFIle();
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
                                     <table style='width:100%'>
                                        <thead>
                                            <tr style='background-color:gray;color:white'>
                                                <th>S.No.</th>
                                                <th style='width:50%'>Title</th>
                                                <th  style='width:30%'>Author</th>
                                                <th>Pages</th>
                                                
                                                <th><i class='fa fa-download'></i></th>
                                                <th>G. Scholar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sql = "select * from confpaper where confrenceid=$confrenceid";
                                            $stmt = $conn->query($sql);
                                            $i=1;
                                            while(($row=$stmt->fetchAssociative())!==false){
                                                extract($row);
                                               
                                                $pdfPages = $ReadPDFPages->getNumPagesPdf($row['fullPaper']);
                                                if ($i <= 1) {
                                                    $start = 1;
                                                    $end = $pdfPages;
                                                } else {
                                                    $start = $end + 1;
                                                    $end = $end + $pdfPages;
                                                }
                                                $pg=$start.'-'.$end;
                                            ?> 
                                            <tbody>
                                                <tr style='color:black'>
                                                    <td><?=$i?></td>
                                                    <td><a href="<?=base_url('paperinfoconf.php?confpaperid='.$confpaperid.'&pageno='.$pg)?>"><?=$tittle?></a></td>
                                                    <td><?=$author?></td>
                                                    <td><?=$pg?></td>
                                                    <td style='width:5%'><a  href="<?php print($row['fullPaper']); ?>" target='_blank'><i class='fa fa-file-pdf-o'></i></a></td>
                                                    
                                                    <td align="center"><a href="http://scholar.google.co.in/scholar?hl=en&q=<?php print($row['tittle']); ?>&btnG=" target="_blank"><u><i class='fa fa-link'></i></u></a></td>
                                                </tr>
                                            </tbody>
                                            <?php
                                            $i=$i+1;
                                            }
                                            ?>
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
		 


 