
editor = [];

function PHPShopMicro(){

    // Создание ActiveXObject
    this.request = function(){
        var request = false;

        if (window.XMLHttpRequest)
        {
            //Gecko-совместимые браузеры, Safari, Konqueror
            request = new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        {
            //Internet explorer
            try
            {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (CatchException)
            {
                request = new ActiveXObject("Msxml2.XMLHTTP");
            }
        }
        if (!request)
        {
            alert("Невозможно создать XMLHttpRequest");
        }

        return request;
    }

    // Сохраняем изменения в темп
    this.tmp = function(str,page){
        document.getElementById('tmp_'+page).value=str;
    }


    // Вывод редактора
    this.setEditor = function(page,content,code){
        var length = content.length;
        if(length > 500) this.height = length/3+'px';
        document.getElementById(page).innerHTML = '<textarea style="width:'+this.width+';height:'+this.height+'" id="updateContent_'+page+'" onblur="PHPShopMicro.tmp(this.value,\''+page+'\')">'+content+'</textarea>';

        if(code == undefined){
            editor[page] = CodeMirror.fromTextArea(document.getElementById("updateContent_"+page+""), {
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-ejs",
                indentUnit: 4,
                indentWithTabs: true,
                enterMode: "keep",
                tabMode: "shift",
                lineWrapping: false
            });
        }
    }


    this.cancel = function(page){
        location.reload()
    }

    this.wiswyg = function(page){
        window.hs.htmlExpand(null, {
            objectType: 'iframe',
            src: this.wiswygurl+'?page='+page+'&template='+this.template,
            width: 650,
            height: 550
        } )
    }


    // Запись изменения
    this.save = function(page){

        // Записываем данные редактора во временную переменную
        PHPShopMicro.tmp(editor[page].getValue(),''+page+'');

        // Обновленные данные
        var content_update = document.getElementById('tmp_'+page).value;
        var sql='<phpshop><sql><from>table_name</from><method>update</method><vars><name>'+page+'</name><content><![CDATA['+content_update+']]></content></vars></sql></phpshop>';
        var send_value='sql='+sql+'&pas='+this.pas+'&log='+this.log;

        var xmlhttp = this.request();
        xmlhttp.open('POST', this.url, false);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        try{
            xmlhttp.send(send_value);
            document.getElementById(page).innerHTML=content_update;
            document.getElementById('editButton_'+page).href="javascript:PHPShopMicro.edit('"+page+"');";
            document.getElementById('editButton_'+page).innerHTML="[edit]";

            try{
                document.getElementById('editButtonIcon_'+page).src="/phpshop/modules/edit/templates/edit.png";
                document.getElementById('editButtonIconCancel_'+page).src="/phpshop/modules/edit/templates/blank.gif";
                document.getElementById('cancelButton_'+page).innerHTML='';
                document.getElementById('editButtonIconWiswyg_'+page).src="/phpshop/modules/edit/templates/blank.gif";
                document.getElementById('wiswygButton_'+page).innerHTML='';
            }catch(e){}
        }catch(e){}

    }

    // Форма редактирования
    this.edit = function(page,code){

        var content=document.getElementById(page).innerHTML;

        document.getElementById('editButton_'+page).href="javascript:PHPShopMicro.save('"+page+"');";
        document.getElementById('editButton_'+page).innerHTML="[save]";
        document.getElementById('tmp_'+page).value=content;
        try{
            document.getElementById('editButtonIcon_'+page).src="/phpshop/modules/edit/templates/save.png";
            document.getElementById('editButtonIconCancel_'+page).src="/phpshop/modules/edit/templates/cancel.png";
            document.getElementById('cancelButton_'+page).innerHTML="[cancel]";
            document.getElementById('editButtonIconWiswyg_'+page).src="/phpshop/modules/edit/templates/wiswyg.png";
            document.getElementById('wiswygButton_'+page).innerHTML='[wiswyg]';
        
        }catch(e){}
        this.setEditor(page,content,code);
    }
}

var PHPShopMicro = new PHPShopMicro();
PHPShopMicro.url = '/phpshop/modules/edit/admpanel/xml.php';
PHPShopMicro.wiswygurl = '/phpshop/modules/edit/admpanel/editor.php';
PHPShopMicro.width = '99%';
PHPShopMicro.height = '100px';
