<?php defined('BASEPATH') OR exit('Missed a step, right?'); ?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Error</title>
	    <link rel="stylesheet" href="src/css/forms/auth.css">
	    <link rel="stylesheet" href="src/css/forms/form-basic.css">
	</head>
	<body>

	    <div class="main-content">
	        <p class="logo">
	            <a href="https://iabs.scriptorigin.com">IABS</a>
	        </p>

	        <div class="form-basic">
	            <div class="form-title-row">
	                <h1><?php echo $heading; ?></h1>
	            </div>

	            <?php echo $message; ?>
	        </div>

	    </div> 
	</body>
</html>