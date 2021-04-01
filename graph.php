<?php
require_once "Database.php";

$conn = (new Database())->getConnection();

?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Richterova">
    <!-- favicon
		============================================ -->
    <link rel="icon" type="image/png" href="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Dochádzka</title>
</head>

<body class="bg-light">

<div class="container">
    <div class="pt-5 text-center">
        <h2>Dochádzka</h2>
    </div>

    <div class="row pt-2 text-center">
        <div class="col-lg-12 col-md-12">
                <a href="index.php" class="btn btn-primary my-2">
                    Návrat
                </a>
        </div>
    </div>

    <div class="row py-lg-3 text-center">
        <div class="col-lg-12 col-md-12">
            <div id="tester"></div>
        </div>
    </div>




    <footer class="my-3 text-muted text-center text-small">
        <p class="mb-1">&copy;2021 WEBTECH2 - Richterová </p>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script src="js/chart.js"></script>

</body>
</html>