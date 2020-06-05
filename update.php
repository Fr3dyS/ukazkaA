<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="validate.js"></script>
</head>

<body>
    <div class="header">
        <h2>Aktualizace dat do DB</h2>
    </div>

    <form method="post" id="fg" action="update.php">
        <?php include('errory.php'); ?>
        <div class="input-group">
            <label>zadání id pro ověření:</label>
            <input type="number" name="id">
        </div>
        <div class="input-group">
            <label>aktualizovat místo akce:</label>
            <input type="text" name="updateNazev">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="updateDat">Aktualizace dat v databazi</button>
            <a href="index.php" class="btn red">Zpět na hlavní menu</a>
        </div>
        
        Můžete aktualizovat akci s id :
        <?php

        $db = new mysqli('localhost', 'root', '', 'pololetka');
        $sql = "SELECT Id_akce FROM `akce`";
        $result = mysqli_query($db, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['Id_akce'] . ". ";
                if (isset($_POST['updateDat'])) {
                    $nazev = mysqli_real_escape_string($db, $_POST['updateNazev']);
                    $id =  mysqli_real_escape_string($db, $_POST['id']);
                    if (count($error) == 0) {
                        $sqlL = "SELECT * FROM akce WHERE id_akce='$idD';";
                        $sql = "UPDATE akce SET misto='$nazev' WHERE id_akce='$id';";
                        if ($_POST["updateNazev"] == $row['Id_akce'])  {
                            header('Location: index.php');
                        } else {
                            header('Location: update.php');
                        }
                    }
                }
            }
        }
        ?>
    </form>
    <script>
        $("#fg").validate({
            rules: {
                id: {
                    required: true,
                },
                updateNazev: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                id: {
                    required: "nebylo vloženo id",
                },
                updateNazev: {
                    required: "nebyl vložen nový název",
                    minlength: "Název musí být větší jak dva znaky"
                }
            }
        });
    </script>
</body>

</html>