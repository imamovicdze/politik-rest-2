<!doctype html>
<html lang="en">

<?php

require 'vendor/autoload.php';
require 'Pages/partials/head.php';
require 'Services/DataHandlingService.php';

use GuzzleHttp\Client;

$pageNumber = isset($_GET['pageNumber']) ? $_GET['pageNumber'] : 1;
$dataHandlingService = new DataHandlingService(new Client());

?>

<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= $_SERVER['PHP_SELF'] ?>">Politik Rest 2nd</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="councillors">Councillors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="factions">Factions</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php

    $dataHandlingService->renderContent($_SERVER['REQUEST_URI'], $pageNumber);

    ?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>
