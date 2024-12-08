<?php

class CommonServices {

    

    function getCountries() {
        $query = mysql_query("select * from country");
        return $query;
    }  

    function getCountriesById($countryId) {
        $query = mysql_query("select * from country where countryId=$countryId");
        return mysql_fetch_array($query);
    }
    function getYear(){
        return range (date("Y"), 2011);
    }

    function getMonth(){
        return array("January","February","March","April","May","June","July","August","September","October","November","December");
    }

    function getConfrence(){
        $query = mysql_query("select * from confrence");
        return $query;
    }
}

?>
