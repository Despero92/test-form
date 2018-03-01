<?php
require 'controll\controller.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<?php
global $sql;

$user = mysqli_fetch_assoc($sql->requestUser());
?>
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-6">
                <h2>
					<?php echo 'Номер карты: ' . $user['id'] ?>
                </h2>
                <br>
                <h2>
                    <?php echo 'Имя пользователя ' . $user['name'] ?>
                </h2>
                <br>
                <h2>
                    <?php echo 'Email пользователя ' . $user['email'] ?>
                </h2>
                <br>
                <h2>
                    <?php echo 'Область: ' . $user['region'] ?>
                </h2>
                <br>
                <h2>
					<?php echo 'Город: ' . $user['city'] ?>
                </h2>
                <br>
                <h2>
					<?php echo 'Район: ' . $user['district'] ?>
                </h2>
                <br>
                <br>
            </div>
        </div>
    </div>
</body>
</html>
