<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$q="select u.*,university,c.name as cntry,s.name as st,ci.name as ct from ad_university u
LEFT JOIN country c ON c.country_id=u.country
LEFT JOIN states s ON s.states_id=u.ustate
LEFT JOIN cities ci ON ci.cities_id=u.ucity
where u.status='Enable' order by u.`university` ASC";
$stmt = $conn->query($q);
$i=1;
while(($row=$stmt->fetchAssociative())!==false){
    extract($row);
    ?>
    <option value="<?=$ad_university_id?>"><?=ucfirst($university)?>/<?=$ct?>/<?=$st?>/<?=$cntry?> </option>
<?php
}
?>