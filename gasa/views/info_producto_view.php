<?php 
if($infoproducto !=false)
{
 	foreach($infoproducto->result() as $producto)
	{
?>
	<a id="popupContactClose" style="cursor:pointer">x</a>
	<div class="normales">
	<h1> <?php echo $producto->nombre;?> </h1>
	<strong>Código</strong>:<?php echo $producto->codigo;?><br /> 
	<strong>Descripción</strong>: <?php echo $producto->descripcion;?><br /> 
	<strong>Status</strong>: <?php echo statusproducto_id($producto->status);?><br/>
	<?php 
	switch($producto->status)
	{
		
	case EN_RENTA:
	{
	?>
		<strong>Cliente</strong>: <?php echo $producto->cliente;?><br /> 
		<strong>Télefono</strong>:<?php echo $producto->telefono;?><br /> 
		<strong>Móvil</strong>:<?php echo $producto->celular;?><br /> 
	    <strong>Fecha Renta</strong>: <?php echo date("d/m/Y",strtotime($producto->fecha_salida));?><br /> 
        <strong>Fecha Promesa</strong>:<?php echo date("d/m/Y",strtotime($producto->fecha_promesa));?><br />
      
	   <strong>Situacion</strong>:  
		<?php $valor = $producto->dias;
				if($valor >0)
				{
					$situation = "Retraso";
					echo "<span class='normales_bold_rojas'>$situation</span>";
				}else{
					$situation = "A tiempo";
					echo "<span>$situation</span>";
				}?>
		<br /> 
		<?php if($situation=="Retraso")
				{?>
				<strong>Dias Retraso</strong>:
				<?php   $valor= $producto->dias;
						if($valor >0)
						{
							echo $valor." <img style='margin-left:15px;' src='images/alert.png' width='14' height='15' />";
						}
						else { 
								echo $valor; 
							}
				} ?><br/>
	  
		<strong>Atendio</strong>:<?php echo $producto->created_by;?><br /> 
		<?php 
		}
		break;
	}?>
	</div>
<?php }} ?>