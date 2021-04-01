<?php
require_once "Database.php";

$conn = (new Database())->getConnection();

$stmt = $conn->query("SELECT * FROM lecture ORDER BY timestamp;");

$lectures = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($lectures, formatDate($row["timestamp"]));
}

function formatDate($date){
    $formatted =  substr($date, 8, 2) ."/". substr($date, 5, 2);
    return $formatted;
}

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
    <div class="pt-5 pb-2 text-center">
        <h2>Dochádzka</h2>
    </div>

    <div class="row py-lg-2 text-center">
        <div class="col-lg-12 col-md-12">
                <a href="graph.php" class="btn btn-primary mt-2 mb-3">
                    Graf
                </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover" id="ourWinners">
            <thead>
            <tr class="table-active">
                <th scope="col" class="sortable" id="name" >Meno študenta</th>
                <?php
                $count = 0;
                foreach ($lectures as $lecture){
                    $count++;
                    ?>
                <th scope="col" ><?php echo $count .". ". $lecture?></th>
                <?php
                } ?>
                <th scope="col" class="sortable" id="attendance">Počet účastí</th>
                <th scope="col" class="sortable" id="minutes">Počet minút</th>
            </tr>
            </thead>
            <tbody id="table1Body">

            </tbody>
        </table>
    </div>

    <div id="loader" class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
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



    <footer class="my-3 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy;2021 WEBTECH2 - Richterová </p>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="js/javascript.js"></script>

</body>
</html>