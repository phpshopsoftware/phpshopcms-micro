<?php
/**
 * ���������� ��������� MySQL ����� XML
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopClass
 */
class PHPShopBaseXml {
    var $log='phpshop';
    var $pas='b244ba41f5309a6ef2405a4ab4dd031d';
    var $xml_header='<?xml version="1.0" encoding="windows-1251"?><phpshop>';
    var $xml_footer='</phpshop>';
    var $true_method=array('select');
    var $true_from=array('table_name','table_name2','table_name3');
    var $debug=false;


    function PHPShopBaseXml() {
        global $PHPShopBase;

        $this->PHPShopBase=$PHPShopBase;

        if($this->admin()) {
            $this->sql=stripcslashes($_POST['sql']);

            $this->parser();
            $fun=$this->xml['method'];

            if(in_array($this->xml['method'],$this->true_method)) {
                if(method_exists($this,$this->xml['method']))  call_user_method($this->xml['method'],$this);
                else echo 'Non method';
            }else echo 'False method';

            $this->compile();
        }else exit('Login error!');


    }

    function compile() {
        if(is_array($this->data)) {
            $result=$this->xml_header;
            foreach($this->data as $k=>$row) {
                $result.='
<row>';
                if(is_array($row))
                foreach($row as $key=>$val) {

                    // ������������ ���� �� ������� ������ �����
                    if(is_numeric($key{0})) {
                        $key=substr($key, 1);
                    }

                    if(preg_match("(\<(/?[^\>]+)\>)",$val) or strstr($val,'&'))
                        $result.='
<'.$key.'><![CDATA['.trim($val).']]></'.$key.'>';
                    else   $result.='
<'.$key.'>'.trim($this->is_serialize($val)).'</'.$key.'>';
                }
                $result.='
</row>';
            }

            $result.=$this->xml_footer;
            echo $result;
        }
    }

    function parseWhereString($str) {

        // �������� �� ������� ������
        if(strstr($str, ' and ')) $num_where_delim='and';
        elseif(strstr($str, ' or ')) $num_where_delim='or';
        else $num_where_delim=false;

        if($num_where_delim) $array_num_where=explode($num_where_delim,$str);
        else $array_num_where[]=$str;

        if(count($array_num_where)>0)
            foreach($array_num_where as $key=>$value) {

                if(strstr($value, '=')) $delim='=';
                elseif(strstr($value, '>')) $delim='>';
                elseif(strstr($value, '<')) $delim='<';

                $array=explode($delim,$value);
                $where[$array[0]]=$delim.$array[1];
            }

        return $where;
    }

    function parser() {
        if(@$db=readDatabase($this->sql,"sql",false)) {
            $this->xml['method']=$db[0]['method'];
            $this->xml['vars']=array($db[0]['vars']);
            

            // �������� ����������� ������
            if(in_array($db[0]['from'],$this->true_from)) $this->xml['from']=$db[0]['from'];
            else exit('False table');

            if(!empty($db[0]['where'])) $this->xml['where']=$this->parseWhereString($db[0]['where']);
            if(!empty($db[0]['order'])) $this->xml['order']=array('order' =>$db[0]['order']);
            if(!empty($db[0]['limit'])) $this->xml['limit']=array('limit' =>$db[0]['limit']);

        }else exit('Non xml');

    }



    function admin() {
        if($_POST['log']==$this->log and md5($_POST['pas']==$this->pas))
            return true;
    }


    function is_serialize($str) {
        $array=unserialize($str);
        if(is_array($array)) {
            foreach($array as $key=>$val) {
                $result.='
<'.$key.'>'.$val.'</'.$key.'>';
            }
            return $result;
        }else return $str;
    }


    // ������ �����
    function clean($vars) {

        foreach($vars as $k=>$v){

        if(preg_match("/\[CDATA\[(.*)\]\]/i",$v,$matches))
                $clean_array[$k] = html_entity_decode($matches[1]);
        else $clean_array[$k] = html_entity_decode($v);
        }
        return $clean_array;
    }

    function select() {
        $PHPShopOrm=new PHPShopOrm($this->PHPShopBase->getParam('base.'.$this->xml['from']));
        $PHPShopOrm->debug=$this->debug;
        $this->data=$PHPShopOrm->select($this->xml['vars'],$this->xml['where'],$this->xml['order'],$this->xml['limit']);
    }

    function update() {

        // ������ ������ ��� ����������
        $vars=readDatabase($this->sql,"vars",false);
        $PHPShopOrm=new PHPShopOrm($this->PHPShopBase->getParam('base.'.$this->xml['from']));
        $PHPShopOrm->debug=$this->debug;
        $this->data=$PHPShopOrm->update($this->clean($vars[0]),$this->xml['where'],$prefix='');
    }

    function delete() {
        $PHPShopOrm=new PHPShopOrm($this->PHPShopBase->getParam('base.'.$this->xml['from']));
        $PHPShopOrm->debug=$this->debug;
        $this->data=$PHPShopOrm->delete($this->xml['where']);
    }

    function insert() {

        // ������ ������ ��� �������
        $vars=readDatabase($this->sql,"vars",false);

        $PHPShopOrm=new PHPShopOrm($this->PHPShopBase->getParam('base.'.$this->xml['from']));
        $PHPShopOrm->debug=$this->debug;
        $this->data=$PHPShopOrm->insert($vars[0],$prefix='');
    }

}
?>