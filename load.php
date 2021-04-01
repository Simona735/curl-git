<?php
require_once "Database.php";

$conn = (new Database())->getConnection();


$stmt = $conn->query("SELECT lecture.id, MAX(user_actions.timestamp) as max_time FROM lecture JOIN user_actions ON user_actions.lecture_id = lecture.id GROUP BY lecture.id;");
$lectures = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($lectures, [$row["id"], $row["max_time"]]);
}

//console_log($lectures);



$stmt = $conn->query("SELECT user_actions.name, user_actions.surname FROM user_actions GROUP BY user_actions.name, user_actions.surname;");

$people = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//    console_log($row);
    $minutes_field=[];
    $name = $row['name'];
    $surname = $row['surname'];

    foreach ($lectures as $lecture){
        $stmt2 = $conn->query("SELECT user_actions.action, user_actions.timestamp FROM user_actions WHERE user_actions.name='".$name."' AND user_actions.surname='".$surname."' AND user_actions.lecture_id=".$lecture[0].";");

        $lesson = [];
        while($entry = $stmt2->fetch(PDO::FETCH_ASSOC))
        {
            array_push($lesson, [$entry["action"],  $entry["timestamp"]]);
        }

        if (count($lesson) > 0 ){
            array_push($minutes_field, getLectureMinutes($lesson, $lecture[1]));
        }else{
            array_push($minutes_field, 0);
        }
    }

    $line = [$surname . " " . $name];

    foreach ($minutes_field as $minute_record){
        array_push($line, $minute_record);
    }
    array_push($line, attendanceCount($minutes_field), minutesCount($minutes_field));
//    console_log($line);
    array_push($people, $line);

}

function getLectureMinutes($lesson, $max_time){

    $total_minutes = 0;

    if(count($lesson) % 2 == 1){
        array_push($lesson, ["Left", $max_time]);
    }
    for ($i = 0; $i < count($lesson); $i = $i+2){
        $joined = new DateTime($lesson[$i][1]);
        $left = new DateTime($lesson[$i + 1][1]);
        $interval  = $joined->diff($left);
        $total_minutes += $interval->i + ($interval->h * 60) ;

    }
    return $total_minutes;
}

function attendanceCount($field){
    $attendance = 0;
    foreach ($field as $record){
        if($record > 0){
            $attendance++;
        }
    }
    return $attendance;
}

function minutesCount($field){
    $total_minutes = 0;
    foreach ($field as $record){
        $total_minutes += $record;
    }
    return $total_minutes;
}


function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

echo json_encode($people);