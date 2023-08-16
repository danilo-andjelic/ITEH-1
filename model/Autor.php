<?php include_once('dbBroker.php') ?>
<?php include_once('model/Film.php') ?>

<?php
class Autor
{
    public $autorId;
    public $ime;
    public $prezime;


    public function __construct($ime, $prezime)
    {
        $this->ime = $ime;
        $this->prezime = $prezime;
    }

    public static function vratiSveAutore($baza)
    {
        $sql = "SELECT * from autori";
        $rezultat = mysqli_query($baza, $sql);
        return $rezultat;
    }

    public function dodajAutora($baza)
    {
        $sqlUpit = "INSERT INTO autori (ime, prezime)
      VALUES('$this->ime', '$this->prezime')";
        $rez = mysqli_query($baza, $sqlUpit);
    }

    public static function vratiAutoraPremaID($baza, $autorId)
    {
        $svi = self::vratiSveAutore($baza);
        while ($autor = mysqli_fetch_array($svi)) {
            if ($autor['autorId'] == $autorId) {
                return $autor;
            }
        }
    }

    public static function obrisiAutoraPremaID($baza, $autorId)
    {
        $sqlUpit = "DELETE FROM autori WHERE autorId = $autorId";
        $rez = mysqli_query($baza, $sqlUpit);
    }

    function postojiLiAutor($baza)
    {
        $rez = self::vratiSveAutore($baza);
        while ($autor = mysqli_fetch_array($rez)) {
            if ($autor['ime'] == $this->ime && $autor['prezime'] == $this->prezime)
                return true;
        }
        return false;
    }
}
?>