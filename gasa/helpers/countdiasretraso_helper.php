<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cuentadiasretraso'))
{
	function cuentadiasretraso($fecha_promesa = "")
	{
		//Inicio de fechas
		$hoy = date("Y-m-d");
		$fecha_promesa = date("Y-m-d",strtotime($fecha_promesa));
		//dividiendo en mes , dia, anios
		$hoy = split('-',$hoy);
		//defino fecha 1
		$ano1 = $hoy[0];
		$mes1 = $hoy[1];
		$dia1 = $hoy[2];
		$fecha_promesa = split('-',$fecha_promesa);
		//defino fecha 2
		$ano2 = $fecha_promesa[0];
		$mes2 = $fecha_promesa[1];
		$dia2 = $fecha_promesa[2]; 
		
		//calculo timestam de las dos fechas
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
		$timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2);
		if($timestamp1 > $timestamp2)
		{
			//resto a una fecha la otra
			$segundos_diferencia = $timestamp1 - $timestamp2;
			//echo $segundos_diferencia;

			//convierto segundos en días
			$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

			//obtengo el valor absoulto de los días (quito el posible signo negativo)
			$dias_diferencia = abs($dias_diferencia);

			//quito los decimales a los días de diferencia
			$dias_diferencia = floor($dias_diferencia);
		}
		else
		{
			$dias_diferencia ='';
		}
			return $dias_diferencia; 

	}
}
?>