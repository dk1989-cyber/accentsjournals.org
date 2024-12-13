     <?php
         session_start();
         require_once '../../../vendor/autoload.php';
         require_once "../../../config/config.php";
          if(isset($_SESSION["uniqid"])){
            $uniqid=$_SESSION["uniqid"];
             ?>
              <?php
                     if(isset($_SESSION["uniqid"])){
                      $uniqid=$_SESSION["uniqid"];
                      $sql = "select * from ref_gen where unique_id='$uniqid'";
                      $stmt = $conn->query($sql);
                      $i=1;
                     
                      $typs[]=array();
                      while(($row=$stmt->fetchAssociative())!==false){
                         extract($row);
                          
                         $articles[] =$title;
                         if($row['type']=="OTHERS"){
                          ?>
                           <p style='color:purple' >[<?=$i?>]. <?=$reffrence?> </p>
                         <?php
                         }
                         else{

                          if($is_original=="YES"){
                            if($duplication==""){
                            ?>
                          <p style='color:green' >[<?=$i?>]. <?=$reffrence?> </p>
                            <?php
                            }
                            else{
                           ?>
                              <p  style='color:orange'>[<?=$i?>]. <?=$reffrence?></p>
                           <?php
                            }
                         }
                         else{
                          ?>
                           <p style='color:red'>[<?=$i?>].<?=$reffrence?></p>
                          <?php
                         }
                         }
                        $i=$i+1;
                     }
                    }
                     ?>
        
                  <table cellspacing="0" cellpadding="1" border="1" width="100%" >
                    <tr>
                        <th colspan='2' style='text-align:center'>
                            Year wise Paper
                        </th>
                      </tr>
                      <tr style="color:white;background-color:grey">
                          <th style='width:70%;text-align:center'>Year</th>
                          <th>No of Paper</th>
                      </tr>
                        <?php
                                  $sql = "select type,year,count(*) as count from ref_gen where unique_id='$uniqid' group by year";
                                  $stmt = $conn->query($sql);
                                  while(($row=$stmt->fetchAssociative())!==false){
                                    extract($row);
                                  ?>
                                  <tr>
                                      <td style='text-align:center'><?=($year!="")?$year:"Not Found"?></td>
                                      <td style='text-align:center'><?=$count?></td>
                                    </tr>
                                  <?php
                                  }
                                ?>   
           </table>            
           <table cellspacing="0" cellpadding="1" border="1" width="100%" >
              <tr style="color:white;background-color:grey">
                  <th style='text-align:center;width:90%'> Title </th>
                  <th style='text-align:center'>Duplicate</th>
              </tr>
              <?php
                      $firstOccurrence = [];
                      $relations = [];

                      $i=0;
                      foreach ($articles as $index => $article) {

                        if (!isset($firstOccurrence[$article])) {
                            // First time we see this string, mark its index
                            $firstOccurrence[$article] = $index;
                            $relations[$index] = []; // Initialize an empty array for relations
                        } else {
                            // String is a duplicate, link to the original
                            $originalIndex = $firstOccurrence[$article];
                            $relations[$originalIndex][] = $index;

                        }

                      $i=$i+1;
                      }
                    
                        foreach ($relations as $originalIndex => $duplicates) {           
                         $right_position =$originalIndex+1;
                         $original=($right_position).":".$articles[$originalIndex];
                        ?>
                        <tr>
                          <td style='text-align:left;padding-left:10px'><?=$original?></td>
                          <td style='text-align:center'>
                          <?php
                          if (!empty($duplicates)) {
                            foreach ($duplicates as $duplicateIndex) {
                               
                               $rightduplicate=$duplicateIndex+1;
                               echo "<b style='color:red'>$rightduplicate,</b>"; 

                            }
                          }
                          else{
                              echo "Not Found";
                          }
                          
                          ?>
                          </td>
                        </tr>
                        <?php
                         }
                        ?>
            </table>
               <table cellspacing="0" cellpadding="1" border="1" width="100%" style="margin-top:10px" >
                      <tr style="color:white;background-color:grey">
                            <th style='text-align:center;width:70%'> Journal </th>
                            <th style='text-align:center'>No of Reffrence</th>
                      </tr>
                        <?php
                          $uniqid=$_SESSION['uniqid'];
                          $sql2="SELECT COUNT(*) as no_reff,journal_name from ref_gen where unique_id='$uniqid' and journal_name!='' GROUP by Journal_name";
                          $stmt = $conn->query($sql2);
                          $i2=1;
                          while(($row=$stmt->fetchAssociative())!==false){
                            extract($row);
                        ?>
                          <tr>
                            <td style='text-align:left;padding-left:10px;width:70%'><?=$journal_name?></td>
                            <td style='text-align:center'><?=$no_reff?></td>
                          </tr>
                        <?php
                         }
                        ?>
                 </table>   


                <table cellspacing="0" cellpadding="1" border="1" width="100%"  style='margin-top:10px'>
                     <tr style="color:white;background-color:grey">
                        <th style='text-align:center;width:70%'>Author Names </th>
                        <th style='text-align:center'>Reffrence</th>
                      </tr>
                        <?php
                          $uniqid=$_SESSION['uniqid'];
                          $sql2="SELECT * from gen_authors where uniqid='$uniqid'";
                          $stmt = $conn->query($sql2);
                          $i2=1;
                          while(($row=$stmt->fetchAssociative())!==false){
                            extract($row);
                        ?>
                        
                          <tr>
                            <td style='text-align:left;padding-left:10px;width:70%'><?=$author_name?></td>
                            <td style='text-align:center'>
                                   <?php
                                    $autho_id=$row['gen_authors_id'];
                                    $q5="select refa.*,ref.position from ref_gen_author refa 
                                    LEFT JOIN  ref_gen ref ON refa.ref_gen_id=ref.ref_gen_id WHERE refa.gen_authors_id='$autho_id' and ref.unique_id='$uniqid'";
                                    $ath_="";
                                    $stmt5 = $conn->query($q5);
                                    while(($row6=$stmt5->fetchAssociative())!==false){
                                      extract($row6);
                                      $po=$position+1;
                                      $ath_.=$po.",";
                                    }
                                    echo $ath_;
                                  ?>
                            </td>
                          </tr>
                        <?php
                         }
                        ?>
            </table>  
                   
          <table  border="1" style='margin-top:10px'>
              <thead>
                <tr>     
                    <th>Srno</th>
                    <th>Reffrence</th>
                    <th>Type</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $uniqid=$_SESSION['uniqid'];
                 $sql2="select * from ref_gen where unique_id='$uniqid'";
                 $stmt = $conn->query($sql2);
                 $i2=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                ?>
                <tr>
                    <td><?=$i2?></td>
                    <td><?=$reffrence?></td>
                    <td><?=$type?></td>
                </tr>
                <?php
                $i2=$i2+1;
                }
                ?>
             </tbody> 
          </table>
               
   <?php
   }
    ?>
    
      
 