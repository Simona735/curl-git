<?php
require_once "Database.php";

$conn = (new Database())->getConnection();

$stmt = $conn->query("SELECT COUNT(*) AS attendance, lecture.timestamp as timestamp FROM (SELECT DISTINCT lecture_id, name, surname FROM user_actions) as uniques JOIN lecture ON uniques.lecture_id = lecture.id GROUP BY lecture_id");

$lectures = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($lectures, [$row["attendance"], formatDate($row["timestamp"])]);
}

function formatDate($date){
    return substr($date, 8, 2) .".". substr($date, 5, 2).".";
}

$response = json_encode($lectures);

//$stmt = $db->query($query);
//$data = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));


echo $response;