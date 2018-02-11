<?php
$db_user = 'sandicook';
$db_pass = '';
$db_name = 'forms';
$db_host = '127.0.0.1';
$db_port = 3306;

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  
}

$objects_table = 
	"CREATE TABLE IF NOT EXISTS objects (
		ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		post_title text NOT NULL,
		post_content longtext NOT NULL,
		post_name varchar(20) NOT NULL,
		post_date datetime NOT NULL,
		PRIMARY KEY (ID)
	)";

if ($mysqli->query($objects_table) === TRUE) {
    printf("Table objects successfully created.\n");
}

$objects_meta_table = 
	"CREATE TABLE IF NOT EXISTS object_meta (
		meta_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		object_id bigint(20) UNSIGNED NOT NULL,
		meta_key varchar (255),
		meta_value longtext,
		PRIMARY KEY (meta_id)
	)";

if ($mysqli->query($objects_meta_table) === TRUE) {
    printf("<br />Table object_meta successfully created.\n");
}

$objects_tags_table = 
	"CREATE TABLE IF NOT EXISTS object_tag_relationships (
		ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		object_id bigint(20) UNSIGNED NOT NULL,
		tag_id bigint(20) UNSIGNED NOT NULL,
		PRIMARY KEY (ID)
	)";

if ($mysqli->query($objects_tags_table) === TRUE) {
    printf("<br />Table object_tag_relationships successfully created.\n");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Contact  Form</title>
</head>
<body>

<?php


?>

<!--
    <form action ="" method="post">
        <div class = "form-field">
            <input type = "text" class="text" name = "name" placeholder="Enter your name" required />
            
        </div>
    
        <div class = "form-field">
            <input type = "email" class="text" name = "email" placeholder="Enter your email" required />
            
        </div>
    
            <div class = "form-field">
                
                <button class = "button">Submit</button>
            </div>
            
       
    
    </form>
-->
</body>
</html>