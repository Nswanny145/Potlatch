<html>
<head>
    <title>Create Account - Potlatch</title>
</head>
<body>
    <?php if(isset($validation)) echo $validation->listErrors(); ?>

    <?= form_open('signup/create') ?>
        <h5>First Name</h5>
        <input type="text" name="first_name" value="" size="50" />

        <h5>Last Name</h5>
        <input type="text" name="last_name" value="" size="50" />

        <h5>Email Address</h5>
        <input type="text" name="email" value="" size="50" />

        <h5>Password</h5>
        <input type="text" name="password" value="" size="50" />

        <h5>Password Confirm</h5>
        <input type="text" name="passwordConf" value="" size="50" />

        <div><input type="submit" value="Create Account" /></div>
    </form>
</body>
</html>