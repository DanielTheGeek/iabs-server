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
            <h1>Welcome Back</h1>

            <?= form_open('login', 'class="form-mini" onSubmit="preventDefault()"'); ?>
                <p class="logo">
                    <a href="https://iabs.scriptorigin.com">IABS</a>
                </p>
                <div class="response"></div>
                <div class="form-row">
                    <input type="text" onfocus="window.removeMsg('.response')" name="login" placeholder="Username or email">
                </div>

                <div class="form-row">
                    <input type="password" onfocus="window.removeMsg('.response')" name="pass" placeholder="Password">
                </div>

                <div class="form-row">
                    <label class="form-checkbox">
                        <input type="checkbox" name="remember">
                        <span>Keep me logged in</span>
                    </label>
                </div>

                <div class="form-row form-last-row">
                    <button onClick="window.login('form-mini', '.response')" type="submit" data-text="Login" id="login-btn">Login</button>
                </div>
            <?= form_close(); ?>
            <a href="{forgot}" class="form-forgotten-password">Forgotten password</a>|&nbsp; 
            <a href="{register}" class="form-create-an-account">Create an account &rarr;</a>
        </div>
    </div>

    {scripts}
        <script type="text/javascript" src="{script}"></script>
    {/scripts}
</body>

</html>
