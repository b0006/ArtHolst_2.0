<?php

if(empty($_POST['contact']))
    die("Ошибка, что-то неверно заполнено :(");

/**
 * Отправка письма с вложением
 * @param string $mailTo
 * @param string $from
 * @param string $subject
 * @param string $message
 * @param string|bool $file - не обязательный параметр, путь до файла
 *
 * @return bool - результат отправки
 */

function sendMailAttachment($mailTo, $from, $subject, $message, $file = false){
    $separator = "---"; // разделитель в письме
    // Заголовки для письма
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: $from\nReply-To: $from\n"; // задаем от кого письмо
    $headers .= "Content-Type: multipart/mixed; boundary=\"$separator\""; // в заголовке указываем разделитель
    // если письмо с вложением
    if($file){
        $bodyMail = "--$separator\n"; // начало тела письма, выводим разделитель
        $bodyMail .= "Content-type: text/html; charset='utf-8'\n"; // кодировка письма
        $bodyMail .= "Content-Transfer-Encoding: quoted-printable"; // задаем конвертацию письма
        $bodyMail .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode(basename($file))."?=\n\n"; // задаем название файла
        $bodyMail .= $message."\n"; // добавляем текст письма
        $bodyMail .= "--$separator\n";
        $fileRead = fopen($file, "r"); // открываем файл
        $contentFile = fread($fileRead, filesize($file)); // считываем его до конца
        fclose($fileRead); // закрываем файл
        $bodyMail .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode(basename($file))."?=\n";
        $bodyMail .= "Content-Transfer-Encoding: base64\n"; // кодировка файла
        $bodyMail .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode(basename($file))."?=\n\n";
        $bodyMail .= chunk_split(base64_encode($contentFile))."\n"; // кодируем и прикрепляем файл
        $bodyMail .= "--".$separator ."--\n";
        // письмо без вложения
    }else{
        $bodyMail = $message;
    }
    $result = mail($mailTo, $subject, $bodyMail, $headers); // отправка письма
    return $result;
}


// проверяем правильности заполнения с помощью регулярного выражения
// от кого будет сообщение
if (!preg_match("/[A-Za-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?\.)+[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?/", $_POST['contact'])){
    $from = "akasikov@yandex.ru";
}
else {
    $from = $_POST['contact'];
}

$message = "";
$choosenType = "Выбраны: \n";
foreach ($_REQUEST as $key => $item) {
    //$test .= $key;

    if($key == "fullname") {
        $message .= "\n Клиент: " . $item;
    }
    elseif($key == "contact") {
        $message .= "\n Контакты: " . $item;
    }
    else {
        $choosenType .= " " . $item . "\n";
    }
}

$mailTo = "qsefthuken@gmail.com"; // кому
$subject = "Заказ Art Holst"; // тема письма
$message = "Новый заказ:" . $message . "\n" . $choosenType; // текст письма

$picture = "";
// Если поле выбора вложения не пустое - закачиваем его на сервер
if (!empty($_FILES['image_file']['tmp_name']))
{
    // Закачиваем файл
    $path = $_FILES['image_file']['name'];
    if (copy($_FILES['image_file']['tmp_name'], $path)) {
        $picture = $path;
    }

    $r = sendMailAttachment($mailTo, $from, $subject, $message, $picture); // отправка письма c вложением
    echo ($r)?'Письмо отправлено с вложением':'Ошибка. Письмо не отправлено!';
}
else {
    $r = sendMailAttachment($mailTo, $from, $subject, $message); // отправка письма без вложения
    echo ($r)?'Письмо отправлено':'Ошибка. Письмо не отправлено!';
}

?>

