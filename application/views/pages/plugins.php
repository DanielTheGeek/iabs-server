<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{page_title} | {site_name}</title>

    <?php $this->load->view('includes/mobile_config'); ?>
    <!-- DataTables CSS -->
    <link href="<?= base_url(); ?>src/js/vendor/datatables-plugins/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?= base_url(); ?>src/js/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>src/js/vendor/sweet-modal/dist/min/jquery.sweet-modal.min.css" />
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('includes/header'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php 
                    do_action('plugin_message');
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Plugins</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {message}
                        {plugin_message}
                        <div class="message"></div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                All Plugins
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="plugins-dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Version</th>
                                            <th>Description</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if ( is_array($plugins) ) {
                                                foreach($plugins as $k => $p) {
                                                    $html = <<<'f00bar'
                                                    <tr class="$p->system_name">
                                            <td><?= $p->name; ?></td>
                                            <td><?= $p->version; ?></td>
                                            <td><?= $p->description; ?></td>
                                            <td><?= $p->author; ?> <?= ($p->uri ? '| <a href="' . $p->author_uri . '" target="_blank">website</a>' : ''); ?></td>
                                            <td><?php echo ($p->status ? 'Activated' : 'Deactivated'); ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"> Actions <span class="caret"></span> </button> 
                                                    <ul class="dropdown-menu pull-right" role="menu"> 
                                                        <?php do_action('plugin_action_nav'); ?>
                                                        <?= ($p->status ? '' : '<li><a href="'.site_url("plugins?action=activate&plugin=" . $p->system_name . "").'">Activate</a></li>'); ?>
                                                        <?= ( ! $p->status ? '<li class="divider"></li> <li><a style="cursor: pointer;" onClick="uninstallPlugin(\''.$p->system_name.'\', \''.$p->name.'\')">Uninstall</a> </li>' : '<li class="divider"></li><li><a href="'.site_url("plugins?action=deactivate&plugin=" . $p->system_name . "" ).'">Deactivate</a></li>') ?> 
                                                    </ul> 
                                                </div>
                                            </td> 
                                        </tr>  
f00bar;
                                                echo $html;
                                                }   
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                        <div class="well col-md-4 col-md-offset-4" style="background-image: url('src/images/plugins_bg.png'); background-size: contain; margin-top: 100px; margin-bottom: 100px !important; color: #fff; border-radius: 20px;">
                                <div style="text-align: center;">
                                    <h4>Develop For Script Origin</h4>
                                    <p>Build your own plugins, extend IABS <br> and achieve even more.</p>
                                    <a class="btn btn-primary" target="_blank" href="https://iabs.scriptorigin.com/developers">Get Started</a>
                                </div>
                            </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php $this->load->view('includes/script'); ?>

    <script src="<?= base_url(); ?>src/js/vendor/sweet-modal/dist/min/jquery.sweet-modal.min.js"></script>
    <script src="<?= base_url(); ?>src/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>src/js/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>src/js/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script>
    $(document).ready(function() {
        $('#plugins-dataTable').DataTable({
            responsive: true
        });

    });
    
    function uninstallPlugin( plugin, realName ) {
        $.sweetModal({
            title: 'Are You Sure?',
            content: 'Uninstalling a plugin cannot be undone, are you sure you want to continue?',
            icon: $.sweetModal.ICON_WARNING,

            buttons: [
                {
                    label: 'Yes',
                    classes: 'redB',
                    action: function() {
                        //call
                        $.ajax({
                            url: "?action=uninstall",
                            cache: true,
                            data: "plugin="+plugin,
                            success: function( resp ) {
                                if ( resp == 'okay' ) {
                                    $('.'+plugin).remove();
                                    $('.message').html('<div style="margin-bottom: 5px !important;" class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+realName+' was successfully uninstalled.</div>');
                                    $.sweetModal({
                                        icon: $.sweetModal.ICON_SUCCESS,
                                        content: realName+' was successfully uninstalled.'
                                    });
                                } else {
                                    $.sweetModal({
                                        icon: $.sweetModal.ICON_ERROR,
                                        content: realName+" could not be uninstalled, this could be due to a plugin error. Please try again."
                                    });
                                }
                            }
                        });
                    }
                }
            ]
        });
    }
    </script>
</body>

</html>
