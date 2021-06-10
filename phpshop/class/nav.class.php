<?php
/**
 * ���������� ���������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 */
class PHPShopNav {
    /**
     * @var array ������ ������ ��������� 
     */
    var $objNav;
    
    /**
     * �����������
     */
    function __construct() {
        $url=parse_url("http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
        
        // ��������, ���� � �����
        $path_parts = pathinfo($_SERVER['PHP_SELF']);
        $root= $path_parts['dirname']."/";
        if($root!="//")
            if($root!="\/") $url=str_replace($path_parts['dirname']."/","/",$url);
        
        $Url=$url["path"];
        $Query=$url["query"];
        $Path=explode("/",$url["path"]);
        $File=explode("_",$Path[2]);
        $Prifix=explode(".",$File[1]);
        $Name=explode(".",$File[0]);
        $Page=explode(".",$File[2]);
        $QueryArray=parse_str($Query,$output);
        $longpage=explode(".",str_replace("/page/","",$url["path"]));
        
        // �������� ��� index
        if(empty($Path[1]) or strpos($Path[1],'.html')) $Path[1]='index';
        
        $this->objNav=array(
                "truepath"=>$url["path"],
                "path"=>$Path[1],
                "nav"=>$File[0],
                "name"=>$Name[0],
                "id"=>$Prifix[0],
                "page"=>$Page[0],
                "querystring"=>$url["query"],
                "query"=>$output,
                "longname"=>$longpage[0],
                "url"=>$url["path"]);
        $GLOBALS['SysValue']['nav']=$this->objNav;
    }
    
    /**
     * ������ ���������� ��������� path
     * @return string
     */
    function getPath() {
        return $this->objNav['path'];
    }
    /**
     * ������ ���������� ��������� nav
     * @return string 
     */
    function getNav() {
        return $this->objNav['nav'];
    }
    /**
     * ������ ���������� ��������� name
     * @return string 
     */
    function getName($mod_replace='/') {
        return str_replace($mod_replace,'',$this->objNav['longname']);
    }
    /**
     * ������ ���������� ��������� id
     * @return string 
     */
    function getId() {
        return $this->objNav['id'];
    }
    
    /**
     * �������� �� ������� ��������
     * @return bool
     */
    function index() {
        if($this->objNav['path']=='index') return true;
    }
}
?>