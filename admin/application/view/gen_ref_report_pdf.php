<?php
ini_set('memory_limit', '512M');
require_once(__DIR__ . '/../../../vendor/autoload.php');
ob_start();
include "refference_check_pdf.php";
$pageOutput = ob_get_clean();
 
 
use Dompdf\Dompdf;
use Dompdf\Options;
$dompdf = new Dompdf();
$dompdf->loadHtml($pageOutput);

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('debugPng', true);      // Debug PNG images
$options->set('debugKeepTemp', true); // Keep temporary files for debugging
$options->set('debugCss', true);     // Debug CSS rendering

file_put_contents('debug.html', $pageOutput);

$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
 
$dompdf->stream('document.pdf', ['Attachment' => false]);
?>