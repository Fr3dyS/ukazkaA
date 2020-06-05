<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Plán akci</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="validate.js"></script>
</head>

<body>
    <div class="header">
        <h2>Přidávání akcí do databáze</h2>
    </div>

    <form method="post" id="eee" action="akce.php">
        <?php include('errory.php'); ?>
        <div class="input-group">
            <label>Datum začátku:</label>
            <input type="date" name="dateStart">
        </div>
        <div class="input-group">
            <label>Datum konce:</label>
            <input type="date" name="dateKonec">
        </div>
        <div class="input-group">
            <label>Místo konání:</label>
            <input type="text" name="misto">
        </div>
        <div class="input-group">
            <label>Název akce:</label>
            <input type="text" name="akce">
        </div>
        <div class="input-group">
            <label>Typ akce:</label>
            <input type="text" name="typ">
        </div>
        <div class="input-group">
            <label>Cena:</label>
            <input type="number" name="cena">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="pridavaniDoDB">Přidej do databáze</button>
            <a href="index.php" class="red">Zpět na hlavní menu</a>
        </div>
    </form>
    <script>
        $("#eee").validate({
            rules: {
                dateStart: {
                    date: true,
                    required: true
                },
                dateKonec: {
                    date: true,
                    required: true
                },
                misto:{
                    required: true,
                    minlength:2,
                },
                akce: {
                    required: true,
                    minlength:2
                },
                typ: {
                    required: true
                },
                cena: {
                    required: true
                }
            },
            messages:{
                dateStart:{
                    required: "zadej datum startu",
                    date: "Zadej datum!"
                }, 
                dateKonec: {
                    date: "Zadej datum!",
                    required: "zadej datum konce"
                },
                misto:{
                    required: "Zadej misto akce",
                    minlength: "misto musí mít minimálně 2 znaky",
                },
                akce: {
                    required: "Zadej název akce",
                    minlength:"Název musí mít minimálně 2 znaky"
                },
                typ: {
                    required: "Zadej typ akce",
                },
                cena: {
                    required: "Zadej cenu"
                }
            }
        });
    </script>
</body>

</html>