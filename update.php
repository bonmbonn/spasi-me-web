    <?php 
        session_start();
        include "connect.php";
        $id = $_POST['id'] ?? '';
        $name = $_POST['naziv'] ?? '';
        $type = $_POST['vrsta'] ?? '';
        $age = $_POST['godine'] ?? '';
        $contact = $_POST['kontakt'] ?? '';
        $location = $_POST['lokacija'] ?? '';
        $description = $_POST['detalji'] ?? '';
        $active = isset($_POST['aktivno']) && $_POST['aktivno'] == 'on' ? 1 : 0;
        $updated = false;


        $photo = $_POST['trenutna_slika'] ?? '';
        if (isset($_FILES['slika']) && $_FILES['slika']['error'] == 0) {
            $folder = 'uploads/';
            $filename = basename($_FILES['slika']['name']);
            $nova_putanja = $folder . $filename;

            if (move_uploaded_file($_FILES['slika']['tmp_name'], $nova_putanja)) {
                $photo = $nova_putanja;
            }
        }


        if ($id != '') {
            $id = $conn->real_escape_string($id);
            $name = $conn->real_escape_string($name);
            $type = $conn->real_escape_string($type);
            $contact = $conn->real_escape_string($contact);
            $location = $conn->real_escape_string($location);
            $description = $conn->real_escape_string($description);
            $photo = $conn->real_escape_string($photo);

            $result = $conn->query("UPDATE added_animals 
                SET naziv='$name', 
                    vrsta='$type', 
                    starost='$age', 
                    kontakt='$contact', 
                    lokacija='$location', 
                    detalji='$description', 
                    slika='$photo', 
                    aktivno='$active' 
                WHERE id=$id");

            $updated = ($result == true);
        }   
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Document</title>
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
                        <li><a href="unos.php">DODAJ ŽIVOTINJU</a></li>
                        <li><a href="administrator.php">UREDI ŽIVOTINJE</a></li>
                    </ul>
                </nav>

                <?php 
                    if ($updated) {
                        echo "<div class='deleted_txt'>";
                            echo "<h2>Uspješno ažurirano</h2>";
                        echo "</div>";
                    } else {
                        echo "<div class='deleted_txt'>";
                            echo "<h2>Nije ažurirano</h2>";
                        echo "</div>";
                    }
                ?>
            </header>

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