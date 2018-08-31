<?php
header('Content-Type: text/html; charset=UTF-8');
$error = false;
$name = '';
$email = '';
$ask = '';


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
if(!empty($_POST['email'])) {
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES);
    if(empty($email)){
        $error = true;
    }
} else {
    $error = true;
}
if(!empty($_POST['ask'])) {
    $ask = htmlspecialchars(trim($_POST['ask']), ENT_QUOTES);
    if(empty($ask)){
        $error = true;
    }
} else {
    $error = true;
}

//preparing mail
if(!$error) {
    $from = '';
    $subject = '[Имя сайта] Заявка: ';

    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=utf-8\n";
    $headers .= "Content-Transfer-Encoding: 8bit\n";
    $from = '=?utf-8?B?'. base64_encode($from).'?=';
    $headers .= "From: ".$from." <keramzit>\n"; 
    $subject = '=?utf-8?B?'. base64_encode($subject).'?=';

    $content = "<html><body><table border='1' style='border-color: #666; border-collapse: collapse;' cellpadding='5'>" .
        "<tr style='background: #eee;'><td><strong>Время заявки:</strong> </td><td>".$timestamp."</td></tr>" .
        "<tr><td><strong>Имя посетителя:</strong> </td><td>".$name."</td></tr>\n\n" .
        "<tr><td><strong>Телефон посетителя:</strong> </td><td>".$email."</td></tr>\n\n" .
        "<tr><td><strong>IP посетителя:</strong> </td><td>".$ip."</td></tr>\n\n" .
        "<tr><td><strong>Область посетителя:</strong> </td><td>".$place[1]."</td></tr>\n\n" .
        "<tr><td><strong>Город посетителя:</strong> </td><td>".$place[0]."</td></tr>\n\n" .
        "<tr><td><strong>Форма:</strong> </td><td>".$ask."</td></tr>\n\n" .
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
        echo '<h1>Неизвестная ошибка, обратитесь к администратору!</h1>'.
            "Ask:" . $ask .
            "email:" . $email . 
            "phone:" . $phone;
    }
?>

