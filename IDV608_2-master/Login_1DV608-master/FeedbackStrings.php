<?php

class FeedbackStrings
{
	const SECTION_LOGIN = "login";
	const SECTION_REGISTER = "register";
	const UNAMEFAIL = "username_missing";
	const PWORDFAIL = "password_missing";
	const LOGINSUCCESS = "login_success";
	const LOGINFAIL = "login_fail";
	const LOGOUTSUCCESS = "logout_success";
	const REPEATPASSWORDFAIL = "repeat_password_fail";
	const UNAMEEXISTSFAIL = "username_exists";
	const INVALIDCHARFAIL = "invalid_char";
	const REGISTRATIONSUCCESS = "registration_success";

	private static $FeedbackStrings;

	public static function LoadLanguageFile($filename)
	{
		self::$FeedbackStrings = parse_ini_file($filename, true);
	}

	public static function Get($section, $string)
	{
		if(isset($string))
		{
			return self::$FeedbackStrings[$section][$string];
		}		
	}
	
}

