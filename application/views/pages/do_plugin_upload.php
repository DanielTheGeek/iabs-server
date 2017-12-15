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
                        <h1 class="page-header">{message}</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {error}
                        <?php 
                            if ( isset($upload_data) ) {
                                $new_arr = array_slice( $upload_data, 0, 2 );
                                foreach ( $new_arr as $item => $value ) {
                                    $replace = str_replace( '_', ' ', $item );
                                    $new = ucwords( $replace );
                                    echo "<ul><li>$new: $value</li></ul>";
                                }
                            }
                        ?>

                        <a href="install?action=upload" class="btn btn-primary">Upload Plugin</a>
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
