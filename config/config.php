<?php
use Doctrine\DBAL\DriverManager;
$connectionParams = [
    'dbname' => 'adxy_accent',
    'user' => 'adxy_accent',
    'password' => '-N,3g]8?RFxl',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];


// $connectionParams = [
//     'dbname' => 'accent',
//     'user' => 'root',
//     'password' => '',
//     'host' => 'localhost',
//     'driver' => 'pdo_mysql',
// ];

 


$conn = DriverManager::getConnection($connectionParams);
  define("BURL","https://adxy.info/");
//define("BURL","http://localhost/accentjournals.org/");

function base_url($str){
    return BURL."$str";
}





$acceptable_img = array('image/jpeg','image/jpg','image/gif','image/png','image/PNG','image/GIF');
$acceptable_doc = array('application/pdf');


function get_author($list,$type='normal'){
 $author_name_cite="";
  $i=1;
  if($type=="normal"){
    foreach($list as $l){
      extract($l);
        $full_name=$firstname." ".$middlename." ".$lastname;
        $author_name_cite.=$full_name.", ";
    }
  }
  else{
  foreach($list as $l){
      extract($l);
      if(count($list)>1){
          $fn = trim($firstname," ");
          $mn = trim($middlename," ");
          $ln = trim($lastname," ");

          $fnLen = strlen($fn);
          $mnLen = strlen($mn);
          $lnLen = strlen($ln);

         if($lnLen>1) {
            
            if ( !empty($fn) && !empty($mn)){
                $author_name_cite.= $ln." ".$fn[0].$mn[0].", ";
            }elseif (!empty($fn) && empty($mn)) {
                $author_name_cite .= $ln." ".$fn[0].", ";
            }elseif (!empty($mn) && empty($fn)) {
                $author_name_cite .= $ln." ".$mn[0].", ";
            }            
        } 
        
        elseif($mnLen>1){
            if ( !empty($fn) && !empty($ln)){
                $author_name_cite .= $mn." ".$fn[0].$ln[0].", ";
            }elseif (!empty($fn) && empty($ln)) {
                $author_name_cite .= $mn." ".$fn[0].", ";
            }elseif (!empty($ln) && empty($fn)) {
                $author_name_cite .= $mn." ".$ln[0].", ";
            }            
        }elseif($fnLen>1){
            if (empty($mn) && !empty($ln)){
                $author_name_cite .= $fn." ".$ln[0].", ";
            }elseif (empty($ln) && !empty($mn)) {
                $author_name_cite .= $fn." ".$mn[0].", ";
            }else{
                $author_name_cite .= $fn;
            }
        }
        elseif($fnLen==1 && $mnLen==1 && $lnLen==1){
            $author_name_cite .= $ln." ".$fn[0].$mn[0].", ";
        }
       }
   }
  }
  return rtrim($author_name_cite,', ');
}

function get_month($index){
    $months=array("January","February","March","April","May","June","July","August","September","October","November","December");
    return $months[$index];
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}


function slugify($text, string $divider = '-'){
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}






?>