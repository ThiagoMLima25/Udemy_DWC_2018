<?php
    $alfabeto   = "23456789ABCDEFGHIJKLMNOPQRST";
    $tamanho    = 12;
    $letra      = "";
    $resultado  = "";

    for($i = 1; $i < $tamanho; $i++){
        $letra = substr($alfabeto, rand(0,23), 1);
        $resultado .= $letra;
    }

    date_default_timezone_set("America/Recife");
    $agora = getdate();

    $codigo_data = $agora["year"] . "-" . $agora["yday"];
    $codigo_data .= $agora["hours"] . "-" .$agora["minutes"].$agora["seconds"];

    echo $foto = "foto_".$codigo_data."_".$resultado.".jpg";
    echo "<br><br>";
    echo strrchr($foto,".");

?>