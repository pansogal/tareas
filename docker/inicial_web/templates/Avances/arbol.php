<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto $proyecto
 */
	function busca_en ( $array, $key, $value ){
		foreach($array as $obj){
			if( $obj->$key  == $value) return $obj;
		}
		return null;
	}

?>

<div class="row">
	<?= $this->Html->link('Avances', ['controller'=>'Avances','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Acciones', ['controller'=>'Acciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="row">
    <div class="column-responsive column-100">
        <div class="proyectos view content">
            <h3><?= $proyecto->codigo.' - '.$proyecto->proyecto ?></h3>
		<?php
			// actuales
			foreach($avances as $av){
				echo "<b>Avance: ".$av->avance."</b><br />";
				foreach($av->acciones as $acc){
					echo "Accion: ".$acc->accion."<br />";
					echo "&nbsp;&nbsp;&nbsp;<b>Técnicos asignados:</b><br />";
					foreach($acc->tecnicos as $tec){
						echo "&nbsp;&nbsp;&nbsp;".$tec->nombre." - ".$tec->cargo."<br />";
					}
					echo "&nbsp;&nbsp;&nbsp;<b>Técnicos recomendados:</b><br />";
					$tt = busca_en($ttareas, 'codigo', $acc->code);
					if( !is_null($tt) ){
						echo "Encontrado: ".$tt->tarea. "<br />";
						foreach($tt->tecnicos as $tec){
							if($proyecto->delegacione_id == $tec->delegacione_id  || $tec->central ){
								echo $tec->nombre."<br />";
								$existe = busca_en($acc->tecnicos, 'id', $tec->id);
								if( is_null($existe) ){
									echo "----------------------------------->>>>>>>>>>>>  CREAR<br />";
								}else{
									echo "----------------------------------->>>>>>>>>>>>  OK, CORRECTO <<<<<<<<<<<<<<<<< <br />";
								}
							}
						}
					}
				}
			}
			




		?>
		</div>
	</div>
</div> <br /> <br />



 
