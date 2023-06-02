<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto $proyecto
 */
?>
<div class="row">
	<?= $this->Html->link('Avances', ['controller'=>'Avances','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Acciones', ['controller'=>'Acciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="row">
    <div class="column-responsive column-100">
        <div class="proyectos view content">
            <h3><?= h($proyecto->proyecto) ?></h3>
            <table>
                <tr>
                    <th><?= __('Proyecto') ?></th>
                    <td><?= $this->Html->link( $proyecto->codigo.' - '.$proyecto->proyecto , ['controller' => 'Proyectos', 'action' => 'view', $proyecto->id], 
																					['class'=>'button2'])  ?></td>
                    <td><?= $proyecto->has('delegacione') ? 
			'Delegación: '.$this->Html->link($proyecto->delegacione->delegacion, ['controller' => 'Delegaciones', 'action' => 'view', $proyecto->delegacione->id], 
																					['class'=>'button2']) 
			: '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Empresa') ?></th>
                    <td><?= $proyecto->has('empresa') ? $this->Html->link($proyecto->empresa->empresa, ['controller' => 'Empresas', 'action' => 'view', $proyecto->empresa->id]) : '' ?></td>
                    <td><?= 'Dónde: '.$proyecto->lugar ?></td>
                </tr>
            </table>
        </div>
    </div>
</div> <br />

<div class="row">
    <div class="column-responsive column-100">
        <div class="proyectos view content">
	<h3>Parámetros <?= $this->Html->link('Reset', ['controller' => 'Valores', 'action' => 'reset', $proyecto->id], ['class'=>'button2']) ?></h3>
	<table>
		<tbody>
		<?php foreach ($proyecto->parametros as $para): ?>
		<tr>
			<td>
				<?= $para->parametro ?>
				<?php
					if( $para->_joinData->siguiente>0) echo ' ('.$para->_joinData->siguiente. ')';
				?>
			</td>
			<td title='<?= $para->describe ?>' id='<?= $para->_joinData->id ?>' ><?= $para->_joinData->valor ?></td>
			<td><?php 
					if($para->puede_otro ){ // admite otro más
						echo  $this->Html->link('Añade otro', ['controller' => 'Valores', 'action' => 'otro', $proyecto->id, $para->id], ['class'=>'button2']);
						if($para->_joinData->siguiente != 0){
							echo  $this->Html->link('Quitar', ['controller' => 'Valores', 'action' => 'quitar', $proyecto->id, $para->_joinData->id, $para->id], ['class'=>'button2']);
						}
					}
			?></td>
		</tr>
		<?php endforeach; ?>
            </tbody>
        </table>

        </div>
    </div>
</div> <br /> <br />
