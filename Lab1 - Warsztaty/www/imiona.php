<?php
//###BACKEND###
$filter = $_GET["filter"] ?? ""; 
//operator ?? zapewnia obsługę wszystkich sytuacji wyjątkowych, 
//jak coś jest nie tak to weź to co po prawej

$db = new PDO("sqlite:imiona.db");
$sql = "SELECT pozycja, imie, plec 
        FROM imiona 
        WHERE imie 
        LIKE :wzor 
        ORDER BY pozycja";
$query = $db->prepare($sql);
$filter .= "%"; //dodaj % do filtrowania SQL 
$query->bindValue(":wzor", $filter);
$query->execute(); 

//wywołanie SQLa zwraca obiekt, po którym można iterować
//fetchAll zwraca wszystkie wiersze odpowiedzi na raz
//FETCH:ASSOC -> chce wynik jako tablicę asocjacyjną
$res = $query-> fetchAll(PDO::FETCH_ASSOC); 
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
//pokaż wyniki jako json
print(json_encode($res));

//nie warto zamykać PHPa w plikach, w którym jest tylko php