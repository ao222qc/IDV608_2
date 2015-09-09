<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/LoginController.php');
require_once('model/LoginModel.php');





//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$loginModel = new LoginModel();
$v = new LoginView($loginModel);
$dtv = new DateTimeView();
$lv = new LayoutView();


$loginController = new LoginController($v, $loginModel);
$loginController->checkUserAction();
$isLoggedIn = $loginController->checkIfLoggedIn();



$lv->render($isLoggedIn, $v, $dtv);

