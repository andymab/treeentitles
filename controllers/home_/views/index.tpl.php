<?php
//$layout = "clear_full";
$title = "Биоритмы";

$path = str_replace(rPATH, '', __DIR__);
$css = [
    '/public/assets/css/styles.min.css?h=' . filemtime(__DIR__ . '/' . 'assets/css/styles.min.css')
];

$js = [
    'https://code.highcharts.com/highcharts.js',
    "https://code.highcharts.com/modules/xrange.js",
    "https://code.highcharts.com/modules/exporting.js",
    "https://code.highcharts.com/modules/offline-exporting.js",
    "https://code.highcharts.com/modules/export-data.js",
    "https://code.highcharts.com/modules/drilldown.js",
    "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js",
    '/public/assets/js/script.js?h=' . filemtime(__DIR__ . '/' . 'assets/js/script.js')
];


?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>bioritms</title>
    <meta name="description" content="биоритмы  человека плюс и цзын">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <?= $this->getaddscripts($css, "style") ?>
</head>

<body>
    <!-- Start: Network Particles Hero -->
    <div class="jumbotron jumbotron-fluid jumbotron-main" >
        <div id="particles-js">
            <canvas class="particles-js-canvas-el" width="1409" height="319" style="width: 100%; height: 100%;"></canvas>
        </div>
        <div class="container center-vertically-holder" style="margin-top:-20px;">
            <div class="row center-vertically">
                <div class="col-md-8 offset-sm-0 offset-md-2 text-center" style="margin-top:100px;margin-bottom:100px;">
                    <h1 data-aos="fade-down" data-aos-duration="1000" data-aos-delay="700" id="hero-title" style="margin-bottom:0;">БИОРИТМЫ</h1>
                    <p data-aos="fade-up" data-aos-duration="650" data-aos-delay="1450" id="hero-subtitle" style="margin-top:19px;font-size:7;font-family:Poppins, sans-serif;">Биологические ритмы человека с расчетом книги перемен И-Цзынь</p>
                    <form>
                        <div class="form-group d-lg-flex flex-column align-items-lg-start"><label>Дата рождения</label><input id="dpkr1" class="form-control" type="date"></div>
                        <div class="form-group d-lg-flex flex-column align-items-lg-start"><label>Расчетная дата</label><input id="dpkr2" class="form-control" type="date"></div><button class="btn btn-primary" id="hero-btn" type="button" onclick="get_bioritm(); return false;">Расcчитать&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                    </form><!-- Start: gecksogram -->
                    <div class="czy">
                        <div class="d-flex justify-content-around czy-elem"><span></span><span></span></div>
                        <div class="d-flex justify-content-around czy-elem"><span class="span-full"></span></div>
                        <div class="d-flex justify-content-around czy-elem"><span></span><span></span></div>
                    </div><!-- End: gecksogram -->
                </div>
            </div>
        </div>
    </div><!-- End: Network Particles Hero -->
    <!-- Start: histogram -->
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="bioritmnew" style="height: 600px;"></div>
            </div>
        </div>
    </div><!-- End: histogram -->
    <!-- Start: description histogram -->
    <div class="container">
        <div class="row" id="description-histogram">
            <div class="col d-flex flex-column align-items-center flex-sm-row align-items-sm-start ">
                <div class="histogram-description py-4">
                    <!-- Start: gecksogram -->
                    <div class="czy">
                        <div class="d-flex justify-content-around czy-elem"><span></span><span></span></div>
                        <div class="d-flex justify-content-around czy-elem"><span class="span-full"></span></div>
                        <div class="d-flex justify-content-around czy-elem"><span></span><span></span></div>
                    </div><!-- End: gecksogram -->
                </div>
                <div>
                    <h3>Заголовок</h3>
                    <p>Описание</p>
                </div>
            </div>
        </div>
    </div><!-- End: description histogram -->
    <!-- Start: description histogram -->
    <div class="container">
        <div class="row" id="description-gecsogram">
            <div class="col d-flex flex-column align-items-center flex-sm-row align-items-sm-start">
                <div class=" py-4">
                    <!-- Start: gecsogram -->
                    <div class="histogram-description ">
                        <!-- Start: gecksogram -->
                        <div class="czy up-elem">
                            <div class="d-flex justify-content-around czy-elem"><span></span><span></span></div>
                            <div class="d-flex justify-content-around czy-elem"><span class="span-full"></span></div>
                            <div class="d-flex justify-content-around czy-elem"><span></span><span></span></div>
                        </div><!-- End: gecksogram -->
                    </div><!-- End: gecsogram -->
                    <!-- Start: gecsogram -->
                    <div class="histogram-description">
                        <!-- Start: gecksogram -->
                        <div class="czy down-elem">
                            <div class="d-flex justify-content-around czy-elem"><span></span><span></span></div>
                            <div class="d-flex justify-content-around czy-elem"><span class="span-full"></span></div>
                            <div class="d-flex justify-content-around czy-elem"><span></span><span></span></div>
                        </div><!-- End: gecksogram -->
                    </div><!-- End: gecsogram -->
                </div>
                <div>
                    <h3>Заголовок</h3>
                    <p>Описание</p>
                </div>
            </div>
        </div>
    </div><!-- End: description histogram -->
    <script>
        var bio = <?= file_get_contents(__DIR__ . "/media/bio.json") ?>;
        var dao = <?= file_get_contents(__DIR__ . "/media/dao.json") ?>;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://threejs.org/examples/js/libs/stats.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <?= $this->getaddscripts($js, "script") ?>
</body>

</html>