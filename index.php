<?php

$new_file = $_FILES['file']['name'];

if (copy($_FILES['file']['tmp_name'], $new_file)) {
    echo "Файл загружен";
}
else {
    echo "Ошибка при загрузке файла";
}

function words_wo_symbols($a) //Удаляет символы в строке
{
    $words_WO_simbols1 = str_replace([".", ",", "?", "!"],"",$a);
    $words_WO_simbols = str_replace([ "\r\n","\r","\n"], ' ', $words_WO_simbols1);
    return($words_WO_simbols);
}

function count_word($fixedtext)  //Вычисляет количество вхождений каждого слова в тексте
{
    $output = explode(" ", $fixedtext);
    $maxword = array_count_values($output);
    output_count_word($maxword);
}

function output_count_word($maxword) //Выводит количество вхождений каждого слова
{
    print_r ($maxword) . PHP_EOL;
}

function output_maxwords($words)  //Выводит макс количество слов
{
    echo "Всего слов : ", $words . PHP_EOL;
}

function file_csv($a)  //Записывает слова, а так же значения с формы файла в file.csv
{
    $words_WO_simbols = words_wo_symbols($a);
    $words_lower = mb_strtolower($words_WO_simbols);
    $output = explode(" ", $words_lower);
    $output = array_count_values($output);

    $fp = fopen(__DIR__ . DIRECTORY_SEPARATOR . 'file.csv', 'w');
    foreach ($output as $word => $count){
        fputcsv($fp, [$word,$count], ',');
    }
    fclose($fp);
    // перемещение файла
    $file = 'file.csv';
    $new_name = 'texts/file.csv';
    if (rename($file, $new_name)) {
        echo "Файл успешно перемещен!" . PHP_EOL;
    }else{
        echo "Файл не удалось переместить!" . PHP_EOL;
    }
}

function textarea_csv($b)  //Записывает слова, а так же значения с формы textarea в textarea.csv
{
    $words_WO_simbols = words_wo_symbols($b);
    $words_lower = mb_strtolower($words_WO_simbols);
    $output = explode(" ", $words_lower);
    $output = array_count_values($output);

    $fp = fopen(__DIR__ . DIRECTORY_SEPARATOR . 'textarea.csv', 'w');
    foreach ($output as $word => $count) {
        fputcsv($fp, [$word, $count], ',');
    }
    fclose($fp);
    // перемещение файла
    $file = 'textarea.csv';
    $new_name = 'texts/textarea.csv';
    if (rename($file, $new_name)) {
        echo "Файл успешно перемещен!" . PHP_EOL;
    }else{
        echo "Файл не удалось переместить!" . PHP_EOL;
    }
}

$a = file_get_contents($_FILES['file']['name'],'$file_tmp');
$b = $_POST['description'];

//Проверка загруженного текста

if (empty($a) && empty($b)) {
    echo "Текст не найден" . PHP_EOL;
}
if (!empty($a)){
    textarea_csv($a);
}
if (!empty($b)){
    file_csv($b);
}
?>

<!DOCTYPE html>
<html lang = "ru">
<head>
    <meta charset = "utf-8"/>
    <title>Задание 2</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" > <br>
    <textarea name="description">default</textarea>
    <input type="submit">
    <ul>
        <li>Sent file: <?php echo $_FILES['file']['name'];?></li>
        <li>File size: <?php echo $_FILES['file']['size'];?></li>
        <li>File type: <?php echo $_FILES['file']['type'];?></li>
    </ul>
</form>
</body>