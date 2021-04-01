<?php
require_once "Database.php";

$conn = (new Database())->getConnection();

if (isset($_POST["lecture"]) && isset($_POST["name"])){
    $name = getName($_POST["name"]);
    $surname = getSurname($_POST["name"]);

    $stmt = $conn->query("SELECT user_actions.action, user_actions.timestamp FROM user_actions WHERE user_actions.name='".$name."' AND user_actions.surname='".$surname."' AND user_actions.lecture_id=".$_POST["lecture"].";");
    $lesson = [];
    while($entry = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($lesson, [$entry["action"],  $entry["timestamp"]]);
    }

    $stmt = $conn->query("SELECT timestamp FROM lecture WHERE id = ".$_POST["lecture"].";");
    $lecture = $stmt->fetch(PDO::FETCH_ASSOC);

    $timestamp = $lecture["timestamp"];

    $allInfo=[];
    array_push($allInfo, [$_POST["name"], dateFromTimestamp($timestamp) ,$lesson]);


    echo json_encode($allInfo);
}else{
    echo "error";
}


function getName($full_name){
    $nameArray = explode(" ", $full_name);
    $name = "";
    foreach ($nameArray as $nameIndex => $part){
        if($nameIndex != 0){
            $name .= $part . " ";
        }
    }
    $name = substr($name, 0, -1);
    return $name;
}

function getSurname($full_name){
    $nameArray = explode(" ", $full_name);
    return $nameArray[0];
}

function dateFromTimestamp($timestamp){
    $date = new DateTime($timestamp);
    return $date->format('d.m.Y');
}
