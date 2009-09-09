<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('statusproducto_id'))
{
	function statusproducto_id($id_status = "")
	{
		switch($id_status) {
			case 0:$status_text = STATUS_P0;	break;
			case 1:	$status_text = STATUS_P1;	break;
			case 2:	$status_text = STATUS_P2;	break;
			case 3:	$status_text = STATUS_P3;	break;
			case 4:	$status_text = STATUS_P4;	break;
		}
		return $status_text;
	}
}
?>