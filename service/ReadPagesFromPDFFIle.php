<?php

class ReadPagesFromPDFFIle {

    function getNumPagesPdf($filepath) {
       // $filepath = $filepath;
        
        $fp = @fopen(preg_replace("/\[(.*?)\]/i", "", $filepath), "r");
        if ($fp){
        $max = 0;
        while (!feof($fp)) {
            $line = fgets($fp, 255);
            if (preg_match('/\/Count [0-9]+/', $line, $matches)) {
                preg_match('/[0-9]+/', $matches[0], $matches2);
                if ($max < $matches2[0])
                    $max = $matches2[0];
            }
        }
        fclose($fp);
        if ($max == 0) {
            $im = new imagick($filepath);
            $max = $im->getNumberImages();
        }
        return $max;
     }
     else{
        return null;
     }
   }

}
?>