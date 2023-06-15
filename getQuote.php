<?php

function getRandomQuote() {

    $servername = "db";
    $username = "kuba";
    $password = "B9olP6_&";
    $dbname = "quotes_game";
    $port = "3306";

    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("Nieudane połączenie z bazą danych: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM quotes ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $author = trim($row["author"]);
            $quote = trim($row["quote"]);
            return $row;
        }
    } else {
        echo "Brak dostępnych cytatów";
    }

    $conn->close();
}

?>