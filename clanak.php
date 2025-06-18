<?php
    session_start();
    include "connect.php";

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $query = "SELECT * FROM added_animals WHERE id = $id";

    $result = $conn->query($query)
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
    <section class="show_box">
        <div>
            <?php while ($row = mysqli_fetch_array($result)): ?>
            <section class="show_content">
                <h2><?= htmlspecialchars($row['naziv']) ?></h2>
                <p><strong>Vrsta:</strong> <?= htmlspecialchars($row['vrsta']) ?></p>
                <p><strong>Starost:</strong> <?= htmlspecialchars($row['starost']) ?></p>
                <p><strong>Kontakt:</strong> <?= htmlspecialchars($row['kontakt']) ?></p>
                <p><strong>Lokacija:</strong> <?= htmlspecialchars($row['lokacija']) ?></p>
                <p><strong>Opis vlasnika:</strong> <?= htmlspecialchars($row['detalji']) ?></p>
                <?php if (!empty($row['slika'])): ?>
                    <img src="<?= htmlspecialchars($row['slika']) ?>" alt="Slika životinje" style="max-width:400px;">
                <?php endif; ?>
            </section>
        <?php endwhile; ?>

        </div>
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