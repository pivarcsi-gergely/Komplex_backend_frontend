<?php

require_once 'db.php';
require_once 'Kutya.php';

$nevHiba = '';
$fajtaHiba = '';
$korHiba = '';
$szulIdoHiba = '';
$gazdaNevHiba = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteId = $_POST['deleteId'] ?? '';

    if ($deleteId !== '') {
        Kutya::torol($deleteId);
    }

    $ujNev = $_POST['nev'] ?? '';
    $ujFajta = $_POST['fajta'] ?? '';
    $ujKor = $_POST['kor'] ?? '';
    $ujSzulIdo = $_POST['szul_ido'] ?? '';
    $ujGazdaNev = $_POST['gazda_nev'] ?? '';

    if ($ujNev === '') {
        $nevHiba = "Nem adtál meg nevet a kutyádnak! Adj meg neki egy nevet!";
    }

    if ($ujFajta === '') {
        $fajtaHiba = "Nem adtad meg a kutyád fajtáját! Adj meg neki, van neki!";
    }
    if ($ujKor === '') {
        $korHiba = "Nem adtad meg a kutyád korát! Add meg!";
    }
    if ($ujSzulIdo === '') {
        $szulIdoHiba = "Nem adtad meg a kutyád születési idejét! Add meg, nem született a semmikor!";
    }

    if ($ujGazdaNev === '') {
        $gazdaNevHiba = "Azért most már elég. Te vagy a kutyád gazdája, legalább a saját nevedet add meg!";
    }


    if ($ujNev !== '' && $ujFajta !== '' && $ujKor !== '' && $ujSzulIdo !== '' && $ujGazdaNev !== '') {
        $ujKutya = new Kutya($ujNev, $ujFajta, $ujKor, new DateTime($ujSzulIdo), $ujGazdaNev);
        $ujKutya->ujKutya();

        $nevHiba = '';
        $fajtaHiba = '';
        $korHiba = '';
        $szulIdoHiba = '';
        $gazdaNevHiba = '';
    }
    
}

$kutyak = Kutya::kutyak_listaz();

?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kutyák</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container-fluid">

    <div id="cimsor">
    <h1><span>Kutyák. Semmi más.</span></h1>
    </div>
    <div class="sajatForm">
        <h2>Form</h2>
        <p class="underCimSor">Ide írhatod be a kutyád adatait</p>
        <form method="POST">
            <div>
                Név: <input type="text" name="nev" id="nev" placeholder="Bodri, Buksi...">
                <p id="hibaSzoveg"> <?php echo $nevHiba; ?></p>
            </div>
            <div>
                Fajta: <input type="text" name="fajta" id="fajta" placeholder="siba inu, foxterrier...">
                <p id="hibaSzoveg"> <?php echo $fajtaHiba; ?></p>
            </div>
            <div>
                Kor: <input type="number" step="1" name="kor" id="kor" placeholder="3, 4, 15...">
                <p id="hibaSzoveg"> <?php echo $korHiba; ?></p>
            </div>
            <div>
                Szül. idő: <input type="date" name="szul_ido" id="szul_ido">
                <p id="hibaSzoveg"> <?php echo $szulIdoHiba; ?></p>
            </div>
            <div>
                Gazda teljes neve: <input type="text" name="gazda_nev" id="gazda_nev" placeholder="Kis Pista Gézáné...">
                <p id="hibaSzoveg"> <?php echo $gazdaNevHiba; ?></p>
            </div>
            <div>
                <input type="submit" value="Új kutya">
            </div>
        </form>
    </div>

    <div class="row">
    <?php 
    
    foreach ($kutyak as $kutya) {
        echo '<div class="col-xl-3">';
            echo '<div class="card text-white bg-dark m-5">';
                echo '<h4 class="card-title mx-auto mt-2">' . $kutya->getNev() .  '</h5>';
                    echo '<div class="card-body">';
                        echo '<p class="kartyaSor">Fajtája: ' . $kutya->getFajta() . '</p>';
                        echo '<p class="kartyaSor">Életkora: ' . $kutya->getKor() . ' év</p>';
                        echo '<p class="kartyaSor">Születési ideje: ' . $kutya->getSzulIdo() . '</p>';
                        echo '<p class="kartyaSor">Gazdájának teljes neve: ' . $kutya->getGazdaNev();
                        echo '<form method="POST">';
                            echo '<input type="hidden" name="deleteId" value="' . $kutya->getId() . '">';
                            echo '<button type="submit">Kutya törlése</button>';
                        echo '</form>';
                        echo "<a href='szerkesztes_kutya.php?szerkesztId=" . $kutya->getId() . "' class='szerkeszt'>Szerkeszt</a>";
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    ?>
    </div>

    </div>
</html>