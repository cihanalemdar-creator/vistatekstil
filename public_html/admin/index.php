<?php
ini_set('max_execution_time', 0); 
$dir = './inc/';
require_once $dir."database.php";
require_once $dir."DW_class.php";
$dw = new DWDB();
require_once $dir."kgPager.class.php";

if(!isset($_SESSION["dijilogin"])){
    header("Location:giris.php");
} else {
//* Yönetici Bilgileri
$adminsession = $_SESSION["yoneticiid"]; 
$admin = $dw->getRow('SELECT * FROM yoneticiler WHERE id = ?', array('bindValues' => array($adminsession)));   // yönetici bilgilerini çekiyor
//* Yönetici Bilgileri
$gun=date('d');
$ay=date('m');
$yil=date('Y');
$saati=date('H:s:i');

$puancek = $dw->getRow('SELECT * FROM puan WHERE id = ?', array('bindValues' => array(1)));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Noxe Media | Web Tasarım, Web Yazılım</title>
    <meta name="keywords" content="Noxe Media,creative agency, web tasarım, web sitesi tasarımı, web yazılım,opencart,eticaret,seo,seo analizi, web sitesi, ucuz web tasarım, ucuz eticaret, ucuz web sitesi tasarımı" />
    <meta name="description" content="Sıradışı web sitesi projeleri ile markanızı bir adım öteye taşımak için sihirli bir dokunuş">
    <meta name="author" content="Noxe Media">

    <link rel="shortcut icon" href="img/favicon-16x16.png" type="image/x-icon" />
    <meta name="msapplication-TileColor" content="#ffffff">
	<link href="css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link rel="stylesheet" href="js/plugins/pnotify/pnotify.custom.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="js/plugins/jquery-ui/jquery-ui.css" type="text/css" />
    <link rel="stylesheet" href="plupload/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/plugins/bootstrap-duallistbox-master/dist/jquery.bootstrap-duallistbox.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/plugins/bootstrap-duallistbox-master/src/bootstrap-duallistbox.css">
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/plugins/fancybox/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="js/plugins/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
</head>
<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">

            <div class="sidebar-collapse">

                <?php require_once "sol.php"; ?>

            </div>

        </nav>



        <div id="page-wrapper" class="gray-bg dashbard-1">

        <div class="row border-bottom">

        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

        <div class="navbar-header">

            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

        </div>

            <ul class="nav navbar-top-links navbar-right">

                

                <li class="dropdown pull-right" style="margin-left:10px;border-left:1px solid #e7eaec;">

                    <a class="dropdown-toggle " href="#" data-toggle="dropdown" style="padding: 11px 10px;">

                        <img src="img/yonetici.png" alt="" height="38">

                        <span style="margin-left: 10px;"><?php echo $admin->ad." ".$admin->soyad; ?></span>

                    </a>



                        <ul class="dropdown-menu">

                            <li><a href="index.php?sayfa=bilgilerim"><span class="fa fa-user pr5"></span> Bilgilerim</a></li>

                            <li class="divider"></li>

                            <li><a href="cikis.php"><span class="fa fa-power-off pr5"></span> Çıkış</a></li>

                        </ul>

                </li>



            </ul>



        </nav>

        </div>

                

                    <!-- Ort Alan -->

                    <?php

                    switch($_GET['sayfa']) {
						
						case 'seo': require_once('sayfalar/seo.php');break;
						case "yoneticiler": require_once('sayfalar/yoneticiler.php');break;
						case "bilgilerim": require_once('sayfalar/bilgilerim.php');break;
                        case 'referanslar': require_once('sayfalar/referanslar.php');break;
						case 'galeri': require_once('sayfalar/galeri.php');break;
						case 'galerikategoriler': require_once('sayfalar/galerikategoriler.php');break;
						case 'urunler': require_once('sayfalar/urunler.php');break;
						case 'urunkategoriler': require_once('sayfalar/urunkategoriler.php');break;
						case 'iletisim': require_once('sayfalar/iletisim.php');break;
						case 'kurumsal': require_once('sayfalar/kurumsal.php');break;

                            # code...

                            break;

						

                        default: require_once('sayfalar/anasayfa.php');

                    }

                    ?> 

                    <!-- Ort Alan -->




        </div>      



    </div>

    <!-- Mainly scripts -->

    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/plugins/filestyle/bootstrap-filestyle.js"></script>

    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="js/inspinia.js"></script>

    <script src="js/plugins/pace/pace.min.js"></script>

    <script src="js/plugins/select2/select2.full.min.js"></script>

    <script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="js/plugins/pnotify/pnotify.custom.js"></script>

    <script src="js/plugins/iCheck/icheck.min.js"></script>

        <script>

            $(document).ready(function () {

                $('.i-checks').iCheck({

                    checkboxClass: 'icheckbox_square-green',

                    radioClass: 'iradio_square-green',

                });

            });

        </script>

    <script type="text/javascript">

        $(".select2_demo_2").select2();

        $(".select2_demo_3").select2({

            placeholder: "Seçin...",

            allowClear: true

        });



        $(".touchspin3").TouchSpin({

            verticalbuttons: true,

            buttondown_class: 'btn btn-white',

            buttonup_class: 'btn btn-white',

            max: 10000,

        });

    </script>



    <script src="ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script type="text/javascript" src="plupload/plupload.full.min.js"></script>

    <script type="text/javascript" src="plupload/jquery.ui.plupload/jquery.ui.plupload.js"></script> 

        <script type="text/javascript">

            function numbersonly(myfield, e, dec) {

                var key;

                var keychar;

                if (window.event)

                    key = window.event.keyCode;

                else if (e)

                    key = e.which;

                else

                    return true;

                keychar = String.fromCharCode(key);

                // control keys

                if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27))

                    return true;

                // numbers

                else if ((("0123456789.,").indexOf(keychar) > -1))

                    return true;

                // decimal point jump

                else if (dec && (keychar == ".")) {

                    myfield.form.elements[dec].focus();

                    return false;

                } else

                    return false;

            }

        </script>   

        <script type="text/javascript">

            $('#resimsec').filestyle({

                iconName : 'fa fa-picture-o',

                buttonText : 'Resim Seçin'

            });

            $('#resimsec2').filestyle({

                iconName : 'fa fa-picture-o',

                buttonText : 'Resim Seçin'

            });

            $('#dosyasec').filestyle({

                iconName : 'fa fa-file-excel-o',

                buttonText : 'Dosya Seçin'

            });

        </script>

        <script src="js/plugins/dataTables/datatables.min.js"></script>

        <script>

        $(document).ready(function(){

            $('.dataTables-example').DataTable({

                dom: '<"html5buttons"B>lTfgitp',

                buttons: [

                    



                    

                ]



            });



        });



       

    </script>

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

<?php 

}

?>