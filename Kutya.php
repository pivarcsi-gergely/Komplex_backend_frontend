<?php 

class Kutya {
    private $id;
    private $nev;
    private $fajta;
    private $kor;
    private $szul_ido;
    private $gazda_nev;

    public function __construct(string $nev, string $fajta, int $kor, DateTime $szul_ido, string $gazda_nev){
        $this->nev = $nev;
        $this->fajta = $fajta;
        $this->kor = $kor;
        $this->szul_ido = $szul_ido;
        $this->gazda_nev = $gazda_nev;
}

public function getId() : ?int{
    return $this->id;
}


public function getNev(){
    return $this->nev;
}

public function getFajta(){
    return $this->fajta;
}

public function getKor(){
    return $this->kor;
}

public function getSzulIdo(){
    return $this->szul_ido->format("Y-m-d");
}

public function getGazdaNev(){
    return $this->gazda_nev;
}


public function setNev(string $nev){
    $this->nev = $nev;
}

public function setFajta(string $fajta){
    $this->fajta = $fajta;
}

public function setKor(int $kor){
    $this->kor = $kor;
}

public function setSzulIdo(DateTime $szul_ido){
    $this->szul_ido = $szul_ido->format('Y-m-d');
}

public function setGazdaNev(string $gazda_nev){
    $this->gazda_nev = $gazda_nev;
}


public function ujKutya(){
    global $db;

    $db->prepare('INSERT INTO kutya (nev, fajta, kor, szul_ido, gazda_nev)
                 VALUES (:nev, :fajta, :kor, :szul_ido, :gazda_nev)')
        ->execute([
            ':nev' => $this->nev,
            ':fajta' => $this->fajta,
            ':kor' => $this->kor,
            ':szul_ido' => $this->getSzulIdo(),
            ':gazda_nev' => $this->gazda_nev
        ]);
}



public static function kutyak_listaz() : array{
    global $db;

    $t = $db->query('SELECT * FROM kutya')->fetchAll();
    $eredmeny = [];

    foreach ($t as $elem){
        $kutyaSor = new Kutya($elem['nev'], $elem['fajta'], $elem['kor'], new DateTime($elem['szul_ido']), $elem['gazda_nev']);
        $kutyaSor->id = $elem['id'];

        $eredmeny[] = $kutyaSor;
    }
    return $eredmeny;
}

public static function torol(int $id){
    global $db;

    $db->prepare('DELETE FROM kutya WHERE id=:id')->execute([':id' => $id]);
}

public function szerkeszt(int $szerkesztId) {
global $db;

$db->prepare('UPDATE kutya SET nev = :nev, fajta = :fajta, kor = :kor, szul_ido = :szul_ido, gazda_nev = :gazda_nev WHERE id = :id')
->execute([
    ':nev' => $this->nev,
    ':fajta' => $this->fajta,
    ':kor' => $this->kor,
    ':szul_ido' => $this->getSzulIdo(),
    ':gazda_nev' => $this->gazda_nev,
    ':id' => $this->id = $szerkesztId
]);
}

}


?>