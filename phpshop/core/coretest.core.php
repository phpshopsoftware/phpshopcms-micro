<?php
/**
 * Обработчик тестовой страницы
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopTest
 */
class PHPShopCoretest extends PHPShopCore {

    /**
     * Конструктор
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Экшен по умолчанию
     */
    function index() {

        $disp='
<h1>Подключение PHP логики через PHPShop Core</h1>
<p>
Исходник этого файла расположен по адресу: <code>phpshop/core/coretest.core.php</code>
</p>

<h3>Имя вашего сайта: "'.$this->PHPShopSystem->getValue('name').'"</h3>
Разберем модуль CoreTest:

<ol>
<li> Cоздаем файл с заданным именем
<p>
Cоздаем файл с заданным именем в папке <code>phpshop/core/</code>,
содержаший навигационный путь, например, этот файл называется
<code>coretest.class.php</code> и обрабатывается при наборе адреса <code>http://'.$_SERVER['SERVER_NAME'].'/coretest/</code>
 </p>

<li>Создаем класс заданного формата<br>
<p>
Имя класса должно содержать навигационный путь и совпадать с
именем файла,например, этот класс называется <b>PHPShopCoretest</b>


<pre>
class PHPShopCoretest extends PHPShopCore {

    function __construct() {
        parent::__construct();
    }

function index() {

 // Мета
 $this->title="Подключение PHP логики через API - ".$this->PHPShopSystem->getValue("name");
 $this->description=\'Подключение PHP логики\';
 $this->keywords=\'php\';

 // Определяем переменные
 $this->set(\'pageContent\',\'PHPShop Core работет!\');
 $this->set(\'pageTitle\',\'Подключение PHP логики через API\');

  // Подключаем шаблон
  $this->parseTemplate($this->getValue(\'templates.
        page_page_list\'));

    }
}
</pre>
   <li>В итоге получаем вывод сообщения "PHPShop Core работет!" в общем дизайне сайта.
</ol>

</p>
';

        // Мета
        $this->title='Подключение PHP логики через API - '.$this->PHPShopSystem->getValue("name");
        $this->description='Подключение PHP логики';
        $this->keywords='php';

        // Определяем переменые
        $this->set('pageContent',$disp);
        $this->set('pageTitle','Подключение PHP логики через API');


        // Подключаем шаблон
        $this->parseTemplate($this->getValue('templates.page_page_list'));

    }
}

?>
