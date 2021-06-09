//***************************************************//
// PHPShop JavaScript 3.1                            //
// Copyright © www.phpshop.ru.                       //
// Все права защищены.                               //
//***************************************************//


// Активация закладок
function NavActive(nav){
    if(document.getElementById(nav)){
        var IdStyle = document.getElementById(nav);
        IdStyle.className='menu_bg';
    }
}

// Смена скина
function ChangeSkin(){
    document.SkinForm.submit();
}


// PhpshopButton 
function butt_on(subm){//ON
    var MENU = document.getElementById(subm).style;
    MENU.background = 'D81011';
}

function butt_of(subm){//OF
    var MENU = document.getElementById(subm).style;
    MENU.background = '999999';
}


// PHPSHOP JavaListCatalog v1.3
// Start Load Modul
function pressbutt_load(subm,dir){
    if(!dir) dir='';
    if(subm!='')
        if(subm!=1000) {
            if (document.getElementById("m"+subm)) {
                var SUBMENU = document.getElementById("m"+subm).style;
                SUBMENU.visibility = 'visible';
                SUBMENU.position = 'relative';
            }
        }
}

// JavaListCatalog XHTML v2.0
// Main Modul
function pressbutt(subm,num,dir){

    if(!dir) dir='';

    var SUBMENU = document.getElementById("m"+subm).style;
    var IMG=dir+'/images/shop/arr2.gif';
    var IMG2=dir+'/images/shop/arr3.gif';


    if (SUBMENU.visibility=='hidden'){
        SUBMENU.visibility = 'visible';
        SUBMENU.position = 'relative';
    }

    else{
        SUBMENU.visibility = 'hidden';
        SUBMENU.position = 'absolute';
    }

    for(i=0;i<num;i++)
        if(i != subm)
            if(document.getElementById('m'+i)){
                document.getElementById('m'+i).style.visibility = 'hidden';
                document.getElementById('m'+i).style.position = 'absolute';
            }
}


function SearchChek()
{
    var s1=window.document.forms.forma_search.words.value;
    if (s1==""  || s1=="Я ищу..."){
        alert("Ошибка заполнения формы поиска!");
        return false;
    }
    else document.forma_search.submit();
    return true;
}

function Fchek2()
{
    var s1=window.document.forms.forma_gbook.name.value;
    var s2=window.document.forms.forma_gbook.subject.value;
    var s3=window.document.forms.forma_gbook.mail.value;
    var s4=window.document.forms.forma_gbook.message.value;
    var s5=window.document.forms.forma_gbook.key.value;
    if (s1=="" || s2=="" || s3=="" || s4=="" || s5=="") alert("Ошибка заполнения формы связи!");
    else document.forma_gbook.submit();
}