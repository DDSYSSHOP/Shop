<?php

  $_COOKIE['counter']++;
  setcookie("counter",$_COOKIE['counter']);
  echo 'Вы посетили эту страницу '.$_COOKIE['counter'].' раз';
  print_r ($_COOKIE);
?>
<br>
 

<br>
<?php

session_start();
//if (!isset($_SESSION['count'])) {
 // $_SESSION['count'] = 0;
//} else {
 // $_SESSION['count']++;
//}


//$_SESSION['test']='Hello world!';
 //unset($_SESSION['test']);
echo(session_start());
print_r ($_SESSION);
//echo "Вы обновили эту страницу ".$_SESSION['count']." раз.<br>";
//echo "<br><a href=".$_SERVER['PHP_SELF'].">обновить";
//print_r (session_destroy());
?>
<br>
<?php
// Смотрите пример использования password_hash(), для понимания откуда это взялось.
$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Пароль правильный!';
} else {
    echo 'Пароль неправильный.';
}
?>
<br>
<?php
/**
 * Данный код замерит скорость выполнения операции хеширования для вашего сервера
 * с разными значениями алгоритмической сложности для определения максимального
 * его значения, не приводящего к деградации производительности. Хорошее базовое 
 * значение лежит в диапазоне 8-10, но если ваш сервер достаточно мощный, то можно 
 * задать и больше. Данный скрипт ищет максимальное значение, при котором 
 * хеширование уложится в 50 миллисекунд.
 */
$timeTarget = 0.05; // 50 миллисекунд.

$cost = 8;
do {
    $cost++;
    $start = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
} while (($end - $start) < $timeTarget);

echo "Оптимальная стоимость: " . $cost;
?>

<br>
<?php
echo 'Хеш Argon2: ' . password_hash('rasmuslerdorf', PASSWORD_ARGON2I);
?>
<br>
<?php
/* Приведенная соль является только примером. Не используйте эту же соль в вашем коде.
   Вы должны сгенерировать уникальную и правильную соль для каждого пароля.
*/
if (CRYPT_STD_DES == 1) {
    echo 'Стандартный DES: ' . crypt('rasmuslerdorf', 'rl') . "\n<br>";
}

if (CRYPT_EXT_DES == 1) {
    echo 'Расширенный DES: ' . crypt('rasmuslerdorf', '_J9..rasm') . "\n<br>";
}

if (CRYPT_MD5 == 1) {
    echo 'MD5:             ' . crypt('rasmuslerdorf', '$1$rasmusle$') . "\n<br>";
}

if (CRYPT_BLOWFISH == 1) {
    echo 'Blowfish:        ' . crypt('rasmuslerdorf', '$2a$07$usesomesillystringforsalt$') . "\n<br>";
}

if (CRYPT_SHA256 == 1) {
    echo 'SHA-256:         ' . crypt('rasmuslerdorf', '$5$rounds=5000$usesomesillystringforsalt$') . "\n<br>";
}

if (CRYPT_SHA512 == 1) {
    echo 'SHA-512:         ' . crypt('rasmuslerdorf', '$6$rounds=5000$usesomesillystringforsalt$') . "\n<br>";
}
?>

<?
$_COOKIE['name'];
  /* этот cookie действителен в течение 10 мин после создания */
  setcookie("name", $value, time() + 609);
  /* действие этого cookie прекращается в полночь 25 января 2010 года */
  setcookie("name", $value, mktime(0,0,0,01,25,2019));
  /* действие этого cookie прекращается в 18.00 25 января 2010 года */
  setcookie("name", $value, mktime(18,0,0,01,25,2019));
    print_r ($_COOKIE);
	 
?>


//<?php 
//$to  = "han64@ya.ru" ; 
//$to  .= ",evgeniy.khancha@hotmail.com" ; 



//$subject = "121 ту Подтверждение регитрации DDSYS"; 

//$message = ' <p>Текст письма</p> </br> <b>1-ая строчка </b> </br><i>2-ая строчка </i> </br>';

//$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
//$headers .= "From: Магазин DDSYS <info@ddsys.ru>\r\n"; 
//$headers .= "Reply-To: info@ddsys.ru\r\n"; 

//mail($to, $subject, $message, $headers); 
// echo "Отправлен" .$to;
?>
