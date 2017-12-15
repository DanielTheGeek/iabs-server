<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IABS Installation</title>
    <link rel="stylesheet" href="src/css/forms/auth.css">
    <link rel="stylesheet" href="src/css/forms/form-basic.css">
</head>
<body>

    <div class="main-content">
        <p class="logo">
            <a href="https://iabs.scriptorigin.com">IABS</a>
        </p>

        {action}

            <div class="form-title-row">
                <h1>{title}</h1>
            </div>

            {content}

            <div class="form-row">
                <input type="submit" name="{button_name}" value="{button_val}">
            </div>
        <?= form_close(); ?>

    </div> 
    
    <script type="text/javascript">
        function _(x) {
          return document.getElementById(x);
        }
        
        function toggleState() {
            var elem = _("secret");
            if (window.show) {
                elem.type = "password";
                var target = _("view");

                if (window.innerWidth <= 645) {
                    target.innerHTML = "<i class=\'fa fa-eye\'></i>";   
                } else {
                    target.innerHTML = "<i class=\'fa fa-eye\'></i>&nbsp;Show";
                }

                window.show = false;
            } else {
                elem.type = "text";
                var target = _("view");

                if (window.innerWidth <= 645) {
                    target.innerHTML = "<i class=\'fa fa-eye-slash\'></i>";   
                } else {
                    target.innerHTML = "<i class=\'fa fa-eye-slash\'></i>&nbsp;Hide";
                }

                window.show = true;
            }
        }
        
        function restrict(elem){
            var tf = _(elem);
            var rx = new RegExp;
            if(elem == "email"){
                rx = /[^a-z0-9@.-_]/gi;
            } else if(elem == "user"){
                rx = /[^a-z0-9_-]/gi;
            }
            tf.value = tf.value.replace(rx, "");
        }   
    </script>
</body>
</html>
