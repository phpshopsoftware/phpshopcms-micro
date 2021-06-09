// Папка размещения от корня
var ROOT_PATH = '';


// оформление кнопок
$(".ok").addClass('btn btn-default btn-sm');
$("input:button").addClass('btn btn-default');
//$("input:submit").addClass('btn btn-primary');
$("input:text,input:password, textarea").addClass('form-control');
$(".operation").addClass('btn btn-xs');

function ChangeSkin() {
    document.SkinForm.submit();
}

// вывод сообщений 
function showAlertMessage(message) {
    var messageBox = '.success-notification';
    var innerBox = '#notification .notification-alert';

    //если нет элемента для всплывающих сообщий, выводим обычным alert
    if ($(messageBox).length > 0) {
        $(innerBox).html(' ');
        $(innerBox).html(message);
        $(messageBox).fadeIn('slow');

        setTimeout(function() {
            $(messageBox).delay(500).fadeOut(1000);
        }, 5000);
    }
    else
        alert(message);
}


$(window).on('load', function() {


    // закрепление навигации
    $('.breadcrumb, .template-slider').waypoint(function() {
        $('#navigation').toggleClass('navbar-fixed-top');
    });

    // быстрый переход
    $(document).on('keydown', function(e) {
        if (e == null) { // ie
            key = event.keyCode;
            var ctrl = event.ctrlKey;
        } else { // mozilla
            key = e.which;
            var ctrl = e.ctrlKey;
        }
        if ((key == '123') && ctrl)
            window.location.replace(ROOT_PATH + '/phpshop/admpanel/');
        if (key == '120') {
            $.ajax({
                url: ROOT_PATH + '/phpshop/ajax/info.php',
                type: 'post',
                data: 'type=json',
                dataType: 'json',
                success: function(json) {
                    if (json['success']) {
                        confirm(json['info']);
                    }
                }
            });
        }
    });



    // смена оформления
    $(".bootstrap-theme, .non-responsive-switch").on('click', function() {
        skin = $(this).attr('data-skin');
        var cookie = $.cookie('bootstrap_theme');

        // переход на responsive
        if (skin == 'non-responsive' && cookie == 'non-responsive')
            skin = 'bootstrap';

        $('#body').fadeOut('slow', function() {
            $('#bootstrap_theme').attr('href', '/phpshop/templates/bootstrap/css/' + skin + '.css');
        });

        setTimeout(function() {
            $('#body').fadeIn();
        }, 1000);

        $.cookie('bootstrap_theme', skin, {
            path: '/'
        });
    });

    // сохранение оформления
    $(".saveTheme").on('click', function() {

        $.ajax({
            url: ROOT_PATH + '/phpshop/ajax/skin.php',
            type: 'post',
            data: 'template=bootstrap&type=json',
            dataType: 'json',
            success: function(json) {
                if (json['success']) {
                    showAlertMessage(json['status']);
                }
            }
        });
    });

    $('select').styler();


    // меню каталога товаров
    $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).fadeIn("fast");
            },
            function() {
                $('.dropdown-menu', this).fadeOut("fast");
            });

});