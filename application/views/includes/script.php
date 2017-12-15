<!-- jQuery -->
<script src="<?= base_url(); ?>src/js/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>src/js/vendor/initial.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url(); ?>src/js/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url(); ?>src/js/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?= base_url(); ?>src/js/template.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.avatar').initial({
            name: '',
            charCount: 2, 
            textColor: '#fff',
            seed: 10, // randomize background color
            height: 25,
            width: 25,
            fontSize: 12,
            fontWeight: 'bolder',
            fontFamily: 'HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica, Arial,Lucida Grande, sans-serif',
            radius: 200
        });
    })
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        // Animate loader off screen
        $(".iabs-preload").fadeOut("slow");
    });
</script>