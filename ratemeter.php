<?php

function upper($string) {
  // true if lowercasing changes string
  return strtolower($string) != $string;
}

function lower($string) {
  // true if uppercasing changes string
  return strtoupper($string) != $string;
}

function num($string) {
  return preg_match_all("/[0-9]/", $string);
}

function symbol($string) {
  // You have to decide which symbols count
  // Regex \W is any non-letter, non-number: too broad
  // Better to list the ones that count
  return preg_match_all("/\W/", $string);
}


function strength($password) {
  $strength = 0;
  $max_points = 12;
  $length = strlen($password);

  if(upper($password)) {
    $strength += 1;
  }
  if(lower($password)) {
    $strength += 1;
  }

  $strength += min(num($password), 2);
  $strength += min(symbol($password), 2);

  if($length >= 8 )
  {
  $strength += 2;
    $strength += min(($length -8) * 0.5, 4);
  }

  $strength_percent = $strength /(float) $max_points;
  $rating = floor($strength_percent * 10);
  return $rating;
}

$password = $_POST["rate"];
$rating = strength($password);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Password Strength Meter</title>
  </head>
  <body>

    <p>Your password rating is: <?php echo $rating; ?>

    <p>Rate the strength of your password:</p>
    <form action="" method="post">
      Password: <input type="text" name="rate" value="" /><br />
      <input type="submit" value="Submit" />
    </form>
<p>For generation for a random password <a href="support.html">click here</a>
  </body>
</html>
