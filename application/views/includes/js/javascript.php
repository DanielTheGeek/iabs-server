<?php echo smiley_js(); 
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<script type="text/javascript">
	var csrfCookieVal = "<?=$csrf['hash'];?>";
</script>
<script type="text/javascript" src="<?= base_url(); ?>src/js/script.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>src/js/rsmodal.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>src/js/vendor/jquery.cookiebar.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>src/js/vendor/push.min.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>src/css/vendor/jquery.sweet-modal.min.css"/>
<script type="text/javascript" src="<?= base_url(); ?>src/js/vendor/jquery.sweet-modal.min.js"></script>