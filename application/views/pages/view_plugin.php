<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php do_action('iabs_page_title') ?>{site_name}</title>

    <?php $this->load->view('includes/mobile_config'); ?>
    <?php do_action('iabs_enqueue_css'); ?>
    <?php do_action('iabs_enqueue_head_scripts'); ?>
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('includes/header'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <?php
                do_action('iabs_show_page');
            ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php $this->load->view('includes/script'); ?>
    <script type="text/javascript">
        var csrfCookieVal = "<?= $csrf['hash']; ?>";
    </script>
    <?php do_action('iabs_enqueue_footer_scripts'); ?>
</body>

</html>
