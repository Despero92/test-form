<?php
include 'controll\controller.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/chosen.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <form action="success_registration.php" method="post" id="form">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp"
                               placeholder="ФИО">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                               placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="region">Список областей</label>
                        <select class="form-control" id="region" data-placeholder="Выберите область" name="region">
                            <?php
                                $regions_array = $sql->requestRegion();
                                foreach ( $regions_array as $key => $value){ ?>
                            <option> <?php echo $regions_array[$key]['ter_address'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group city">
                        <label for="city">Список городов</label>
                        <select class="form-control" id="city" data-placeholder="Выберите город" name="city">
                        </select>
                    </div>
                    <div class="form-group district">
                        <label for="district">Список районов</label>
                        <select class="form-control" id="district" data-placeholder="Выберите район" name="district">
                        </select>
                    </div>
                    <div class="clrLn"><input class="submit clrLn" type="submit" value="Send"></div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/util.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/tooltip.js"></script>
    <script type="text/javascript" src="js/chosen.jquery.js"></script>
    <script src="js/common.js"></script>
</body>
</html>