<?php
// Dane do połączenia z bazą danych MySQL
$servername = "db";
$username = "kuba";
$password = "B9olP6_&";
$dbname = "quotes_game";
$port = "3306";

$attempts = 0;

// Ten skrypt inicjalizuje dane w bazie danych, więc próba połączenia się z bazą jest wykonywana
// co sekundę 10 razy, aby na pewno dane zostały załadowane
while (true) {
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Sprawdzanie połączenia
    if ($conn->connect_error) {
        $attempts++;
        if ($attempts == 10) {
            die("Nieudane połączenie z bazą danych: " . $conn->connect_error);
        }
        sleep(1);
    } else {
        break;
    } 
}

// Adres URL API
$url = "https://api.quotable.io/quotes?author=";

$urls = array(
    "Albert%20Einstein",
    "Bruce%20Lee",
    "Thomas%20Edison",
    "Winston%20Churchill"
);

for ($i = 0; $i < 4; $i++) {
    // Pobieram cytaty autorów z tablicy z publicznego API
    $curl = curl_init($url.$urls[$i]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    // Dekodowanie danych JSON
    $data = json_decode($response, true);

    // Sprawdzanie czy dane zostały pobrane poprawnie
    if ($data && isset($data["results"]) && is_array($data["results"])) {
        foreach ($data["results"] as $result) {
            $author = $result["author"];
            $content = $result["content"];
            
            // Zabezpieczanie danych przed wstrzykiwaniem SQL
            $author = $conn->real_escape_string($author);
            $content = $conn->real_escape_string($content);
            
            // Zapytanie SQL do zapisu danych w bazie
            $sql = "INSERT INTO quotes (author, quote, is_real) VALUES ('$author', '$content', 1)";
            
            if ($conn->query($sql) === FALSE) {
                echo "Błąd podczas zapisywania danych: " . $conn->error;
            }
        }
    } else {
        echo "Błąd podczas pobierania danych z API.";
    }
}

// Pobieram dane wygenerowane przez ChatGPT z plików tekstowych
$files = array(
    "ChatGPT_quotes/Einstein.txt",
    "ChatGPT_quotes/Edison.txt",
    "ChatGPT_quotes/Churchill.txt",
    "ChatGPT_quotes/Bruce.txt",
);

for ($i = 0; $i < 4; $i++) {
    $file = fopen($files[$i], 'r');
    if ($file) {
        $author = trim(fgets($file));
        while (($quote = fgets($file)) !== false) {
            $escapedQuote = mysqli_real_escape_string($conn, $quote);
            $sql = "INSERT INTO quotes (author, quote, is_real) VALUES ('$author', '$escapedQuote', 0)";
            if ($conn->query($sql) === FALSE) {
                echo "Błąd podczas dodawania cytatu do bazy danych: " . $conn->error;
            }
        }
        fclose($file);
    } else {
        echo "Nie udało się otworzyć pliku!";
    }
}

$conn->close();

?>
