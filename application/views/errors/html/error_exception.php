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
	                <h4>An uncaught Exception was encountered</h4>
	            </div>

				<p>Type: <?php echo get_class($exception); ?></p>
				<p>Message: <?php echo $message; ?></p>
				<p>Filename: <?php echo $exception->getFile(); ?></p>
				<p>Line Number: <?php echo $exception->getLine(); ?></p>

				<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

					<p>Backtrace:</p>
					<?php foreach ($exception->getTrace() as $error): ?>

						<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

							<p style="margin-left:10px">
							File: <?php echo $error['file']; ?><br />
							Line: <?php echo $error['line']; ?><br />
							Function: <?php echo $error['function']; ?>
							</p>
						<?php endif ?>

					<?php endforeach ?>

				<?php endif ?>
	        </div>

	    </div> 
	</body>
</html>