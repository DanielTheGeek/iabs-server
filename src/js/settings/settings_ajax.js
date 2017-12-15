// AJAX messenger
$(document).ready(function() {
	var currentForm = window.form;
	$(currentForm).on('submit', function(form){
		currentForm.preventDefault();
		jQuery.ajax({
			type: "POST",
			url: $(currentForm).attr('action'),    
			data: $(currentForm).serialize(),
			beforeSend: function(){
				$("#spinner").html('<i class="fa fa-cog fa-spin fa-2x"></i>');
			},
		    success: function(res) {
		    	$("#alert").css(
		    		'display' : 'hidden'
		    	);
				$("#alert").html(res);
				$("#spinner").html('');
		    }
		});
	});
});
