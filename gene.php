<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>password genertor</title>
  </head>
  <body>
<?php


function char($string) {
  //echo char($char);
  $i = mt_rand(0, strlen($string)-1);
  return $string[$i];
}

function string($length, $char_set) {
  $output = '';
  for($i=0; $i < $length; $i++) {
    $output .= char($char_set);
  }
  return $output;
}
//echo string(10,$char);
function gene($length)
{
  // define character sets
  $lower = 'abcdefghijklmnopqrstuvwxyz';
  $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $numbers = '0123456789';
  $symbols = '!@#$%^&*_-+=';

  // extract configuration flags into variables
  $use_lower = isset($_GET['lower']) ? $_GET['lower'] : '0';
  $use_upper = isset($_GET['upper']) ? $_GET['upper'] : '0';;
  $use_numbers = isset($_GET['numbers']) ? $_GET['numbers'] : '0';;
  $use_symbols = isset($_GET['symbols']) ? $_GET['symbols'] : '0';;

  $chars = '';
  if($use_lower == '1') { $chars .= $lower; }
  if($use_upper == '1') { $chars .= $upper; }
  if($use_numbers == '1') { $chars .= $numbers; }
  if($use_symbols == '1') { $chars .= $symbols; }

  return string($length, $chars);
}

$password = gene($_GET['length']);

?>

<p>Generated Password: <?php echo $password;?></p>

<p>Generate new password using the form options:  </p>

<form action="" method="get">
  Length: <input type="text" name="length" value="
  <?php  if(isset($_GET["length"])){echo $_GET["length"];} ?>"/><br/>

  <input type="checkbox"  name= "lower" value ="1"
  <?php if($_GET["lower"]==1)
  {echo "checked";} ?>/>Lowercase<br/>

  <input type="checkbox"  name= "upper" value ="1"<?php if($_GET["upper"]==1)
  {echo "checked";} ?> />Uppercase<br/>

  <input type="checkbox"  name ="numbers" value ="1"<?php if($_GET["numbers"]==1)
  {echo "checked";} ?> />Numbers<br/>

  <input type="checkbox"  name ="symbols" value ="1" <?php if($_GET["symbols"]==1)
  {echo "checked";} ?> /> Symbols<br/>

  <input type="submit" value="submit"/>
</form>


  </body>
</html>
