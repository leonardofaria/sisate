<?php

function return_numbers($str)
{
	// echo "chamado";
	$str = str_replace('-', '', $str);
	return filter_var($str, FILTER_SANITIZE_NUMBER_INT);
}

