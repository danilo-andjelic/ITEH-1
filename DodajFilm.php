<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Film - Bioskop D</title>
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
        <h1 class="display-4">Dodaj Film</h1>

        <?php
        include_once('dbBroker.php');
        include_once('model/Film.php');
        include_once('model/Autor.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $naslov = $_POST['naslov'];
            $godina = $_POST['godina'];
            $cena = $_POST['cena'];
            $autorId = $_POST['autorId'];

            $film = new Film($naslov, $godina, $cena, $autorId);
            $film->dodajFilm($baza);
            
            echo '<div class="alert alert-success" role="alert">Film je uspešno dodat!</div>';
        }
        ?>
        
        <form action="" method="POST">
            <div class="mb-3">
                <label for="naslov" class="form-label">Naslov filma</label>
                <input type="text" class="form-control" id="naslov" name="naslov" required>
            </div>
            <div class="mb-3">
                <label for="godina" class="form-label">Godina izdavanja</label>
                <input type="number" class="form-control" id="godina" name="godina" required>
            </div>
            <div class="mb-3">
                <label for="cena" class="form-label">Cena karte</label>
                <input type="number" step="0.01" class="form-control" id="cena" name="cena" required>
            </div>
            <div class="mb-3">
                <label for="autorId" class="form-label">ID autora</label>
                <select class="form-control" id="autorId" name="autorId">
                    <?php
                    include_once('dbBroker.php');
                    include_once('model/Autor.php');

                    $autori = Autor::vratiSveAutore($baza);

                    if ($autori !== false) {
                        while ($autor = mysqli_fetch_assoc($autori)) {
                            echo '<option value="' . $autor['autorId'] . '">' . $autor['ime'] . ' ' . $autor['prezime'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj film</button>
        </form>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>