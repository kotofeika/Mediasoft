<?php
function Words($a)          //Вычисляет количество слов в тексте
{
    $words = count( explode(' ', $a) );
    output_maxwords($words);
}

function words_wo_symbols($a) //Удаляет символы в строке
{
    $words_WO_simbols = str_replace(array( "\r\n","\r","\n",".", ",", "?", "!"),"",$a);
    return($words_WO_simbols);
}

function count_word($fixedtext)  //Вычисляет количество вхождений каждого слова в тексте
{
    $output = explode(" ", $fixedtext);
    $maxword = array_count_values($output);
    output_count_word($maxword);
}
function output_count_word( $maxword) //Выводит количество вхождений каждого слова
{
    print_r ($maxword) . PHP_EOL;
}

function output_maxwords($words)
{
    echo "Всего слов : ", $words . PHP_EOL;
}
$a = "Я обманывать себя не стану, 
Залегла забота в сердце мглистом. 
Отчего прослыл я шарлатаном? 
Отчего прослыл я скандалистом? 
Не злодей я и не грабил лесом, 
Не расстреливал несчастных по темницам. 
Я всего лишь уличный повеса, 
Улыбающийся встречным лицам. 
Я московский озорной гуляка. 
По всему тверскому околотку 
В переулках каждая собака 
Знает мою легкую походку.";   //73

$words = Words($a);
$words_WO_simbols = words_wo_symbols($a);
$words_lower = mb_strtolower($words_WO_simbols);
count_word($words_lower);
?>