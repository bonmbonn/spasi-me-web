<?php 
    session_start();
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
    <section class="admin_form_box">
        <form action="skripta.php" method="POST" enctype="multipart/form-data">
            <label>
                Ime životinje:
                <input type="text" name="animal_name" placeholder="Ime životinje" required>
            </label><br><br>

            <label>
                Vrsta životinje:
                <select name="animal_type" required>
                    <option value="">Odaberite vrstu</option>
                    <option value="pas">Pas</option>
                    <option value="mačka">Mačka</option>
                    <option value="zec">Zec</option>
                    <option value="ptica">Ptica</option>
                    <option value="drugo">Drugo</option>
                </select>
            </label><br><br><br>

            <label>
                Godine:
                <input type="number" name="age" placeholder="Godine" min="0" required>
            </label><br><br>

            <label>
                Broj kontakta:
                <input type="tel" name="contact_number" placeholder="Broj kontakta" required>
            </label><br><br>

            <label>
                Lokacija:
                <input type="text" name="location" placeholder="Lokacija" required>
            </label><br><br>

            <label>
                Opis životinje:<br><br>
                <textarea name="description" placeholder="Kratki opis životinje" rows="4" required></textarea>
            </label><br><br>

            <label>
                Slika životinje:
                <input type="file" name="photo" required>
            </label><br><br>

            <label>
                Prikaži na portalu?
                <input type="checkbox" name="active">
            </label>

            <button type="submit">Dodaj životinju</button>
        </form>

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