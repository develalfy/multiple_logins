<?php
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header('Location: '.$link.'public/index.php/login');
