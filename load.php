<?php
$pdo = new PDO ('mysql:dbname=texts;host=localhost:3306', 'root','root');
$insertQueryWords = 'INSERT INTO 
`words`(`text_id`,`word`,`count`, `date`) 
VALUES (?,?,?, NOW())';

$insertQueryUploaded_Text = 'INSERT INTO 
`uploaded_text`(`content`,`date`,`words_count`)
VALUES (?,NOW(),?)';

$insertQueryWordsDB = $pdo -> prepare($insertQueryWords);
$insertQueryUploaded_TextDB = $pdo -> prepare($insertQueryUploaded_Text);
$new_file = $_FILES['file']['name'];

function Words($b)          //Вычисляет количество слов в тексте
{
    $words = count( explode(' ', $b) );
    return($words);
}

function normal_form_text($b) //Удаляет символы в строке
{
    $result = mb_strtolower($b);
    $result = str_replace([".", ",", "?", "!", "\r\n", "\r", "\n"],"",$result);
    $result = explode(' ', $result);
    $result = array_count_values($result);
    return($result);
}

function insert_into_DB($b, $insertQueryWordsDB, $insertQueryUploaded_TextDB, $pdo)  //Записывает слова, а так же значения с формы файла в file.csv
{
    $words = Words($b);
    $insertQueryUploaded_TextDB ->execute([$b,$words]);
    $result = normal_form_text($b);
    $text_id = $pdo -> lastInsertId();
    foreach ($result as $word => $count){
        $insertQueryWordsDB ->execute([$text_id,$word, $count]);
    }
}

$a = file_get_contents($_FILES['file']['name'],'$file_tmp');
$b = $_POST['description'];

//Проверка загруженного текста
if (!empty($a)) {
    insert_into_DB($a, $insertQueryWordsDB, $insertQueryUploaded_TextDB, $pdo);
}
if (!empty($b)) {
    insert_into_DB($b, $insertQueryWordsDB, $insertQueryUploaded_TextDB, $pdo);
}
?>

<!DOCTYPE html>
<html lang = "ru">
<head>
    <meta charset = "utf-8"/>
    <title>Страница Загрузки</title>
</head>
<body>
<form action="/mainpage.php" target="_blank">
    <button>Главная</button>
</form>
<form  method="post" enctype="multipart/form-data">
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