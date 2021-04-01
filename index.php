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

<!--    <link rel="stylesheet" type="text/css" href="css/default.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Dochádzka</title>
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Dochádzka</h2>
    </div>
    <div class="table-responsive">
        <table class="table " id="ourWinners">
            <thead>
            <tr class="table-active">
                <th scope="col" >Meno študenta</th>
                <th scope="col" >Min / pred</th>
<!--                ...-->
                <th scope="col" >Počet účastí</th>
                <th scope="col" >Počet minút</th>
            </tr>
            </thead>
            <tbody id="table1Body">
            </tbody>
        </table>
    </div>

    <!-- Button trigger modal -->
<!--    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">-->
<!--        Launch demo modal-->
<!--    </button>-->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row py-lg-5 text-center">
        <div class="col-lg-12 col-md-12">
            <p>
                <a href="addPerson.php" class="btn btn-success my-2">
                    <i class="bi bi-person-plus-fill"></i>
                    Pridať športovca
                </a>
                <a href="addRanking.php" class="btn btn-success my-2">
                    <i class="bi bi-plus"></i>
                    Pridať umiestnenia
                </a>
            </p>
        </div>
    </div>

    <footer class="my-3 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy;2021 WEBTECH2 - Richterová </p>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script>

</script>
<script src="js/javascript.js"></script>

</body>
</html>