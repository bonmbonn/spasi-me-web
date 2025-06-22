<?php 
    session_start();
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $naziv = !empty($_POST['animal_name']) ? htmlspecialchars($_POST['animal_name']) : "Nema novih životinja!";
        $vrsta = !empty($_POST['animal_type']) ? htmlspecialchars($_POST['animal_type']) : null;
        $starost = !empty($_POST['age']) ? htmlspecialchars($_POST['age']) : null;
        $kontakt = !empty($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number']) : null;
        $lokacija = !empty($_POST['location']) ? htmlspecialchars($_POST['location']) : null;
        $opis = !empty($_POST['description']) ? htmlspecialchars($_POST['description']) : null;

        $putanja_slike = null;

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

            $folder = 'uploads/';

            $nova_putanja = $folder . basename($_FILES['photo']['name']);
            //return je bool
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $nova_putanja)) {
                $putanja_slike = $nova_putanja;
            } else {
                $putanja_slike = null;
            }
        }

        $podaci = [$naziv, $vrsta, $starost, $kontakt, $lokacija, $opis, $putanja_slike];
        $boolinsert = false;

        if (!in_array(null, $podaci, true)){
            $stmt = $conn->prepare("INSERT INTO added_animals (naziv, vrsta, starost, kontakt, lokacija, detalji, slika) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", ...$podaci);

            if ($stmt->execute()) {
                $boolinsert = true;
            } else {
                echo "Greška kod unosa: " . $stmt->error;
            }

            $stmt->close();
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body class="admin_body">
<header>
    <nav class="admin_header">
        <a href="index.php">
            <img src="images_home/temp_logo.webp" alt="logo udruge" id="header_logo">
        </a>
            <ul class="nav_links_center">
                <li><a href="kategorija.php?vrsta=mačka">MAČKE</a></li>
                <li><a href="kategorija.php?vrsta=pas">PSI</a></li>
                <li><a href="kategorija.php?vrsta=zec">ZEČEVI</a></li>
                <li><a href="kategorija.php?vrsta=ptica">PTICE</a></li>
                <li class="test"><a href="kategorija.php?vrsta=drugo">OSTALI</a></li>
            </ul>
            <ul class="nav_links">
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

    <section class="show_box">
        <div>
            <section class="show_content">
                <h2><?= $naziv  ?></h2>
                <p><strong>Vrsta:</strong> <?=$vrsta?></p>
                <p><strong>Starost:</strong> <?=$starost?></p>
                <p><strong>kontakt:</strong> <?=$kontakt?></p>
                <p><strong>Lokacija:</strong> <?=$lokacija?></p>
                <p><strong>Detalji vlasnika:</strong> <?=$opis?></p>
                <?php if ($putanja_slike): ?>
                    <img src="<?= $putanja_slike ?>" alt="Slika životinje" style="max-width:300px;">
                 <?php endif; ?>

                <?php if ($boolinsert) {
                    echo "<p style='color:green;'>Životinja je uspješno dodana u bazu.</p>";
                }?>
                
            </section>
        </div>
    </section>

    <footer>
        <div>
        <strong><p>&copySpasi.me</p></strong>
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