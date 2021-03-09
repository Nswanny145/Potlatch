<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        html, body {
            width: 100%;
            height: 100%;
        }

        .card {
            display: block;
            position: fixed;
            max-width: 350px;
            left: 0;
            right: 0;
            margin: auto;
            top:50vh;
            transform: translateY(-75%);
        }

        .card-body{
            padding: 1.25rem 1.25rem 0.5rem !important;
        }
    </style>
    <title>Login - Potlatch</title>
</head>
<body>
    <?php if(isset($validation)) echo $validation->listErrors(); ?>

    <div class='card'>
        <div class="card-header"><h5>Login</h5></div>
        <?= form_open('login/login', ['class' => 'card-body']) ?>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="email" name="email" value="" size="100" required/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="" size="50" required/>
            </div>
            <!--<div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                <label class="form-check-label" for="rememberMe">Stay logged in</label>
            </div>-->
            <button type="submit" class="btn btn-block btn-primary">Login</button>
        </form>
    </div>
</body>
</html>