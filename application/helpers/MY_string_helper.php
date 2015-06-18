<?php

function return_numbers($str)
{
	$str = str_replace('-', '', $str);
	return filter_var($str, FILTER_SANITIZE_NUMBER_INT);
}

