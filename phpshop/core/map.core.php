<?php
/**
 * Îáğàáîò÷èê êàğòû ñàéòà
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCore
 */
class PHPShopMap extends PHPShopCore {

    /**
     * Êîíñòğóêòîğ
     */
    function PHPShopMap() {

        // Îòëàäêà
        $this->debug=false;

        parent::PHPShopCore();
    }



    /**
     * Êàğòà HTML
     */
    function html() {

        $j=0;
        $dir="pageHTML/";

        $this->set('pageFrom',$this->getValue('system.path'));
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if($file != "." and $file != "..") {
                    $fp = fopen($dir.$file, "r");
                    $fstat = fstat($fp);
                    $Content=@fread($fp,$fstat['size']);
                    fclose($fp);

                    $filename=explode(".",$file);

                    $meta=$this->getMeta($Content);
                    if(empty($title)) $title=$filename[0].".html";

                    if(!empty($meta['title'])) {

                        // Îïğåäåëÿåì ïåğåìåííûå
                        $this->set('productName',$meta['title']);
                        $this->set('pageWords',$this->words);
                        $this->set('productKey',substr(strip_tags($Content),0,300)."...");
                        $this->set('pageLink',$filename[0].".html");
                        $i++;
                        $this->set('productNum',$i);

                        $this->addToTemplate($this->getValue('templates.main_search_forma'));
                    }
                }

            }

            closedir($dh);
        }

        $this->add('<p><br></p>',true);
    }


    /**
     * İêøåí ïî óìîë÷àíèş, âûâîä êàğòû ïî ñòğàíèöàì, íîâîñòÿì è îòçûâàì
     */
    function index() {

        $this->html();

        $this->set('searchString',$this->words);

        // Ìåòà
        $this->title="Êàğòà ñàéòà - ".$this->PHPShopSystem->getValue("name");
        
        // Ïåğåõâàò ìîäóëÿ
        $this->setHook(__CLASS__,__FUNCTION__);

        $this->parseTemplate($this->getValue('templates.map_page_list'));
    }
}
?>