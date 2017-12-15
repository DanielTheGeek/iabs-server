<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{page_title} | {site_name}</title>

    <?php $this->load->view('includes/mobile_config'); ?>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('includes/header'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header">Settings</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3">
                        <div class="panel">
                            <div class="panel-heading" style="background-image: url('src/images/login_bg.jpg'); background-size: 100%; background-repeat: no-repeat;">
                                <div class="row" style="color: #fff;">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tint fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= IABS_VERSION ?></div>
                                        <div>IABS Version</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading" style="background-image: url('src/images/login_bg.jpg'); background-size: 100%; background-repeat: no-repeat;">
                                <div class="row" style="color: #fff;">
                                    <div class="col-xs-3">
                                        <i class="fa fa-code fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= phpversion() ?></div>
                                        <div>PHP Version</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                System Settings
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>Coming soon</p>
                                    </div>
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                App Settings
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>Coming soon</p>
                                    </div>
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <?php $this->load->view('includes/script'); ?>
</body>
