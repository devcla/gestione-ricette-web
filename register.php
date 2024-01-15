<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $filename = 'users.json';
        $userData = file_exists($filename) ?
            json_decode(file_get_contents($filename), true) : array();
        if ($userData === null) $userData = array();
        function insert(&$userData,$newData,$filename)
        {
            if(isset($userData[$newData['username']])) {
                echo "<script>
                    alert('Register failed. Retry.');
                    window.location.back();
                 </script>";
                return false;
            }
            $userData[$newData['username']] = $newData;
            file_put_contents($filename, json_encode($userData, JSON_PRETTY_PRINT));
            return true;
        }
        if(insert($userData,$data,$filename)) {
            setcookie('username',$username);
            header('Location: insert.php');
            exit();
        }
    }
    ?>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h1>Register<br></h1>
        <h3>Username <input type="text" name="username"> <br></h3>
        <h3>Email <input type="email" name="email"> <br></h3>
        <h3>Password <input type="password" name="password"> <br></h3>
        <input type="submit" value="Login">
    </form>
</body>

</html>