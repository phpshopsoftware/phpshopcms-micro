<?php
/**
 * ���������� �������� ��������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopTest
 */
class PHPShopCoretest extends PHPShopCore {

    /**
     * �����������
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * ����� �� ���������
     */
    function index() {

        $disp='
<h1>����������� PHP ������ ����� PHPShop Core</h1>
<p>
�������� ����� ����� ���������� �� ������: <code>phpshop/core/coretest.core.php</code>
</p>

<h3>��� ������ �����: "'.$this->PHPShopSystem->getValue('name').'"</h3>
�������� ������ CoreTest:

<ol>
<li> C������ ���� � �������� ������
<p>
C������ ���� � �������� ������ � ����� <code>phpshop/core/</code>,
���������� ������������� ����, ��������, ���� ���� ����������
<code>coretest.class.php</code> � �������������� ��� ������ ������ <code>http://'.$_SERVER['SERVER_NAME'].'/coretest/</code>
 </p>

<li>������� ����� ��������� �������<br>
<p>
��� ������ ������ ��������� ������������� ���� � ��������� �
������ �����,��������, ���� ����� ���������� <b>PHPShopCoretest</b>


<pre>
class PHPShopCoretest extends PHPShopCore {

    function __construct() {
        parent::__construct();
    }

function index() {

 // ����
 $this->title="����������� PHP ������ ����� API - ".$this->PHPShopSystem->getValue("name");
 $this->description=\'����������� PHP ������\';
 $this->keywords=\'php\';

 // ���������� ����������
 $this->set(\'pageContent\',\'PHPShop Core �������!\');
 $this->set(\'pageTitle\',\'����������� PHP ������ ����� API\');

  // ���������� ������
  $this->parseTemplate($this->getValue(\'templates.
        page_page_list\'));

    }
}
</pre>
   <li>� ����� �������� ����� ��������� "PHPShop Core �������!" � ����� ������� �����.
</ol>

</p>
';

        // ����
        $this->title='����������� PHP ������ ����� API - '.$this->PHPShopSystem->getValue("name");
        $this->description='����������� PHP ������';
        $this->keywords='php';

        // ���������� ���������
        $this->set('pageContent',$disp);
        $this->set('pageTitle','����������� PHP ������ ����� API');


        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));

    }
}

?>
