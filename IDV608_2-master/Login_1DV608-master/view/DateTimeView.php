<?php


class DateTimeView {


	public function show() {

		date_default_timezone_set("Europe/Stockholm");

		$weekDay = date('l');
		$numericDate = date('jS');
		$month = date('F');
		$year = date('Y');
		$time = date('y:h:s');

		$timeString = $weekDay . ", the " . $numericDate . " of " . $month . " " . $year . ", The time is " . $time;

		return '<p>' . $timeString . '</p>';
	}
}