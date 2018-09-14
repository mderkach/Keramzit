<?php
//ip посетителя
function getIp(){
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip_address=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    if (!isset($ip_address)){
            if (isset($_SERVER['REMOTE_ADDR']))
            $ip_address=$_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}

function occurrenceCity($to = 'utf-8'){
    $ip = getIp();
    $xml =  simplexml_load_file('http://ipgeobase.ru:7020/geo?ip='.$ip);
    if($xml->ip->message){
        if( $to == 'utf-8' ){
            return $xml->ip->message;}else
            {
                if( function_exists('iconv')) return iconv( "UTF-8", $to . "//IGNORE",$xml->ip->message);
                else return "The library iconv is not supported by your server";
            }

    }else{
        if($to == 'utf-8'){
           return $xml->ip->city;
        }else{
            if(function_exists( 'iconv' ))return iconv( "UTF-8", $to . "//IGNORE",$xml->ip->city);
            else return "The library iconv is not supported by your server";
        }
    }
}

function occurrenceRegion($to = 'utf-8'){
    $ip = getIp();
    $xml =  simplexml_load_file('http://ipgeobase.ru:7020/geo?ip='.$ip);
    if($xml->ip->message){
        if( $to == 'utf-8' ){
            return $xml->ip->message;}else
            {
                if( function_exists('iconv')) return iconv( "UTF-8", $to . "//IGNORE",$xml->ip->message);
                else return "The library iconv is not supported by your server";
            }

    }else{
        if($to == 'utf-8'){
           return $xml->ip->region;
        }else{
            if(function_exists( 'iconv' ))return iconv( "UTF-8", $to . "//IGNORE",$xml->ip->region);
            else return "The library iconv is not supported by your server";
        }
     }
}
?>