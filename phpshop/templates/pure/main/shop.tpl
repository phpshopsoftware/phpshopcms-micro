<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
    <HEAD>
        <TITLE>@pageTitl@</TITLE>
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251" />
        <META name="description" content="@pageDesc@" />
        <META name="keywords" content="@pageKeyw@" />
        <META name="copyright" content="@pageReg@" />
        <META name="engine-copyright" content="PHPSHOP.RU, @pageProduct@" />
        <META name="domen-copyright" content="@pageDomen@" />
        <META content="General" name="rating" />
        <META name="ROBOTS" content="ALL" />
        <LINK rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <LINK rel="icon" href="/favicon.ico" type="image/x-icon" />
        <LINK href="@pageCss@" type="text/css" rel="stylesheet" />
        <SCRIPT language="JavaScript1.2" src="java/java2.js"></SCRIPT>
        <!--[if IE 6]><LINK rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/template.ie6.css" type="text/css" media="screen" /><![endif]-->
        <!--[if IE 7]><LINK rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/template.ie7.css" type="text/css" media="screen" /><![endif]-->
        <SCRIPT type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/script.js"></SCRIPT>
    </HEAD>
    <BODY onLoad="pressbutt_load('@pageNameId@')">
        <div id="art-page-background-gradient"></div>
        <div id="art-main">
            <div class="art-sheet">
                <div class="art-sheet-tl"></div>
                <div class="art-sheet-tr"></div>
                <div class="art-sheet-bl"></div>
                <div class="art-sheet-br"></div>
                <div class="art-sheet-tc"></div>
                <div class="art-sheet-bc"></div>
                <div class="art-sheet-cl"></div>
                <div class="art-sheet-cr"></div>
                <div class="art-sheet-cc"></div>
                <div class="art-sheet-body">
                    <div class="art-nav">
                        <div class="l"></div>
                        <div class="r"></div>
                        <ul class="art-menu">
                            <li class="item28"><a href="/" title="Главная"><span class="l"> </span><span class="r"> </span><span class="t">Главная</span></a></li>
                            @topMenu@
                        </ul>
                    </div>
                    <div class="art-header">
                        <div class="art-header-jpeg"></div>
                        <div class="art-logo">
                            <h1 id="name-text" class="art-logo-name"><a href="/" title="@name@">@name@</a></h1>
                            <div id="slogan-text" class="art-logo-text">@pageDesc@</div>
                        </div>
                    </div>
                    <div class="art-content-layout">
                        <div class="art-content-layout-row">
                            <div class="art-layout-cell art-sidebar1">
                                @skinSelect@
                                <div class="art-block">
                                    <div class="art-block-body">
                                        <div class="art-blockheader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="t"> Каталог статей</div>
                                        </div>
                                        <div class="art-blockcontent">
                                            <div class="art-blockcontent-tl"></div>
                                            <div class="art-blockcontent-tr"></div>
                                            <div class="art-blockcontent-bl"></div>
                                            <div class="art-blockcontent-br"></div>
                                            <div class="art-blockcontent-tc"></div>
                                            <div class="art-blockcontent-bc"></div>
                                            <div class="art-blockcontent-cl"></div>
                                            <div class="art-blockcontent-cr"></div>
                                            <div class="art-blockcontent-cc"></div>
                                            <div class="art-blockcontent-body">
                                                <!-- block-content -->
                                                <ul class="menu">
                                                    @mainMenuPage@
                                                </ul>
                                                <!-- /block-content -->
                                                <div class="cleared"></div>
                                            </div>
                                        </div>
                                        <div class="cleared"></div>
                                    </div>
                                </div>
                                <div class="art-block">
                                    <div class="art-block-body">
                                        <div class="art-blockheader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="t"> Навигация</div>
                                        </div>
                                        <div class="art-blockcontent">
                                            <div class="art-blockcontent-tl"></div>
                                            <div class="art-blockcontent-tr"></div>
                                            <div class="art-blockcontent-bl"></div>
                                            <div class="art-blockcontent-br"></div>
                                            <div class="art-blockcontent-tc"></div>
                                            <div class="art-blockcontent-bc"></div>
                                            <div class="art-blockcontent-cl"></div>
                                            <div class="art-blockcontent-cr"></div>
                                            <div class="art-blockcontent-cc"></div>
                                            <div class="art-blockcontent-body">
                                                <!-- block-content -->
                                                <ul class="menu">
                                                    <li class="parent item11"><a href="/news/" title="Новости"><span>Новости</span></a></li>
                                                    <li class="parent item11"><a href="/gbook/" title="Отзывы"><span>Отзывы</span></a></li>
                                                    <li class="parent item11"><a href="/links/" title="Полезные ссылки"><span>Полезные ссылки</span></a></li>
                                                    <li class="parent item11"><a href="./forma/" title="Форма связи"><span>Форма связи</span></a></li>
                                                    <li class="parent item11"><a href="/map/" title="Карта сайта"><span>Карта сайта</span></a></li>
                                                    @mainMenuPhoto@
                                                </ul>
                                                <!-- /block-content -->
                                                <div class="cleared"></div>
                                            </div>
                                        </div>
                                        <div class="cleared"></div>
                                    </div>
                                </div>
                                @leftMenu@
                                @oprosDisp@
                                @cloud@

                            </div>
                            <div class="art-layout-cell art-content">
                                @DispShop@
                                @getPhotos@
                                @banersDisp@

                            </div>
                            <div class="art-layout-cell art-sidebar2">
                                <div class="art-block">
                                    <div class="art-block-body">
                                        <div class="art-blockheader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="t"> Поиск</div>
                                        </div>
                                        <div class="art-blockcontent">
                                            <div class="art-blockcontent-tl"></div>
                                            <div class="art-blockcontent-tr"></div>
                                            <div class="art-blockcontent-bl"></div>
                                            <div class="art-blockcontent-br"></div>
                                            <div class="art-blockcontent-tc"></div>
                                            <div class="art-blockcontent-bc"></div>
                                            <div class="art-blockcontent-cl"></div>
                                            <div class="art-blockcontent-cr"></div>
                                            <div class="art-blockcontent-cc"></div>
                                            <div class="art-blockcontent-body">
                                                <!-- block-content -->
                                                <form method="post" name="forma_search" action="/search/" onSubmit="return SearchChek()">
                                                    <div class="search">
                                                        <input name="words" id="mod_search_searchword" maxlength="20" alt="Поиск" class="inputbox" type="text" size="20" value="Я ищу..."  onblur="if(this.value=='') this.value='Я ищу...';" onfocus="if(this.value=='Я ищу...') this.value='';" />
                                                    </div>
                                                </form>
                                                <!-- /block-content -->
                                                <div class="cleared"></div>
                                            </div>
                                        </div>
                                        <div class="cleared"></div>
                                    </div>
                                </div>
                                @rightMenu@
                            </div>
                        </div>
                    </div>
                    <div class="cleared"></div>
                    <table class="position" cellpadding="0" cellspacing="0" border="0">
                        <tr valign="top">
                            <td width="33%"><div class="art-block">
                                    <div class="art-block-body">
                                        <div class="art-blockheader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="t"> Навигация</div>
                                        </div>
                                        <div class="art-blockcontent">
                                            <div class="art-blockcontent-tl"></div>
                                            <div class="art-blockcontent-tr"></div>
                                            <div class="art-blockcontent-bl"></div>
                                            <div class="art-blockcontent-br"></div>
                                            <div class="art-blockcontent-tc"></div>
                                            <div class="art-blockcontent-bc"></div>
                                            <div class="art-blockcontent-cl"></div>
                                            <div class="art-blockcontent-cr"></div>
                                            <div class="art-blockcontent-cc"></div>
                                            <div class="art-blockcontent-body">
                                                <!-- block-content -->
                                                <ul class="latestnews">
                                                    <li class="latestnews"> <a href="/news/" class="latestnews"> Новости</a> </li>
                                                    <li class="latestnews"> <a href="/gbook/" class="latestnews"> Отзывы</a> </li>
                                                    <li class="latestnews"> <a href="/links/" class="latestnews"> Полезные ссылки</a> </li>
                                                    <li class="latestnews"> <a href="/map/" class="latestnews"> Карта сайта</a> </li>
                                                </ul>
                                                <!-- /block-content -->
                                                <div class="cleared"></div>
                                            </div>
                                        </div>
                                        <div class="cleared"></div>
                                    </div>
                                </div></td>
                            <td width="33%"><div class="art-block">
                                    <div class="art-block-body">
                                        <div class="art-blockheader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="t"> Сообщение</div>
                                        </div>
                                        <div class="art-blockcontent">
                                            <div class="art-blockcontent-tl"></div>
                                            <div class="art-blockcontent-tr"></div>
                                            <div class="art-blockcontent-bl"></div>
                                            <div class="art-blockcontent-br"></div>
                                            <div class="art-blockcontent-tc"></div>
                                            <div class="art-blockcontent-bc"></div>
                                            <div class="art-blockcontent-cl"></div>
                                            <div class="art-blockcontent-cr"></div>
                                            <div class="art-blockcontent-cc"></div>
                                            <div class="art-blockcontent-body">
                                                <!-- block-content -->
                                                <table class="contentpaneopen">
                                                    <tr>
                                                        <td valign="top" ><p>Перед тем, как чего-нибудь пугаться, нужно сначала посмотреть – действительно ли оно такое страшное, а то - зачем зря стараться…</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" ></td>
                                                    </tr>
                                                </table>
                                                <!-- /block-content -->
                                                <div class="cleared"></div>
                                            </div>
                                        </div>
                                        <div class="cleared"></div>
                                    </div>
                                </div></td>
                            <td><div class="art-block">
                                    <div class="art-block-body">
                                        <div class="art-blockheader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="t"> Создание интернет-магазина</div>
                                        </div>
                                        <div class="art-blockcontent">
                                            <div class="art-blockcontent-tl"></div>
                                            <div class="art-blockcontent-tr"></div>
                                            <div class="art-blockcontent-bl"></div>
                                            <div class="art-blockcontent-br"></div>
                                            <div class="art-blockcontent-tc"></div>
                                            <div class="art-blockcontent-bc"></div>
                                            <div class="art-blockcontent-cl"></div>
                                            <div class="art-blockcontent-cr"></div>
                                            <div class="art-blockcontent-cc"></div>
                                            <div class="art-blockcontent-body">
                                                <!-- block-content -->
                                                <p>
                                                    <ul class="mostread">
                                                        <li class="mostread"> <a href="https://www.phpshop.ru/page/1c.html" class="mostread"> PHPShop Pro 1C </a> </li>
                                                        <li class="mostread"> <a href="https://www.phpshop.ru/page/enterprise.html" class="mostread"> PHPShop Enterprise </a> </li>
                                                        <li class="mostread"> <a href="https://www.phpshop.ru/page/compare.html" class="mostread"> PHPShop Basic </a> </li>
                                                    </ul>
                                                </p>
                                                <!-- /block-content -->
                                                <div class="cleared"></div>
                                            </div>
                                        </div>
                                        <div class="cleared"></div>
                                    </div>
                                </div></td>
                        </tr>
                    </table>
                    <div class="art-footer">
                        <div class="art-footer-inner"> <a href="/rss/" class="art-rss-tag-icon" title="RSS"> <img src="images/livemarks.png" alt="RSS"  /></a>
                            <div class="art-footer-text">
                                <p>Copyright &copy; @company@ Все права защищены.<br />
                                    Работает под управлением <a href="http://www.phpshopcms.ru/" class="sgfooter" target="_blank" title="PHPShop Micro">PHPShop Micro</a>.</p>
                            </div>
                        </div>
                        <div class="art-footer-background"></div>
                    </div>
                    <div class="cleared"></div>
                </div>
            </div>
            <div class="cleared"></div>
            <p class="art-page-footer">
            </p>
        </div>
    </BODY>
</HTML>