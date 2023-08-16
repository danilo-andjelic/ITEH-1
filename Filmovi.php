<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmovi - Bioskop D</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: beige">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <a class="navbar-brand" href="#">Bioskop D</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Filmovi.php">Filmovi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Autori.php">Autori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ONama.php">O nama</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Dodaj
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="DodajFilm.php">Novi film</a></li>
                            <li><a class="dropdown-item" href="DodajAutora.php">Novog Autora</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    
    <main class="container mt-5" style="background-color: beige">
        <h1 class="display-4">Filmovi</h1>

        <?php
        include_once('model/Film.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_film'])) {
            $filmIdToDelete = $_POST['filmId'];

            Film::obrisiFilmPremaId($baza, $filmIdToDelete);
            header('Location: Filmovi.php');
            exit();
        }
        ?>

        <?php
        include_once('dbBroker.php');
        include_once('model/Film.php');

        $filmovi = Film::vratiSveFilmove($baza);

        if ($filmovi === false) {
            echo 'Error fetching filmovi: ' . mysqli_error($baza);
        } else {
            if (mysqli_num_rows($filmovi) > 0) {
                while ($film = mysqli_fetch_assoc($filmovi)) {
                    echo '<table class="table">';
                    echo '<thead><tr><th>ID</th><th>Naslov</th><th>Godina izdavanja</th><th>Cena karte</th><th>Autor</th><th>Akcije</th></tr></thead>';
                    echo '<tbody>';
                    while ($film = mysqli_fetch_assoc($filmovi)) {
                        $autor = Autor::vratiAutoraPremaID($baza, $film['autorId']);
                        echo '<tr>';
                        echo '<td>' . $film['filmId'] . '</td>';
                        echo '<td>' . $film['naslov'] . '</td>';
                        echo '<td>' . $film['godinaIzdavanja'] . '</td>';
                        echo '<td>' . $film['cenaKarte'] . '</td>';
                        echo '<td>' . $autor['ime'] . ' ' . $autor['prezime'] . '</td>';
                        echo '<td>';
                        echo '<form method="POST">';
                        echo '<input type="hidden" name="filmId" value="' . $film['filmId'] . '">';
                        echo '<button type="submit" name="delete_film" class="btn btn-danger btn-sm">Izbriši</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                }
            } else {
                echo '<p>Nema dostupnih filmova.</p>';
            }
        }

        ?>

    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>