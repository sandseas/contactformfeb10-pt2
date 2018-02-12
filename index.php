<?php

if ( ! empty ( $_POST ) ) {
    // Post data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    
    // Check for valid email
    if ( ! $email = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL ) ) {
        die('Invalid email');
    }

//Database credentials
$db_user = 'sandicook';
$db_pass = '';
$db_name = 'forms';
$db_host = '127.0.0.1';
$db_port = 3306;

    // Fire up the connection
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    // Check we're connected
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    
    if (isset($_POST['submit'])) { // Note: I removed the exclamation mark before isset because it made no sense
    $user_name = $_POST['name']; 
    $user_email = $_POST['email']; 

    if($user_name  && $user_email) {
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $stmt = mysqli_stmt_init($link);
        mysqli_stmt_prepare($stmt, "INSERT INTO user (`name`, `email`) VALUES (?,?)");
        mysqli_stmt_bind_param($stmt, 'ss', $user_name, $user_email);
        mysqli_stmt_execute($stmt);
    }
}

    // Get ID of row we just inserted
    $id = $mysqli->insert_id;
    echo "working";
    // Get the data we just submitted
    $result = $mysqli->query("SELECT name, email FROM user WHERE ID = {$id}");
    $user = $result->fetch_object();
}
   echo "working";
   ?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form to Database</title>
    
    <style>
            body {
                margin: 0;
                padding: 10px;
                background:#208fe5;
                font-family: Arial, sans-serif;
                font-size: 14px;
            }
            .form {
                background: #ffffff;
                border-radius: 5px;
                padding: 20px;
                max-width: 480px;
                margin: 15px auto;
            }
            .form, 
            .text,
            .email,
            .submit {
                display: block;
                box-sizing: border-box;
                width: 100%;
            }
            .text,
            .email,
            .submit {
                padding: 10px;
                font-size: 14px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }
            .form h3 {
                line-height: 1.2;
                font-size: 14px;
                margin-top: 5px;
                font-weight: normal;
            }
            .submit {
                border: none;
                background: #FEBB13;
                color: #222;
                font-size: 24px;
            }
        </style>
</head>
<body>

<?php


?>

        <form action="" method="post" class="form">
            <?php if ( $user ) : ?>
                <h3>Here's the data you submitted:</h3>
                <p>Name: <?php echo htmlspecialchars($user->user_name, ENT_COMPAT, 'UTF-8'); ?></p>
                <p>Email: <?php echo htmlspecialchars($user->user_email, ENT_COMPAT, 'UTF-8'); ?></p>
            <?php endif; ?>
            
            <h3>Enter your name and email address below:</h3>
            <p><input type="text" name="name" class="text" placeholder="Enter your full name"></p>
            <p><input type="email" name="email" class="text email" placeholder="Enter your email address"></p>
            <p><input type="submit" class="submit" value="Submit"></p>
        </form>
        
</body>
</html>