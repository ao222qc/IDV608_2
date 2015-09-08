<?php

class DateTimeView {


	public function show() {

		date_default_timezone_set("Europe/Stockholm");

		$weekDay = date('l');
		$numericDate = date('j');
		$month = date('F');
		$time = date('y:h:sa');

		$timeString = $weekDay . " the " . $numericDate . "th of " . $month . ". The time is : " . $time;

		return '<p>' . $timeString . '</p>';
	}
}