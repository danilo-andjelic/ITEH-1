<?php include_once('dbBroker.php') ?>
<?php include_once('model/Autor.php') ?>

<?php
class Film
{
    public $filmId;
    public $naslov;
    public $godinaIzdavanja;
    public $cenaKarte;
    public $autorId;

    public function __construct($naslov, $godinaIzdavanja, $cenaKarte, $autorId)
    {
        $this->naslov = $naslov;
        $this->godinaIzdavanja = $godinaIzdavanja;
        $this->cenaKarte = $cenaKarte;
        $this->autorId = $autorId;
    }

    public static function vratiSveFilmove($baza)
    {
        $sql = "SELECT * from filmovi";
        $rezultat = mysqli_query($baza, $sql);
        return $rezultat;
    }

    public function dodajFilm($baza)
    {
        $sqlUpit = "INSERT INTO filmovi (naslov, godinaIzdavanja, cenaKarte, autorId)
      VALUES('$this->naslov', '$this->godinaIzdavanja', '$this->cenaKarte', '$this->autorId')";
        $rez = mysqli_query($baza, $sqlUpit);
    }

    public static function vratiFilmPremaId($baza, $filmId)
    {
        $svi = self::vratiSveFilmove($baza);
        while ($film = mysqli_fetch_array($svi)) {
            if ($film['filmId'] == $filmId) {
                return $film;
            }
        }
    }

    public static function obrisiFilmPremaId($baza, $filmId)
    {
        $sqlUpit = "DELETE FROM filmovi WHERE filmId = $filmId";
        $rez = mysqli_query($baza, $sqlUpit);
    }

    function postojiLiFilm($baza)
    {
        $rez = self::vratiSveFilmove($baza);
        while ($film = mysqli_fetch_array($rez)) {
            if ($film['naslov'] == $this->naslov && $film['autorId'] == $this->autorId)
                return true;
        }
        return false;
    }

    static function vratiIdZaNaslovIAutora($baza, $naslov, $autorId)
    {
        $rez = self::vratiSveFilmove($baza);
        while ($film = mysqli_fetch_array($rez)) {
            if ($film['naslov'] == $naslov && $film['autorId'] == $autorId)
                return $film['filmId'];
        }
        return false;
    }

    public static function vratiSveFilmoveIAutora($baza)
    {
        $sql = "SELECT * from filmovi f INNER JOIN autori a on f.autorId = a.autorId";
        $rezultat = mysqli_query($baza, $sql);
        return $rezultat;
    }
}
?>