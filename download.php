<?php
require_once "Database.php";

$conn = (new Database())->getConnection();

// ********* MOJE *************
//$github_user = "Simona735";
//$github_repo = "meteostanica";


//******* CURL connection **************
$github_user = "apps4webte";
$github_repo = "curldata2021";
$ch = curl_init('https://api.github.com/repos/'.$github_user.'/'.$github_repo.'/contents');

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/vnd.github.v3+json',
    'User-Agent: '.$github_user,
]);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$json = curl_exec($ch);
curl_close($ch);

$array = json_decode($json);

// ************  load from BD  ***********
$stmt = $conn->query("SELECT * FROM `lecture`;");

$db_lectures = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($db_lectures, $row["filename"]);
}

$repo_lectures = [];
foreach ($array as $item){
    if($item->download_url != NULL){
        if (!in_array($item->name, $db_lectures)) {
            $file_date = substr($item->name, 0, 4) ."-". substr($item->name, 4, 2)."-". substr($item->name, 6, 2);

            $query = "INSERT INTO `lecture`(`timestamp`, `filename`) VALUES ('".$file_date."','".$item->name."');";
            $stmt = $conn->query($query);
            downloadToDb($conn, $conn->lastInsertId(), $item->download_url);
            array_push($db_lectures, $item->name);
        }else{
            //je to v DB, vsetko ok
        }
        //array_push($repo_lectures, [$item->name, $item->download_url]);
        array_push($repo_lectures, $item->name);
    }
}

if (count($repo_lectures) != count($db_lectures)){
    var_dump("repo count " .count($repo_lectures));
    var_dump("db count " .count($db_lectures));
    foreach ($db_lectures as $item){
        if (!in_array($item, $repo_lectures)) {
            $stmt = $conn->query("SELECT id FROM lecture WHERE filename='".$item."';");
            $lecture = $stmt->fetch(PDO::FETCH_ASSOC);

            $query = "DELETE FROM `user_actions` WHERE lecture_id=".$lecture["id"].";";
            $stmt = $conn->query($query);

            $query = "DELETE FROM `lecture` WHERE filename='".$item."';";
            $stmt = $conn->query($query);
        }
    }
}

function downloadToDb($conn, $lecture_id, $url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = mb_convert_encoding($output, "utf-8", "utf-16le");
    $lines = explode(PHP_EOL, $output);
    $csv = [];


    $stmt = $conn->prepare("INSERT INTO user_actions(lecture_id, name, surname, action, timestamp) VALUES (".$lecture_id.",:name , :surname , :action, :timestamp)");

    foreach ($lines as $index => $line){
        if ($index > 0 && $index < (sizeof($lines) - 1)){
            $lineArray = str_getcsv($line, "\t");



            $full_name = $lineArray[0];
            $nameArray = explode(" ", $full_name);
            if (sizeof($nameArray) > 2){
                $name = "";
                foreach ($nameArray as $nameIndex => $part){
                    if($nameIndex != sizeof($nameArray) - 1){
                        $name .= $part . " ";
                    }
                }
                $name = substr($name, 0, -1);
            }else{
                $name = $nameArray[0];
            }
            $surname = $nameArray[sizeof($nameArray) - 1];

            $action = $lineArray[1];
            $timestamp = getTimestamp($lineArray[2]);

            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':timestamp', $timestamp);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);

            $stmt->execute();
        }
    }

    return $csv;
}

function getTimestamp($date){
    $dateSplit = explode(" ",$date);
    $correctDate = $dateSplit[0] . $dateSplit[1];
    return date("Y-m-d H:i:s",date_create_from_format('d/m/Y,H:i:s',$correctDate)->getTimestamp());
}

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<script>
</script>
</body>
</html>