<?php

/**
 * Обработчик формы сообщения с сайта
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCore
 */
class PHPShopForma extends PHPShopCore {

    /**
     * Конструктор
     */
    function PHPShopForma() {
        $this->debug=false;
        
        // список экшенов
        $this->action=array("post"=>"message","nav"=>"index");
        parent::PHPShopCore();
    }


    /**
     * Экшен по умолчанию, вывод формы связи
     */
    function index() {

        // Мета
        $this->title="Форма связи - ".$this->PHPShopSystem->getValue("name");

        // Определяем переменные
        $this->set('pageTitle','Форма связи');

        // Подключаем шаблон
        $this->addToTemplate("page/page_forma_list.tpl");
        $this->parseTemplate($this->getValue('templates.page_page_list'));

    }

    /**
     * Экшен отправка формы при получении $_POST[message]
     */
    function message() {
        
        if(!empty($_SESSION['text']) and $_POST['key']==$_SESSION['text']) {
            $this->send();
        }else $this->set('Error',"Ошибка ключа, повторите попытку ввода ключа");
    }


    /**
     * Генерация сообщения
     */
    function send() {

        // Подключаем библиотеку отправки почты
        PHPShopObj::loadClass("mail");

        // Проверяем заполненность полей
        if(PHPShopSecurity::true_param($_POST['nameP'],$_POST['subject'],$_POST['message'],$_POST['mail'])){

            $zag=$this->$_POST['subject']." - ".$this->PHPShopSystem->getValue('name');
            $message="Вам пришло сообщение с сайта ".$this->PHPShopSystem->getValue('name')."

Данные о пользователе:
----------------------
";

            // Информация по сообщению
            foreach($_POST as $key=>$val)
$message.=$val."
";

            $message.="
Дата:               ".date("d-m-y H:s a")."
IP:
".$_SERVER['REMOTE_ADDR']."
---------------

С уважением,
http://".$_SERVER['SERVER_NAME'];

            $PHPShopMail = new PHPShopMail($this->PHPShopSystem->getValue('admin_mail'),$_POST['mail'],$zag,$message);
            $this->set('Error',"Сообщение успешно отправлено");
        }
        else $this->set('Error',"Ошибка заполнения обязательных полей");
    }

}
?>