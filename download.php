<?php

$ch = curl_init('https://api.github.com/repos/Simona735/meteostanica/contents');

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/vnd.github.v3+json',
    'User-Agent: Simona735'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$json = curl_exec($ch);
curl_close($ch);

$array = json_decode($json);

$repo = [];

foreach ($array as $line){
    array_push($repo, $line["name"] );
    var_dump($line["name"]);
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
    console.log(<?php
        echo $array;
        ?>);
</script>
</body>
</html>