<?php
header('Content-Type: text/html; charset=UTF-8');
$error = false;
$error2 = false;
$name = '';
$phone = '';
$position = '';


//Город и область посетителя
include("./detect.php");
$place[0] = occurrenceCity();
$place[1] = occurrenceRegion();

//ip посетителя
$ip   = getIp();

//taking info about date

$timestamp = date("Y-m-d H:i:s");

//taking the data from form

if(!empty($_POST['name'])) {
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES);
    if(empty($name)){
        $error = true;
    }
} else {
    $error = true;
}
if(!empty($_POST['phone'])) {
    $phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES);
    if(empty($phone)){
        $error = true;
    }
} else {
    $error = true;
}
if(!empty($_POST['position'])) {
    $position = htmlspecialchars(trim($_POST['position']), ENT_QUOTES);
    if(empty($position)){
        $error = true;
    }
} else {
    $error = true;
}
/*if(isset($_POST['check_form']) && $_POST['check_form'] == 'ok') {
        $check_form = htmlspecialchars(trim($_POST['check_form']), ENT_QUOTES);
    } else {
        $error2 = true;
    }*/
//preparing mail
if(!$error) {
    $from = '';
    $subject = '[Имя сайта] Заявка: '.$position;

    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=utf-8\n";
    $headers .= "Content-Transfer-Encoding: 8bit\n";
    $from = '=?utf-8?B?'. base64_encode($from).'?=';
    $headers .= "From: ".$from." <mderkach.github.io>\n"; 
    $subject = '=?utf-8?B?'. base64_encode($subject).'?=';

    $content = "<html><body><table border='1' style='border-color: #666; border-collapse: collapse;' cellpadding='5'>" .
        "<tr style='background: #eee;'><td><strong>Время заявки:</strong> </td><td>".$timestamp."</td></tr>" .
        "<tr><td><strong>Имя посетителя:</strong> </td><td>".$name."</td></tr>\n\n" .
        "<tr><td><strong>Телефон посетителя:</strong> </td><td>".$phone."</td></tr>\n\n" .
        "<tr><td><strong>IP посетителя:</strong> </td><td>".$ip."</td></tr>\n\n" .
        "<tr><td><strong>Область посетителя:</strong> </td><td>".$place[1]."</td></tr>\n\n" .
        "<tr><td><strong>Город посетителя:</strong> </td><td>".$place[0]."</td></tr>\n\n" .
        "<tr><td><strong>Форма:</strong> </td><td>".$position."</td></tr>\n\n" .
        "</table></body></html>\n\n";


    /**
     * check on robots
     * @input String fields
     * @return 0
     */

    function botShallNotPass( $fields = array() ){
        $checkOnBot = 0;
        foreach( $fields as $field ){
            if ( isset($_POST["$field"]) )
            {
                if ( $_POST["$field"] != "" ){
                    $checkOnBot = 1;
                }
            }
        }
        return $checkOnBot;
    }

    $fieldsarray = array("mail");
    $checker = botShallNotPass($fieldsarray);
    if ( $checker != 1 ){
        mail("derkach94@gmail.com", $subject, $content, $headers);   
    }
    else{
        echo "По всей видимости вы бот:) Вы смогли заполнить скрытые поля, созданные для бота.";
    }

    //redirect to thank-you.html page.
    header('location:../ty.html');
} elseif($error2) {
        echo '<h1>Вы должны принять согласие на обработку персональных данных</h1>';
    } else {
        echo '<h1>Неизвестная ошибка, обратитесь к администратору!</h1>';
    }
?>

