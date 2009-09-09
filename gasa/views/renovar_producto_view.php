<form action="catalogo/renovar_producto" method="post">
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
<br/><br/>
<span class="normales"><strong>Renovacion de producto:</strong></span><br />
<span class="normales">Dias a renovar producto:</span>
<select name="f_dia" id="f_dia">
                <option value="1">1</option>
				<option value="3">3</option>
				<option value="5">5</option>
				<option value="7">7</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="25">25</option>
				<option value="30">30</option>
				<option value="35">35</option>
				<option value="60">60</option>
              </select>
<input  type="hidden" name="dias_retraso" value="<?php echo $valor;?>"/>
<input  type="hidden" name="id" value="<?php echo $producto->id;?>"/>
<br/>
<input  type="submit" value="Renovar"/>
</form>