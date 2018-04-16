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
	<h3>Спасибо за регистрацию <?php echo $_POST['name'] ?></h3>
	<?php if( $_POST ){ $controller->completeRegistration(); } ?>
    <script language="JavaScript" type="text/javascript">
        
        function changeurl(){self.location="index.php";}
        
        window.setTimeout("changeurl();",4000);
        
    </script>
</body>
</html>
