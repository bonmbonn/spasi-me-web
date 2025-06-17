<?php
    session_start();
    include 'connect.php';

    $uspjesnaPrijava = false;
    $admin = false;
    $msg = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $korisnicko_ime = $_POST['username'];
        $lozinka = $_POST['password'];

        $sql = "SELECT username, lozinka, razina FROM korisnik WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt) ;

            //ako postoji user
            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaHash, $razina);
                mysqli_stmt_fetch($stmt);

                if (password_verify($lozinka, $lozinkaHash)) {
                    $_SESSION['username'] = $imeKorisnika;
                    $_SESSION['razina'] = $razina;

                    if ($razina == 1) {
                        $admin = true;
                    }

                    //redirekcija nakon prijave
                    header("Location: administrator.php");
                    exit;

                } else {
                    $msg = "<h2 class = 'false_info'> Netočna lozinka. </h2>";
                }
            } else {
                $msg = "<h2 class='false_info'> Korisničko ime ne postoji.&nbsp;<br><a href='registracija.php'> Registriraj se ovdje.</a></h2>";
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
            <a href="index.php"><img src="images_home/temp_logo.webp" alt="logo udruge"  id="header_logo"></a>
            <h2 id="saved_animals">Do sad spašeno: <span class="highlight">1325</span> životinja</h2>
            <ul class="nav_links">
                <li><a href="kategorija.php?vrsta=mačka">MAČKE</a></li>
                <li><a href="kategorija.php?vrsta=pas">PSI</a></li>
                <li><a href="kategorija.php?vrsta=zec">ZEČEVI</a></li>
                <li><a href="kategorija.php?vrsta=ptica">PTICE</a></li>
                <li><a href="kategorija.php?vrsta=drugo">DRUGO</a></li>
                <li><a href="unos.html">DODAJ ŽIVOTINJU</a></li>
                <li><a href="administrator.php">UREDI ŽIVOTINJE</a></li>
                <li><a href="registracija.html">REGISTRACIJA</a></li>
                <li><a href="prijava.html">PRIJAVA</a></li>
            </ul>
        </nav>
    </header>



  <section class="form_box">
        <h2>Prijava</h2>
        <form class="form_flex" method="POST">
            <input type="text" placeholder="Korisničko ime" required name="username"/>
            <input type="password" placeholder="Lozinka" required name="password"/>
            <button type="submit">Prijavi se</button>
            <p class="switch_text">Nemaš račun? <a href="./registracija.html">Registriraj se</a></p>
        </form>
            <?php 
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            echo $msg;
        }
    ?>
    </section>

</body>
</html>
