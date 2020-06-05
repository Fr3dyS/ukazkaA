<?php
session_start();
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "pololetka";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS pololetka";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully <br>";
} else {
  echo "Error creating database: " . $conn->error;
}


$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
$sqll = "CREATE TABLE IF NOT EXISTS  uzivatele (
  id_uzivatel INT(30) AUTO_INCREMENT PRIMARY KEY,
  jmeno  CHAR(30) NOT NULL,
  prijmeni CHAR(30) NOT NULL,
  email CHAR(50)  NOT NULL, 
  datum_narozeni DATE  NOT NULL,
  heslo CHAR(50)  NOT NULL)"; 

if ($db->query($sqll) === TRUE) {
  echo "Tabulka uzivatele byla uspesne pridana  <br>";
} else {
  echo "Error creating table: " . $db->error;
}

$db = new mysqli($servername, $username, $password, $dbname);
$sqlll = "CREATE TABLE IF NOT EXISTS akce(
    Id_akce INT(30) AUTO_INCREMENT PRIMARY KEY,
    nazev CHAR(30) NOT NULL,
    dat_start CHAR(30) NOT NULL,
    dat_konec CHAR(50)  NOT NULL,
    cena DECIMAL(6,2)  NOT NULL,
    misto CHAR(50)  NOT NULL,
    typ_akce CHAR(50)  NOT NULL
    )";

if ($db->query($sqlll) === TRUE) {
  echo "Tabulka akce byla uspesne pridana ";
} else {
  echo "Error creating table: " . $db->error;
}

$jmeno = "";
$email = "";
$error = array();

if (isset($_POST['registrovanyUzivatel'])) {
  $jmeno = mysqli_real_escape_string($db, $_POST['jmeno']);
  $prijmeni = mysqli_real_escape_string($db, $_POST['prijmeni']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $heslo = mysqli_real_escape_string($db, $_POST['heslo']);
  $heslo2 = mysqli_real_escape_string($db, $_POST['heslo2']);
  $date = mysqli_real_escape_string($db, $_POST['datum']);

  if ($date > date("Y-m-d")) {
    array_push($error, "Musíš zadat realné narození");
  }

  $user_check_query = "SELECT * FROM uzivatele WHERE jmeno='$jmeno' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($user['jmeno'] === $jmeno) {
      array_push($error, "Jméno už existuje v DB");
    }
    if ($user['prijmeni'] === $prijmeni) {
      array_push($error, "Jméno už existuje v DB");
    }

    if ($user['email'] === $email) {
      array_push($error, "Email existuje v DB");
    }
  }
  if (count($error) == 0) {
    $query = "INSERT INTO uzivatele (id_uzivatel, jmeno, prijmeni, email, datum_narozeni, heslo) 
  			  VALUES('','$jmeno','$prijmeni', '$email', '$date', '$heslo2')";
    mysqli_query($db, $query);
    $_SESSION['jmeno'] = $jmeno;
    $_SESSION['success'] = "Právě si se úspěšně přihlásil";
    header('location: index.php');
  }
}
if (isset($_POST['prihlaseniUzivatel'])) {
  $jmeno = mysqli_real_escape_string($db, $_POST['jmeno']);
  $heslo = mysqli_real_escape_string($db, $_POST['heslo']);

  if (count($error) == 0) {
    $query = "SELECT * FROM uzivatele WHERE jmeno='$jmeno' AND heslo='$heslo'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['jmeno'] = $jmeno;
      $_SESSION['potvrzeno'] = "Právě si se úspěšně přihlásil";
      header('location: index.php');
    } else {
      array_push($error, "Špatné heslo nebo jméno");
    }
  }
}

if (isset($_POST['pridavaniDoDB'])) {
  $datumStartu = mysqli_real_escape_string($db, $_POST['dateStart']);
  $datumKonce = mysqli_real_escape_string($db, $_POST['dateKonec']);
  $mistoKonani = mysqli_real_escape_string($db, $_POST['misto']);
  $nazevAkce = mysqli_real_escape_string($db, $_POST['akce']);
  $typAkce = mysqli_real_escape_string($db, $_POST['typ']);
  $cena = mysqli_real_escape_string($db, $_POST['cena']);



  if ($datumKonce < $datumStartu) {
    array_push($error, "Datum startu musí být menší jak datum konce ");
  }
  if (count($error) == 0) {

    $akce = "INSERT INTO akce (Id_akce, nazev, dat_start, dat_konec, cena, misto, typ_akce) VALUES('','$nazevAkce','$datumStartu', '$datumKonce', '$cena', '$mistoKonani','$typAkce')";
    mysqli_query($db, $akce);
    $_SESSION['uspech'] = "Právě si úspěšně vložil akci do databaze";
    header('location: index.php');
  }
}




if (isset($_POST['updateDat'])) {
  $nazev = mysqli_real_escape_string($db, $_POST['updateNazev']);
  $id =  mysqli_real_escape_string($db, $_POST['id']);
  if ($id <  1) {
    array_push($error, "ID musí být větší jak 1");
  }
  if (count($error) == 0) {
    $sql = "UPDATE akce SET misto='$nazev' WHERE id_akce='$id';";
    if ($db->query($sql) == TRUE) {
      header('Location: index.php');
    } else {
      array_push($error, "Toto mesto neexistuje");
    }
  }
}
$db->close();
$conn->close();
