

<?= $this->Html->link('Ver Proyecto', ['controller'=>'Proyectos', 'action' => 'view', $proyecto->id], ['class' => 'button2 float-left']) ?>
<h3>Proyecto: <?= "<b>".$proyecto->codigo.' - '.$proyecto->proyecto."</b> <br />en delegación de <b>".$proyecto->delegacione->delegacion."</b>" ?></h3>
<div class="row">
	<?= $this->Html->link('Avances', ['controller'=>'Avances','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Acciones', ['controller'=>'Acciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<br />
<h4>Asignación de técnicos a acción: <b>'<?= $accion->code." ".$accion->accion ?>'</b> dentro de avance: '<?= $accion->avance->avance ?>'</h4>



<div class="row">
     <div class="column-responsive column-50">
        <div class="acciones view content">
		 <h5>Técnicos asignados a acción "<?= $accion->accion ?>" :</h5>
		 <table><tbody>
		 <?php foreach ($accion->tecnicos as $tecnico) : ?>
		<tr><td>
			
		 <b><?= $tecnico->delegacione->delegacion ?>  </b> <?= $tecnico->nombre." (".$tecnico->cargo.")" ?>

		 <?= $this->Html->link('Desasignar', ['controller'=>'Acciones', 'action' => 'desimplicar', $tecnico->id, $accion->id], ['class' => 'button2']) ?>
		 <br />
		 </td></tr>
		 <?php endforeach; ?>
		 </tbody></table>
	</div>
    </div>

     <div class="column-responsive column-50">
        <div class="acciones view content">
		 <h5><b>Otros técnicos configurados para acción "<?= $accion->accion ?>" :</b></h5>
		 <table><tbody>
		 <?php foreach ($tdeles as $tdele) : ?>
		 <tr><td>

		 <b><?= $tdele->delegacione->delegacion ?>  </b> <?= $tdele->nombre." (".$tdele->cargo.")" ?>

		 <?= $this->Html->link('Asignar a accíon', ['controller'=>'Acciones', 'action' => 'asignar', $tdele->id, $accion->id], ['class' => 'button2 float-right']) ?>
		 <br />
		 </td></tr>
		 <?php endforeach; ?>
		 </tbody></table>
	</div>
    </div>


</div><br />

<div class="row">
	<div class="column-responsive column-50">
	</div>

	<div class="column-responsive column-50">
         <div class="acciones view content">
		 <h5><b>Resto de técnicos :</b></h5>
		 <table><tbody>
		 <?php foreach ($techs as $tdele) : ?>
		 <tr><td>

		 <b><?= $tdele->delegacione->delegacion ?>  </b> <?= $tdele->nombre." (".$tdele->cargo.")" ?>

		 <?= $this->Html->link('Asignar a accíon', ['controller'=>'Acciones', 'action' => 'asignar', $tdele->id, $accion->id], ['class' => 'button2 float-right']) ?>
		 <br />
		 </td></tr>
		 <?php endforeach; ?>
		 </tbody></table>
	</div>
    </div>
</div>
<br /><br />
