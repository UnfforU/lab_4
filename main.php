<!DOCTYPE html>
<html lang="en">
<head>
    <meta CHARSET="UTF-8">
    <title>Lab_4</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="main.php" method="post">
        <div id="div_inpt">
            <textarea name="inputTxt" class="inputTxt"  type="text" ></textarea>
        </div>
        <h3>После обработки: </h3>
        <h4>
            <div id="blue"></div>
            <p id="blue_txt"> целое число</p>
        </h4>
        <h4>
            <div id="red"></div>
            <p id="red_txt"> дробное число (округл. до десятых)</p>
        </h4>
        <input type="submit" value="Обработать"></br>
    </form>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $output = htmlspecialchars($_POST['inputTxt']);

    echo '</br>'.'Исходный текст</br>' . $output . '</br>';

    preg_match_all('#[0-9]*[.,][0-9]+#', $output, $float_numbers);
    $float_numbers = $float_numbers[0];
    $round_numbers = $float_numbers;

    foreach ($round_numbers as &$var) {
        $var = round($var, 1);
    }

    for ($i = 0; $i < count($float_numbers); $i++) {
        $float_var = $float_numbers[$i];
        $round_var = $round_numbers[$i];
        $output = preg_replace("/" . $float_var . "/", '<span style="color: red">' . $round_var . '</span>', $output);
    }

    $output = preg_replace('#((?<![-.])\b[0-9]+\b(?!\.[0-9]))#', '<span style="color: blue">$1</span>', $output);
    echo '</br>'.'Результат</br>' . $output . '</br>';
}