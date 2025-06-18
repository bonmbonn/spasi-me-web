<?php
    session_start();
    include 'connect.php';

    $msg = '';
    $registriranKorisnik = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $username = $_POST['username'];
        $lozinka = $_POST['pass'];
        $ponovljenaLozinka = $_POST['pass2'];

        //check lozinke
        if ($lozinka !== $ponovljenaLozinka) {
            $msg = "<p class='false_info'>Lozinke se ne podudaraju.</p>";
        } else {
            $hashed_password = password_hash($lozinka, PASSWORD_BCRYPT);
            $razina = 1;
           
    
            //check usera
            $sql = "SELECT username FROM korisnik WHERE username = ?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $msg = "<p class='false_info'>Korisničko ime već postoji.</p>";
                } else {
                    //insert usera
                    $sql = "INSERT INTO korisnik (ime, prezime, username, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);

                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
                        mysqli_stmt_execute($stmt);
                        $registriranKorisnik = true;
                        $_SESSION['razina'] = 1;
                    }
                    if ($registriranKorisnik){
                        $msg = "<p class='corr_info'>Korisnik je uspješno registriran!</p>";
                    }
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login / Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="prijava.css">

</head>


<body>
<header>
    <nav class="admin_header">
        <a href="index.php">
            <img src="images_home/temp_logo.webp" alt="logo udruge" id="header_logo">
        </a>
        <h2 id="saved_animals">Do sad spašeno: <span class="highlight">1325</span> životinja</h2>
        <ul class="nav_links">
            <li><a href="kategorija.php?vrsta=mačka">MAČKE</a></li>
            <li><a href="kategorija.php?vrsta=pas">PSI</a></li>
            <li><a href="kategorija.php?vrsta=zec">ZEČEVI</a></li>
            <li><a href="kategorija.php?vrsta=ptica">PTICE</a></li>
            <li><a href="kategorija.php?vrsta=drugo">DRUGO</a></li>

            <?php if (isset($_SESSION['username']) && $_SESSION['razina'] == 1): ?>
                <li><a href="unos.php">DODAJ ŽIVOTINJU</a></li>
                <li><a href="administrator.php">UREDI ŽIVOTINJE</a></li>
            <?php elseif (isset($_SESSION['username']) && $_SESSION['razina'] == 0): ?>
                <li><a href="unos.php">DODAJ ŽIVOTINJU</a></li>
            <?php endif; ?>

            <?php if (!isset($_SESSION['username'])): ?>
                <li><a href="registracija.php">REGISTRACIJA</a></li>
                <li><a href="prijava.php">PRIJAVA</a></li>
            <?php else: ?>
                <li><a href="logout.php">ODJAVA (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>  


 <section class="form_box">
    <form class="form_flex" method="POST" action="">
        <h2>Registriraj se</h2>
        <input type="text" name="ime" placeholder="Ime" required />
        <input type="text" name="prezime" placeholder="Prezime" required />
        <input type="text" name="username" placeholder="Korisničko ime" required />
        <input type="password" name="pass" placeholder="Lozinka" required />
        <input type="password" name="pass2" placeholder="Ponovi lozinku" required />
        <button type="submit">Registriraj se</button>
        <p class="switch_text">Imaš račun? <a href="./prijava.php">Prijavi se.</a></p>
    </form>
    <?= $msg ?>
</section>


    <footer>
        <div>
        <strong><p>&copyAdopt</p></strong>
        </div>
        <div>
            <strong>
            <p>Luka Gustetić</p>
            <p>luka.gustetic@gmail.com</p>
            <p>2025</p>
            </strong>
        </div>
    </footer>

</body>
</html>
