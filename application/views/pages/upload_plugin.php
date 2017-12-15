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
                        <h1 class="page-header">Upload From Desktop</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open_multipart('plugins/install?action=upload&type=plugin'); ?>
                            <div class="form-group">
                                <label>Select zipped plugin file</label>
                                <input type="file" name="plugin" enctype="multipart/form-data" accept=".zip">
                            </div>
                            <input type="submit" class="btn btn-primary" name="action" value="install">
                        </form>
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
</body>

</html>
