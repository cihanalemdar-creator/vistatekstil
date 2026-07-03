<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoxeMedia | Yönetim Paneli</title>
    <meta name="keywords" content="noxemedia,creative agency, web tasarım, web sitesi tasarımı, web yazılım,opencart,eticaret,seo,seo analizi, web sitesi, ucuz web tasarım, ucuz eticaret, ucuz web sitesi tasarımı" />
    <meta name="description" content="Sıradışı web sitesi projeleri ile markanızı bir adım öteye taşımak için sihirli bir dokunuş">
    <meta name="author" content="NoxeMedia">
    <link rel="shortcut icon" href="img/favicon-16x16.png" type="image/x-icon" />
    <link rel="stylesheet" href="js/plugins/pnotify/pnotify.custom.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="js/jquery-2.1.1.js"></script>
    <script type="text/javascript">
        function giris() {
            $.ajax({
                type: 'POST',
                url: 'islem.php?a=GirisYap',
                data: $('#girisyap').serialize(),
                beforeSend : function(yukleniyor) {
                    $('#sonucum').html('<img src="img/loader.gif"/>');
                },
                success: function(ajaxCevap) {
                    $('#sonucum').html(ajaxCevap);
                }
            });
        }
    </script>
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <img width="100%" height="100%" src="img/logo.png">
                <div id="sonucum"></div>
            </div>
            <form class="m-t" action="javascript:giris()" method="post" id="girisyap" name="girisyap">
                <div class="form-group">
                    <input type="text" name="kullanici" class="form-control" placeholder="Kullanıcı Adınız" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="sifre" class="form-control" placeholder="Şifreniz" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Giriş Yap</button>

            </form>
            <p class="m-t"> <small>Copyright &copy; 2023 Noxe Media. Tüm Hakları Saklıdır. </small> </p>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/plugins/filestyle/bootstrap-filestyle.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="js/plugins/pnotify/pnotify.custom.js"></script>
    <script src="js/plugins/dropzone/dropzone.js"></script>

    <script>
    if ( typeof PNotify != 'undefined' ) {
        PNotify.prototype.options.styling = "fontawesome";
        $.extend(true, PNotify.prototype.options, {
            shadow: false,
            stack: {
                spacing1: 15,
                spacing2: 15
            }
        });

        $.extend(PNotify.styling.fontawesome, {
            // classes
            container: "notification",
            notice: "notification-warning",
            info: "notification-info",
            success: "notification-success",
            error: "notification-danger",
            // icons
            notice_icon: "fa fa-exclamation",
            info_icon: "fa fa-info",
            success_icon: "fa fa-check",
            error_icon: "fa fa-times"
        });
    }       
</script>
</body>

</html>
