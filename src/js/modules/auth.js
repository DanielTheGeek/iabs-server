function login(f,t) {
	var curForm = $('form.'+f);
	curForm.on('submit', function(form){
		form.preventDefault();
		jQuery.ajax({
			type: "POST",
			url: $('.'+f).attr('action'),    
			data: $('.'+f).serialize(),
			beforeSend: function(){
				$("#login-btn").html('<img src="src/images/ajax-loader.gif">');
			},
		   success: function(res) {
		   	for (var i = 0; i < 5; i++) {
		   		$("#login-btn").html($("#login-btn").attr('data-text'));
		   	}

		    	if (res == 'true') {
		    		$(t).html('<div class="noti success">Login successful, redirecting...</div>');

		    		for (var i = 0; i < 10; i++) {
		    			window.location = '';
		    		}
		    	} else if (res == 'invalid') {
		    		$(t).html('<div class="noti danger">Invalid login credentials</div>');
		    	} else if (res == 'false') {
		    		$(t).html('<div class="noti danger">All fields are required to login</div>');
		    	} 
		   }
		});
	});
}

function signup(f,t) {
	var curForm = $('form.'+f);
	curForm.on('submit', function(form){
		form.preventDefault();
		jQuery.ajax({
			type: "POST",
			url: $('.'+f).attr('action'),    
			data: $('.'+f).serialize(),
			beforeSend: function(){
				$("#signup-btn").html('<img src="src/images/ajax-loader.gif">');
			},
			success: function(res) {
				for (var i = 0; i < 5; i++) {
					$("#signup-btn").html($("#signup-btn").attr('data-text'));
				}

				if ( res == 'true' ) {
					$( t ).html( '<div class="noti success">Successfully signed up, redirecting...</div>' );

					for ( var i = 0; i < 10; i++ ) {
						window.location = 'login';
					}
				} else {
					$( t ).html( res );
				}
			}
		});
	});
}

function removeMsg( t ) {
	$( t ).html('');

	return true;
}