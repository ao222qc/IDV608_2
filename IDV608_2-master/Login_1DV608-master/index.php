<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/LoginController.php');
require_once('model/LoginModel.php');
require_once('model/RegistrationModel.php');
require_once('model/UserCredentials.php');
require_once('model/User.php');
require_once('model/UserDAL.php');
require_once('FeedbackStrings.php');
require_once('Settings.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

FeedbackStrings::LoadLanguageFile("eng.ini");

//CREATE OBJECTS OF THE VIEWS
$loginModel = new LoginModel();
$regModel = new RegistrationModel();
$uc = new UserCredentials();

$v = new LoginView($loginModel, $uc, $regModel);
$dtv = new DateTimeView();
$lv = new LayoutView();

User::Initialize();

$loginController = new LoginController($v, $loginModel, $uc, $regModel);
$loginController->checkUserAction();
$isLoggedIn = false;
$isLoggedIn = $loginController->checkIfLoggedIn();


$lv->render($isLoggedIn, $v, $dtv);

//http://ao222qc.web44.net/Login_1DV608-master/
//Link to published version.

