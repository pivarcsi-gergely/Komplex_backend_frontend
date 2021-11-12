<?php 

require_once 'db.php';
require_once 'Kutya.php';

$szerkesztId = $_GET['szerkesztId'] ?? null;

$nevHiba = '';
$fajtaHiba = '';
$korHiba = '';
$szulIdoHiba = '';
$gazdaNevHiba = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $ujKutya->szerkeszt($szerkesztId);
        header('Location: index_kutyak.php');
        exit();

        $nevHiba = '';
        $fajtaHiba = '';
        $korHiba = '';
        $szulIdoHiba = '';
        $gazdaNevHiba = '';
    }
}

if ($szerkesztId === '') {
    header('Location: index_kutyak.php');
    exit();
}

global $db;
$t = $db->query("SELECT * FROM kutya WHERE id = $szerkesztId")->fetchAll();

$kutya = new Kutya($t[0]["nev"], $t[0]["fajta"], $t[0]["kor"], new DateTime($t[0]["szul_ido"]), $t[0]["gazda_nev"]);


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Kutyák - szerkesztő</title>
</head>
<body>
    <div class="container-fluid">

        <div id="cimsor">
           <h1><span>Kutyák - szerkesztő</span></h1>
        </div>

        <div class="sajatForm">
            <form method="POST">
                <div>
                    Név: <input type="text" name="nev" id="nev" placeholder="Bodri, Buksi..." value="<?php echo $kutya->getNev(); ?>">
                    <p id="hibaSzoveg"> <?php echo $nevHiba; ?></p>
                </div>
                <div>
                    Fajta: <input type="text" name="fajta" id="fajta" placeholder="siba inu, foxterrier..." value="<?php echo $kutya->getFajta(); ?>">
                    <p id="hibaSzoveg"> <?php echo $fajtaHiba; ?></p>
                </div>
                <div>
                    Kor: <input type="number" name="kor" id="kor" placeholder="3, 4, 15..." value="<?php echo $kutya->getKor(); ?>">
                    <p id="hibaSzoveg"> <?php echo $korHiba; ?></p>
                </div>
                <div>
                    Szül. idő: <input type="date" name="szul_ido" id="szul_ido" value="<?php echo $kutya->getSzulIdo(); ?>">
                    <p id="hibaSzoveg"> <?php echo $szulIdoHiba; ?></p>
                </div>
                <div>
                    Gazda teljes neve: <input type="text" name="gazda_nev" id="gazda_nev" placeholder="Kis Pista Gézáné..." value="<?php echo $kutya->getGazdaNev(); ?>">
                    <p id="hibaSzoveg"> <?php echo $gazdaNevHiba; ?></p>
                </div>
                <div>
                    <input type="submit" value="Szerkeszt"><br>
                    <a href="index_kutyak.php" class="megse">Mégse</a>
                </div>
            </form>
        </div>

    </div>
    
    
</body>
</html>