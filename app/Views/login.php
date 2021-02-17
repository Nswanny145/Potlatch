<html>
<head>
    <title>Login - Potlatch</title>
</head>
<body>
    <?php if(isset($validation)) echo $validation->listErrors(); ?>

    <?= form_open('login/login') ?>
        <h5>Email Address</h5>
        <input type="text" name="email" value="" size="50" />

        <h5>Password</h5>
        <input type="text" name="password" value="" size="50" />

        <div><input type="submit" value="Login" /></div>
    </form>
</body>
</html>