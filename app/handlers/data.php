<?php
header('Content-Type: text/html; charset=UTF-8');
$error = false;
$name = '';
$phone = '';
$position = '';
$package = '';
 // comagic start
$url = $_POST['consultant_server_url'].'api/add_offline_message/';
          $data = array(
            'site_key' => $_POST['site_key'], //Значение без изменений из служебного поля site_key
            'visitor_id' => $_POST['visitor_id'], //Значение без изменений из служебного поля visitor_id
            'hit_id' => $_POST['hit_id'], //Значение без изменений из служебного поля hit_id
            'session_id' => $_POST['session_id'], //Значение без изменений из служебного поля session_id
            'name' => $_POST['name'], //Имя клиента
            'email' => $_POST['email'], //E-mail
            'phone' => $_POST['phone'], //Номер телефона
            'text' => $_POST['text'],
           );//Текст заявки
    $options = array( 'http' =>
        array(
            'header' => "Content-type: application/x-www-form-urlencoded; charset=UTF-8",
            'method' => "POST",
            'content' => http_build_query($data)
        )
    );
    print $options['http']['content'];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $resultArray = json_decode($result, true);
//comagic end
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
if(!empty($_POST['package'])) {
    $package = htmlspecialchars(trim($_POST['package']), ENT_QUOTES);
    if(empty($package)){
        $error = true;
    }
} else {
    $error = true;
}
//preparing mail
if(!$error) {
    $from = '';
    $subject = '[keramzitr.ru] Заявка: '.$position;

    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=utf-8\n";
    $headers .= "Content-Transfer-Encoding: 8bit\n";
    $from = '=?utf-8?B?'. base64_encode($from).'?=';
    $headers .= "From: ".$from." <keramzitr.ru>\n"; 
    $subject = '=?utf-8?B?'. base64_encode($subject).'?=';

    $content = "<html><body><table border='1' style='border-color: #666; border-collapse: collapse;' cellpadding='5'>" .
        "<tr style='background: #eee;'><td><strong>Время заявки:</strong> </td><td>".$timestamp."</td></tr>" .
        "<tr><td><strong>Имя посетителя:</strong> </td><td>".$name."</td></tr>\n\n" .
        "<tr><td><strong>Телефон посетителя:</strong> </td><td>".$phone."</td></tr>\n\n" .
        "<tr><td><strong>IP посетителя:</strong> </td><td>".$ip."</td></tr>\n\n" .
        "<tr><td><strong>Область посетителя:</strong> </td><td>".$place[1]."</td></tr>\n\n" .
        "<tr><td><strong>Город посетителя:</strong> </td><td>".$place[0]."</td></tr>\n\n" .
        "<tr><td><strong>Форма:</strong> </td><td>".$position."</td></tr>\n\n" .
        "<tr><td><strong>Тип керамзита:</strong> </td><td>".$package."</td></tr>\n\n" .
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
        mail("info@keramzitr.ru", $subject, $content, $headers);   
        //mail("derkach94@gmail.com", $subject, $content, $headers); 
    }
    else{
        echo "По всей видимости вы бот:) Вы смогли заполнить скрытые поля, созданные для бота.";
    }
    
   

    //redirect to thank-you.html page.
    header('location:../ty.html');
} elseif($error2) {
        echo '<h1>Вы должны принять согласие на обработку персональных данных</h1>';
    } else {
        echo '<h1>Неизвестная ошибка, обратитесь к администратору!</h1>' .
            $name .
            $phone .
            $position .
            $package ;
    }
?>
