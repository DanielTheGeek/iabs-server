<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{page_title} | {site_name}</title>
        <link rel="stylesheet" href="src/css/forms/auth.css">
        <link rel="stylesheet" href="src/css/forms/form-mini.css">
    </head>

    <div class="main-content">
        <div class="form-mini-container">
            <h1>Create Account</h1>

            <?= form_open('signup/do_signup', 'class="form-mini"'); ?>
                <p class="logo">
                    <a href="http://iabs.scriptorigin.com">IABS</a>
                </p>
                <div class="response"></div>
                <div class="form-row">
                    <input type="text" onfocus="window.removeMsg('.response')" name="username" placeholder="Username">
                </div>

                <div class="form-row">
                    <input type="text" onfocus="window.removeMsg('.response')" name="email" placeholder="Email">
                </div>

                <div class="form-row">
                    <input type="password" onfocus="window.removeMsg('.response')" name="pass" placeholder="Password">
                </div>

                <div class="form-row form-last-row">
                    <button onClick="window.signup('form-mini', '.response')" type="submit" data-text="Sign up" id="signup-btn">Sign up</button>
                </div>
            <?= form_close(); ?> 
            <a href="{login}" class="form-create-an-account">Login &rarr;</a>
        </div>
    </div>

    {scripts}
        <script type="text/javascript" src="{script}"></script>
    {/scripts}
</body>

</html>
