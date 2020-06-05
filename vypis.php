<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výpis z databaze</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="header">
        <h2>Výpis z databaze</h2>
    </div>
    <div class="content">
        <?php
        $test = "";
        $db = new mysqli('localhost', 'root', '', 'pololetka');
        $sql = "SELECT * FROM akce;";
        $result = mysqli_query($db, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class= 'aa'>";
                echo "<div class= 'aa'>" . "Misto konani: " . $row['misto'] . "</div>";
                echo "<h4>" . "Nazev akce: " . $row['nazev'] . "</h4>";
                echo "<h4>" . "Datum zacatku: " . $row['dat_start'] . "</h4>";
                echo "<h4>" . "Datum konce :" . $row['dat_konec'] . "</h4>";
                echo "<h4>" . "cena :" . $row['cena'] . "</h4>";
                echo "<div class= 'aa'>" . "Typ akce:" . $row['typ_akce'] . "</div>";
                echo "<br>";
            }
        }
        
        echo "--------------------------------------------------------------------------";
        $groupByUzivatel = "SELECT jmeno FROM uzivatele GROUP BY jmeno";
        $vysledekUzivatel = mysqli_query($db, $groupByUzivatel);
        $vysledekKontrolaUzivatel = mysqli_num_rows($vysledekUzivatel);
        if ($vysledekKontrolaUzivatel > 0) {
            while ($row = mysqli_fetch_assoc($vysledekUzivatel)) {
                echo "<div class='uu' onclick='uu()'>" . "" . $row['jmeno'] . "" . "</div>";
            }
        }
        $groupByAkce = "SELECT nazev FROM akce GROUP BY nazev";
        $vysledekAkce = mysqli_query($db, $groupByAkce);
        $vysledekKontrolaAkce = mysqli_num_rows($vysledekAkce);
        if ($vysledekKontrolaAkce > 0) {
            while ($row = mysqli_fetch_assoc($vysledekAkce)) {
                echo "<div class='ee' onclick='ee()'>" . "" . $row['nazev'] . "" . "</div>";
            }
        }
        ?>
        <p>
            <a href="index.php" class="red">Zpět na hlavní menu</a>
            <button name="nazevAkce" onclick="nazev()" class="Trrr">Group by nazev</button>
            <button name="jmenoUzivatel" onclick="jmeno()" class="Trrr" id="ee">Group by uzivatel</button>
        </p>

    </div>
    <script>
        $(".uu").hide();
        $(".ee").hide();

        $(".Trrr").on("click", function() {
            $(".ee").show();
            $(".uu").hide();
        });
        $("#ee").on("click", function() {
            $(".uu").show();
            $(".ee").hide();
        });
    </script>
</body>

</html>