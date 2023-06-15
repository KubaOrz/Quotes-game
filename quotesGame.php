<!DOCTYPE html>
<html>
<head>
  <title>Strona z obrazkiem i cytatem</title>
  <script type="module">
    import {closePopup} from './javascript/popUp.js';
    const nextQuoteButton = document.getElementById("nextQuoteButton");
    nextQuoteButton.addEventListener('click', closePopup);
  </script>
  <link rel="stylesheet" type="text/css" href="style/popUpStyle.css">
  <link rel="stylesheet" type="text/css" href="style/quotesGameStyle.css">
</head>
<body>
  <?php
    require "getQuote.php";
    require "getAuthorImage.php";
    

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $quoteRecord = getRandomQuote();
      $quote = $quoteRecord["quote"];
      $author = $quoteRecord["author"];
      $authorImagePath = getAuthorImage($author);
    }
  ?>

  <h1>Człowiek czy AI?</h1>

  <h2><?php echo $author ?></h2>

  <img src="<?php echo $authorImagePath ?>" alt="Obrazek">

  <div id="quote">
    <?php echo $quote ?>
  </div>

  <div id="buttons">
    <button class="button" id="trueButton">Człowiek</button>
    <button class="button" id="falseButton">AI</button>
  </div>

  <script type="module">
    import {validateAnswer} from './javascript/validateAnswer.js'
    document.getElementById("trueButton").addEventListener('click', 
      () => validateAnswer(true, <?php echo $quoteRecord['is_real'] == 1 ? 'true' : 'false' ?>));
    document.getElementById("falseButton").addEventListener('click', 
      () => validateAnswer(false, <?php echo $quoteRecord['is_real'] == 1 ? 'true' : 'false' ?>));
  </script>

  <div class="overlay" id="overlay"></div>

  <div class="popup" id="popup">
    <h2 id = "answer"> </h2>
    <p id = "desc"> </p>
    <form action="quotesGame.php" method="GET">
      <input class="button" id="nextQuoteButton" type="submit" value="Kolejny cytat">
    </form>
  </div>

</body>
</html>
