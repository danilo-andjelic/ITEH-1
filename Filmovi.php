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
        include_once('dbBroker.php');
        include_once('model/Film.php');

        $filmovi = Film::vratiSveFilmove($baza);

        if ($filmovi === false) {
            echo 'Error fetching filmovi: ' . mysqli_error($baza);
        } else {
            if (mysqli_num_rows($filmovi) > 0) {
                while ($film = mysqli_fetch_assoc($filmovi)) {
                    echo '<div class="card mt-3">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $film['naslov'] . '</h5>';
                    echo '<p class="card-text">Godina izdavanja: ' . $film['godinaIzdavanja'] . '</p>';
                    echo '<p class="card-text">Cena karte: ' . $film['cenaKarte'] . '</p>';
                    echo '</div>';
                    echo '</div>';
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