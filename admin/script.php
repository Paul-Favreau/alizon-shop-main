<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <?php
            include("db_connect.php");
            // récupérer le nombre de client dans la base de donnée
            $sql = "SELECT COUNT(*) FROM client";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            echo "Nombre de client dans la base de donnée: $result";
        ?>
    </body>
</html>