<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autori - Bioskop D</title>
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
        <h1 class="display-4">Autori</h1>

        <?php
        include_once('dbBroker.php');
        include_once('model/Autor.php');

        $autori = Autor::vratiSveAutore($baza);

        if ($autori === false) {
            echo 'Error fetching autori: ' . mysqli_error($baza);
        } else {
            if (mysqli_num_rows($autori) > 0) {
                while ($autor = mysqli_fetch_assoc($autori)) {
                    echo '<div class="card mt-3">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $autor['ime'] . ' ' . $autor['prezime'] . '</h5>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Nema dostupnih autora.</p>';
            }
        }
        ?>

    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>