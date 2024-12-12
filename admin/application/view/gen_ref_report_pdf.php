<?php
// Include the Composer autoloader
require_once(__DIR__ . '/../../../vendor/autoload.php');
 

use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>