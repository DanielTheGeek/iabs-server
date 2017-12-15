<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{page_title} | {site_name}</title>

    <?php $this->load->view('includes/mobile_config'); ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>src/js/vendor/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>src/js/vendor/slick/slick-theme.css"/>
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php $this->load->view('includes/header'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php $this->load->view('widgets/dash_containers'); ?>
            <!-- /.row -->
            <div class="row">
                <!-- <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

    </div>

    <?php $this->load->view('includes/script'); ?>
    <script type="text/javascript" src="<?= base_url(); ?>src/js/vendor/slick/slick.min.js"></script>
    <script type="text/javascript">
        $(".containers").slick({
          // normal options...
          infinite: true,
          lazyLoad: "ondemand",
          speed: 500,
          autoplay: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          arrows: false
        });
    </script>

</body>

</html>
