<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="windows-1251">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@pageTitl@</title>
        <meta name="description" content="@pageDesc@">
        <meta name="keywords" content="@pageKeyw@">
        <meta name="copyright" content="@pageReg@">
        <meta name="engine-copyright" content="PHPSHOP.RU, @pageProduct@">
        <meta name="domen-copyright" content="@pageDomen@">
        <meta content="General" name="rating">
        <meta name="ROBOTS" content="ALL">
        <link href="@pageCss@" type="text/css" rel="stylesheet">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">

        <!-- Bootstrap -->
        <link id="bootstrap_theme" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap.css" rel="stylesheet">
        
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bar.css" rel="stylesheet">

        <!-- Font-awesome -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


        <!-- Menu -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/menu.css" rel="stylesheet">


        <!-- Formstyler -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery.formstyler.css" rel="stylesheet" /> 

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body role="document" id="body">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-1.11.0.min.js"></script>

        <!-- Header -->
        <header class="container visible-lg visible-md">

            <div class="row vertical-align">
                <div class="col-md-8 logo">
                    <a href="/"><img src="images/your_logo.png"></a>
                </div>
                <div class="col-md-4">
                    <form action="/search/" role="search" method="post">
                        <div class="input-group">
                            <input name="words" maxlength="50" class="form-control" placeholder="������.." required="" type="search" >
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </form>   
                </div>
            </div>
        </header>
        <!--/ Header -->

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default" role="navigation" id="navigation">
            <div class="container">
                <div class="navbar-header">

                    <a class="navbar-brand visible-xs" href="tel:@telNum@">
                        <span class="glyphicon glyphicon-phone"></span> @telNum@
                    </a>

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">���������</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="visible-lg visible-lg"><a href="/" title="�����"><span class="glyphicon glyphicon-home"></span></a></li>

                        <!-- dropdown catalog menu -->
                        <li class="dropdown visible-lg visible-md visible-sm">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">������� <b class="caret"></b></a>        
                           
                                @mainMenuPage@
                          
                        </li>

                        <!-- dropdown catalog menu mobile-->
                        <li class="dropdown visible-xs">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">������� <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @menuCatal@
                            </ul>
                        </li>
                        @topMenu@
                        <li class="visible-xs"><a href="/news/">�������</a></li>
                        <li class="visible-xs"><a href="/gbook/">������</a></li>
                        <li class="visible-xs"><a href="/map/">����� �����</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <!-- Notification -->
        <div id="notification" class="success-notification" style="display:none">
            <div  class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <span class="notification-alert"> </span>
            </div>
        </div>
        <!--/ Notification -->

        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar col-xs-3 hidden-xs visible-lg visible-md">

                    <div class="list-group ">
                        <span class="list-group-item active">���������</span>
                        <a href="/news/" class="list-group-item" title="�������">�������</a>
                        <a href="/gbook/" class="list-group-item" title="������">������</a>
                        <a href="/links/" class="list-group-item" title="�������� ������">�������� ������</a>
                        <a href="/map/" class="list-group-item" title="����� �����">����� �����</a>
                        <a href="/forma/" class="list-group-item" title="����� �����">����� �����</a>
                        @mainMenuPhoto@

                    </div>
                    @skinSelect@
                    @leftMenu@
                    @oprosDisp@
                    <div class="visible-lg">@cloud@</div>
                    @rightMenu@
                </div>
                <div class="bar-padding-top-fix visible-xs visible-sm"> </div>
                <div class="col-md-9 col-xs-12 main"> 
                    @DispShop@
                    <div class="visible-lg visible-md">@banersDisp@</div>

                </div>
            </div>

            <footer class="footer well visible-lg visible-md">
                <span class="pull-right col-md-3">
                    <form action="/search/" role="search" method="post">
                        <div class="input-group">
                            <input name="words" maxlength="50" class="form-control" placeholder="������.." required="" type="search" >
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </form>   
                </span>
                 <p>
                    <span class="text-muted visible-lg visible-md small">�������� ��� ����������� <a href="http://www.phpshopcms.ru/" class="sgfooter" target="_blank" title="PHPShop CMS Free">PHPShop.CMS Micro</a>.</span></p>
            </footer>
        </div>

        <!-- ��������� ���� ���������� ������ -->
        <div class="modal fade bs-example-modal-sm" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">�����</h4>
                    </div>
                    <div class="modal-body">
                        <form  action="/search/" role="search" method="post">
                            <div class="input-group">
                                <input name="words" maxlength="50" class="form-control" placeholder="������.." required="" type="search">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--/ ��������� ���� ���������� ������ -->

        <!-- ��������� ���� ��������� -->
        <div class="modal fade bs-example-modal-sm" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">���������</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" name="forma_message" action="/forma/">
                            <div class="form-group">
                                <label>���������</label>
                                <input type="text" name="subject" value="" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>���</label>
                                <input type="text" name="nameP" value="" class="form-control"  required="">
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="mail" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>���������</label>
                                <textarea name="message" class="form-control" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <span class="pull-right">
                                    <input type="hidden" name="send_f" value="ok">
                                    <button type="submit" class="btn btn-primary">���������</button>
                                </span>
                                <img src="phpshop/captcha2.php" alt="" border="0" align="left" style="margin-right:10px"> <input type="text" name="key"   class="form-control" id="exampleInputEmail1" placeholder="���..." style="width:50px" required="">

                            </div>

                        </form>  

                    </div>
                </div>
            </div>
        </div>
        <!--/ ��������� ���� ��������� -->


        <!-- Fixed mobile bar -->
        <div class="bar-padding-fix visible-xs visible-sm"> </div>
        <nav class="navbar navbar-default navbar-fixed-bottom bar bar-tab visible-xs visible-sm" role="navigation">
            <a class="tab-item" href="/">
                <span class="icon icon-home"></span>
                <span class="tab-label">�����</span>
            </a>
            <a class="tab-item" href="#" data-toggle="modal" data-target="#contactModal">
                <span class="icon icon-compose"></span>
                <span class="tab-label">���������</span>
            </a>
            <a class="tab-item @search_active@" href="#" data-toggle="modal" data-target="#searchModal">
                <span class="icon icon-search"></span>
                <span class="tab-label">�����</span>
            </a>
            <a class="tab-item non-responsive-switch" href="#" data-skin="non-responsive">
                <span class="icon icon-pages"></span>
                <span class="tab-label">���</span>
            </a>
        </nav>
        <!--/ Fixed mobile bar -->

        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.formstyler.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/phpshop.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/waypoints.min.js"></script>

    </body>
</html>
