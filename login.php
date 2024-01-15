<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php
    //start the session
    //session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        function authenticate($username, $password)
        {
            $jsonFile = 'users.json';
            $users = json_decode(file_get_contents($jsonFile), true);
            if (isset($users[$username])) {
                if ($users[$username] === $password) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (authenticate($username, $password)) {
            setcookie('username', $username);
            //$_SESSION['username'] = $username;
            header('Location: titolo.php');
            exit();
        } else {
            echo "<script>
                    alert('Login failed. Please check your username and password.');
                    window.location.back();
                 </script>";
        }
    }
    ?>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h1>Login<br></h1>
        <h3>Username <input type="text" name="username"> <br></h3>
        <h3>Password <input type="text" name="password"> <br></h3>
        <input type="submit" value="Login">
        <a href="./register.php">
            <input type="button" value="Register">
        </a>
    </form>
</body>

</html>