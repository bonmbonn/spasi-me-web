<?php
    include "connect.php";

    $id = $_GET['id'] ?? '';
    $animal = null;

    if ($id !== '') {
        $result = $conn->query("SELECT * FROM added_animals WHERE id = $id");

        if ($result && $result->num_rows > 0) {
            $animal = $result->fetch_assoc();
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

            </ul>
        </nav>
    </header>

    <section class="admin_form_box">
        <form action="update.php" method="POST" enctype="multipart/form-data">
        <label>
            Ime životinje:
            <input type="text" name="naziv" value="<?= htmlspecialchars($animal['naziv'] ?? '') ?>" required>
        </label><br><br>

        <label>
            Vrsta životinje:
            <select name="vrsta" required>
                <option value="">Odaberite vrstu</option>
                <option value="pas" <?= ($animal['vrsta'] ?? '') == 'pas' ? 'selected' : '' ?>>Pas</option>
                <option value="mačka" <?= ($animal['vrsta'] ?? '') == 'mačka' ? 'selected' : '' ?>>Mačka</option>
                <option value="zec" <?= ($animal['vrsta'] ?? '') == 'zec' ? 'selected' : '' ?>>Zec</option>
                <option value="ptica" <?= ($animal['vrsta'] ?? '') == 'ptica' ? 'selected' : '' ?>>Ptica</option>
                <option value="drugo" <?= ($animal['vrsta'] ?? '') == 'drugo' ? 'selected' : '' ?>>Drugo</option>
            </select>
        </label><br><br><br>

        <label>
            Godine:
            <input type="number" name="godine" value="<?= htmlspecialchars($animal['starost'] ?? '') ?>" min="0" required>
        </label><br><br>

        <label>
            Broj kontakta:
            <input type="tel" name="kontakt" value="<?= htmlspecialchars($animal['kontakt'] ?? '') ?>" required>
        </label><br><br>

        <label>
            Lokacija:
            <input type="text" name="lokacija" value="<?= htmlspecialchars($animal['lokacija'] ?? '') ?>" required>
        </label><br><br>

        <label>
            Opis životinje:<br><br>
            <textarea name="detalji" rows="4" required><?= htmlspecialchars($animal['detalji'] ?? '') ?></textarea>
        </label><br><br>

        <label>
            Unesi novu sliku:
            <input type="file" name="slika">
            <br>Trenutna slika:
            <img src="<?= $animal['slika'] ?>" alt="" style = "max-width: 250px;">
        </label><br><br>

        <label>
            Prikaži na portalu?
            <input type="checkbox" name="aktivno" <?= ($animal['aktivno'] ?? 0) == 1 ? 'checked' : '' ?>>
        </label>

            <button type="submit">Dodaj životinju</button>
            <input type="hidden" name="id" value="<?= htmlspecialchars($animal['id'] ?? '') ?>">
            <input type="hidden" name="trenutna_slika" value="<?= htmlspecialchars($animal['slika'] ?? '') ?>">
        </form>
    </section>

</body>
</html>