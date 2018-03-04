<!DOCTYPE HTML>
<?php
$urlAway = "http://api.sl.se/api2/realtimedeparturesV4.xml?key=3824f6d68e624514a89db3a1b3350055&siteid=2032&timewindow=30";
$xmlAway = simplexml_load_file($urlAway);
$xmlstringAway = $xmlAway->asXML();


$url = "http://api.sl.se/api2/realtimedeparturesV4.xml?key=3824f6d68e624514a89db3a1b3350055&siteid=9220&timewindow=30&metro=false&tram=false&train=false&ship=false";
$xml = simplexml_load_file($url);
$xmlstring = $xml->asXML();


//203 (Stop point G)
//205 (Stop point C) Towards Sticklinge - Get off at Kalvhagsvägen
//204 (Stop point A) towards Elfvik -  Get off at Lidingövallen
//212  (Stop point A) - towards Björnbo - Get off at Lidingövallen

//print_r($xmlstring);

$posAway = strpos($xmlstringAway, 'Ropsten');
$countAway = 321;
$posAway = $posAway+$countAway;
$minutesAway = substr($xmlstringAway, $posAway, 2);

$count203 = 380;
$count204 = 388;
$count205 = 392;
$count212 = 394;

$busarray = array(
    "203" => strpos($xmlstring, '203'),
    "204" => strpos($xmlstring, '204'),
    "205"   => strpos($xmlstring, '205'),
    "212"  => strpos($xmlstring, '212'),
);
asort($busarray);
$allKeys = array_keys($busarray);

?>
<html>
<meta http-equiv="refresh" content="20" name="viewport" content="width=device-width, initial-scale=1.0">
<head>  
<style>
body {
    background-color: black;
}

p {
    font-family: 'Noto Sans', sans-serif;
    color: white;
    font-size: 40px;
    text-align: left;
}

table.center {
    margin-left:auto; 
    margin-right:auto;
  }

</style>
</head>
<body bgcolor="#000000">
<br>
<table class="center"><tr><th>
<p> 
Leaving Home<br>
<?
echo "203 - ";
if ($minutesAway != 'Nu'){
                echo "$minutesAway min";
                //echo " min";
            }
        else echo $minutes;
?>
</p>
</th></tr>
<tr><th>
<p>
Going Home <br>
<?

if($busarray["203"] || $busarray["204"] || $busarray["205"] || $busarray["212"]){
    $i = 0;
    while($i <= 3){
        switch ($allKeys[$i]){
        case "203":
        if($busarray["203"]){
            echo "203 - ";
            $minutes = substr($xmlstring, $busarray["203"]+$count203, 2);
            if ($minutes != 'Nu'){
                echo $minutes;
                echo " min (G)<br>";
            }
        else echo "$minutes (G)<br>";
        }
        break;
        case "204":
        if($busarray["204"]){
            echo "204 - ";
            $minutes = substr($xmlstring, $busarray["204"]+$count204, 2);
            if ($minutes != 'Nu'){
                echo $minutes;
                echo " min (A)<br>";
            }
        else echo "$minutes (A)<br>";
        }
        break;
        case "205":
        if($busarray["205"]){
            echo "205 - ";
            $minutes = substr($xmlstring, $busarray["205"]+$count205, 2);
            if ($minutes != 'Nu'){
                echo $minutes;
                echo " min (C)<br>";
            }
        else echo "$minutes (C)<br>";
        }
        break;
        case "212":
        if($busarray["212"]){
            echo "212 - ";
            $minutes = substr($xmlstring, $busarray["212"]+$count212, 2);
            if ($minutes != 'Nu'){
                echo $minutes;
                echo " min (A)<br>";
            }
        else echo "$minutes (A)<br>";
        }
        break;
        }
    $i++;
    }
}
else echo "No busses within the next 30 minutes";
?>
</p>
</th></tr></table>
</body>
</html>