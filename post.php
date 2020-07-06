<?php
    $msg_box = ""; // в этой переменной будем хранить сообщения формы
    $errors = array(); // контейнер для ошибок
    // проверяем корректность полей
	if($_POST['form_tel'] == "")   $errors[] = "Поле <span style='color: #666;'>Ваш телефон</span> не заполнено";
    if($_POST['form_name'] == "")    $errors[] = "Поле <span style='color: #666;'>Ваше имя</span> не заполнено";

 
    // если форма без ошибок
    if(empty($errors)){     
        // собираем данные из формы
        $message  = "Имя: " . $_POST['form_name'] . "<br/>";
        $message .= "Телефон: " . $_POST['form_tel'] . "<br/><br/>";
        send_mail($message); // отправим письмо
        // выведем сообщение об успехе
        $msg_box = "Спасибо за обращение!";

    }else{
        // если были ошибки, то выводим их
//        $msg_box = "";
//        foreach($errors as $one_error){
//            $msg_box .= "<style>.messages{margin-bottom: 20px;}</style><span style='color: red;font-size: 1.2em;'>$one_error</span><br/>";
//        }
    }
 
    // делаем ответ на клиентскую часть в формате JSON
    echo json_encode(array(
        'result' => $msg_box
    ));
     
     
    // функция отправки письма
    function send_mail($message){
        // почта, на которую придет письмо
        $mail_to = "smolensk-gric@yandex.ru"; 
        // тема письма
        $subject = "Новая заявка с сайта ТомскДезСервис(новый)";
         
        // заголовок письма
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: Название сайта StopKlop\r\n"; // от кого письмо
         
        // отправляем письмо 
        mail($mail_to, $subject, $message, $headers);
    }
     
?>