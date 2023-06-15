<?php

$authorImages = array(
    "Albert Einstein" => "Albert_Einstein.jpg",
    "Thomas Edison" => "Thomas_edison.jpg",
    "Winston Churchill" => "Winston_Churchill.jpg",
    "Bruce Lee" => "Bruce_Lee.jpg",
);

function getAuthorImage($author) {
    global $authorImages;

    if (isset($authorImages[$author])) {
        $imagePath = "assets/" . $authorImages[$author];
    } else {
        $imagePath = "assets/Albert_Einstein.jpg"; // Obrazek domyślny, gdy nie ma dopasowania
    }
    
    return $imagePath;
}

?>