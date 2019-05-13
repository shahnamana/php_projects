<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>readable password</title>
  </head>
  <body>

  </body>
</html>

<?php

function read($filename="") {
  // can use full path or relative path
  $dictionary_file = "mine/{$filename}";
  return file($dictionary_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

function pick_random($array) {
  // array_rand() uses rand() & libc random number generator
  // which is slower, less random than mt_rand().
  // $i = array_rand($array);
  $i = mt_rand(0, count($array) -1);
  return $array[$i];
}

function symbol() {
  $symbols = '$*?!-';
  $i = mt_rand(0, strlen($symbols) -1);
  return $symbols[$i];
}

function num($digits=1) {
  $min = pow(10, ($digits -1)); // e.g. 1000
  $max = pow(10, $digits) - 1;  // e.g. 9999
  return strval(mt_rand($min,$max));
}

function filter($array, $length) {
  $select_words = array();
  foreach($array as $word) {
    if(strlen($word) == $length) {
      $select_words[] = $word;
    }
  }
  return $select_words;
}

function word($words, $length) {
  $select_words = filter($words, $length);
  return pick_random($select_words);
}

$basic_words = read('friendly_words.txt');
$brand_words = read('soap.txt');

$words = array_merge($brand_words, $basic_words);
// could use array_unique()

$length = 9;
$word_count = 2;
$digit_count = 1;
$symbol_count = 1;
$avg_wlength = ($length - $digit_count - $symbol_count) / $word_count;

$password = "";

$next_wlength = mt_rand($avg_wlength -1, $avg_wlength +1);
$password .= word($words, $next_wlength);

$password .= symbol();
$password .= num($digit_count);

$next_wlength = $length - strlen($password);
$password .= word($words, $next_wlength);

echo "Friendly password: " . $password . "<br />";
echo "Length: " . strlen($password) . "<br />";

?>

<?php
