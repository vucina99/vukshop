<?php
require_once "../config/connection.php";

        $array=[];
        $pocetna=0;
        $proizvodi=0;
        $kontakt=0;
        $autor=0;
        $total=0;
        $day_ago=strtotime("1 day ago");
       
        @$file=file(LOG_FAJL);
        if(count($file)){
    
        foreach($file as $i){
            $part=explode("\t",$i);
            $url=explode(".php", $part[0]);
            $page="";
            @$page=explode("&", $url[1]);
        
            if(strtotime($part[1])>=$day_ago){
                switch($page[0]){
                case "":$pocetna++;$total++;;break;
                case "?page=proizvodi":$proizvodi++;$total++;;break;
                case "?page=kontakt":$kontakt++;$total++;;break;
                case "?page=autor":$autor++;$total++;;break;
                default:$pocetna++;$total++;;break;
            }
            }
        }
        if($total>0){
            $array["pocetna"]=round($pocetna*100/$total,2);
            $array["proizvodi"]=round($proizvodi*100/$total,2);
            $array["kontakt"]=round($kontakt*100/$total,2);
            $array["autor"]=round($autor*100/$total,2);
            }
       
        }

        echo json_encode($array);
        http_response_code(200);
?>