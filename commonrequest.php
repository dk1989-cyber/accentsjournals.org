<?php

if(($_SERVER['QUERY_STRING']!="")){
	$jid_arr=explode("=", $_SERVER['QUERY_STRING']);
	$journalsId=$jid_arr[1];
}
else{
   header("Location: ".base_url(''));
}

?>