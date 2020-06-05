<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Delete</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="validate.js"></script>
</head>

<body>
    <div class="header">
        <h2>Odebírání akcí podle ID</h2>
    </div>

    <form method="post" id="fg" action="delete.php">
        <?php include('errory.php');        ?>
        <div class="input-group">
            <label>ID:</label>
            <input type="number" name="deleteID">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="mazaniZDB">Odeber akci podle ID</button>
        </div>
        <div> Můžete odstranit akci s id :
            <?php

            $db = new mysqli('localhost', 'root', '', 'pololetka');
            $sql = "SELECT Id_akce FROM `akce`";
            $result = mysqli_query($db, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    echo $row['Id_akce'] . ". ";
                    if (isset($_POST['mazaniZDB'])) {
                        $id = mysqli_real_escape_string($db, $_POST['deleteID']);

                        if (count($error) == 0) {
                            $sqlL = "SELECT * FROM akce WHERE id_akce='$idD';";
                            $sql = "DELETE FROM akce WHERE id_akce='$id';";
                            $results = mysqli_query($db, $sql);
                            if ($_POST["deleteID"] == $row['Id_akce']) {
                                header('Location: index.php');
                            } else {
                                header('Location: delete.php');
                            }
                        }
                    }
                }
            }
            ?>
        </div>
        <p><a href="index.php">Zpět na hlavní menu</a></p>
    </form>
    <script>
        $("#fg").validate({
            rules: {
                deleteID: {
                    required: true,
                }
            },
            messages: {
                deleteID: {
                    required: "nebylo vloženo id",
                }
            }
        });
    </script>
</body>

</html>