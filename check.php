<?php
session_start();


require "Authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: valida.php");
    die();
}
$Authenticator = new Authenticator();




$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

if (!$checkResult) {
    $_SESSION['failed'] = true;
    header("location: valida.php");
    die();
} 


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Autenticação concluida!</title>
    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #65ADE2, #BA83C0);
    transition: 0,5s;
}

.whitecampo {
    display: flex;
    justify-content: center;
    background: #fff;
    padding: 15px;
}

img {
    width: 500px;
    height: 500px;
}
    </style>
<link rel="stylesheet" href="css/main.css">

</head>
<body>
    <div class="whitecampo">
        <p class="titulo">autenticado.</p>
        <img src="https://media-exp1.licdn.com/dms/image/C4E03AQF1dq3YAW88oA/profile-displayphoto-shrink_200_200/0/1517660741037?e=1675296000&v=beta&t=9y2R8Syjbjh9m3VGcRTk4cpkCACtMYWMwt4sZG54CdQ" alt="claudio">
    </div>
</body>
</html>