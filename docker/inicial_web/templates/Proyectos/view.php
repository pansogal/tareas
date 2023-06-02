<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto $proyecto
 */
?>
<style>
	.rojo{
		background-color: red;
		color: white;
		padding: 5px 2px 2px 4px;
		margin: 1px 2px 4px 4px !important;
	}
	.verde{
		background-color: green;
		color: white;
		padding: 5px 2px 2px 4px;
		margin: 1px 2px 4px 4px !important;
	}
	.blanco{
		background-color: white;
		color: blue;
		padding: 5px 4px 3px 4px;
		margin: 1px 4px 1px 4px;
	}
	.mitabla{
		font-size: 1.0em;
		line-height: 1.0;
		width: 100%;
	}
	
</style>

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
                    <td><?= $proyecto->codigo.' - '.$proyecto->proyecto ?></td>
                    <td><?= $proyecto->has('delegacione') ? 'Delegación: '.$this->Html->link($proyecto->delegacione->delegacion, ['controller' => 'Delegaciones', 'action' => 'view', $proyecto->delegacione->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Empresa') ?></th>
                    <td><?= $proyecto->has('empresa') ? $this->Html->link($proyecto->empresa->empresa, ['controller' => 'Empresas', 'action' => 'view', $proyecto->empresa->id]) : '' ?></td>
                    <td><?= 'Dónde: '.$proyecto->lugar ?></td>
                </tr>
                <tr>
                    <th><?= __('Corto') ?></th>
                    <td><?= h($proyecto->corto) ?></td>
                    <td><?php  
					if( count($proyecto->valores) == 0 ) {
						echo "<span style='color: red' >No está parametrizado. </span>";
						echo $this->Html->link( 'Crear Parámetros', ['controller' => 'Parametros', 'action' => 'desde_proyecto', $proyecto->id],['class' => 'button2']);
					}else{
						echo $this->Html->link( 'Ver Parámetros', ['controller' => 'Parametros', 'action' => 'desde_proyecto', $proyecto->id],['class' => 'button2']);
					}
				?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($proyecto->created) ?></td>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($proyecto->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Es Fv') ?></th>
                    <td><?= $proyecto->es_fv ? __('Yes') : __('No'); ?></td>
                    <th><?= __('Es Clima') ?></th>
                    <td><?= $proyecto->es_clima ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Es Industrial') ?></th>
                    <td><?= $proyecto->es_industrial ? __('Yes') : __('No'); ?></td>
                    <th><?= __('Es Residencial') ?></th>
                    <td><?= $proyecto->es_residencial ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            

</div></div></div> <br />

<!--   AVANCES -------------------------------->            
<div class="row">
    <div class="column-responsive column-100">
        <div class="proyectos view content">            
            <?= $this->Html->link('Crear Arbol', ['controller' => 'Avances', 'action' => 'arbol', $proyecto->id], ['class' => 'button2 float-right']) ?>
            <div class="related">
                <h4><?= "ESTADO DE AVANCES" ?></h4>
		      
                <?php if (!empty($proyecto->avances)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th> Avance </th>
                            <th> Semaforos / Acciones / Asignados </th>
                        </tr>
                        <?php
					foreach ($proyecto->avances as $avance) : 
					if($avance->completado == 1) $comp = 'verde';  else $comp = 'rojo';
				?>
                        
                        <tr>
				   
                            <td><?= "<span class='$comp'>".$avance->avance."</span>" ?></td>
                            <td  style='width:80%'>
					<table class="mitabla"><tbody>
					<?php 
						foreach ($avance->acciones as $acc){
							echo "<tr>";
							// semaforo
							echo "<td style='width:15%'>";
							$idx=0;
							foreach($acc->semaforos as $sema){
								if( $sema['realizada'] == 1){
									$comp3 = 'verde';
									$title = $sema['accion']." terminado, no bloquea";
								} else{
									$comp3 = 'rojo';
									$title = $acc->accion." está esperando por ".$sema['accion'];
								}
								if( $idx > 1){
									$dx=0;
									echo "<br /><br />";
								}
								echo "<span class='$comp3' title='$title'>".$sema['code']."</span>";
								$idx++;
							}
							$idx=0;
							echo "</td>";
							// accion
							if($acc->realizada == 1) $comp2 = 'verde';  else $comp2 = 'rojo';
							
							//echo  "<td><b>".$acc->code."</b> <span class='$comp2'>".$acc->accion."</span></td>";
							echo "<td style='width:50%'>";
							echo "<b>".$acc->code."</b> ".$this->Html->link($acc->accion, ['controller' => 'Acciones', 'action' => 'edit', $acc->id, $proyecto->id], [
									'class' => 'button3 '.$comp2,
									'title' =>$acc->descripcion,
								]);
							echo "</td>";
							
							//  IMPLICAR ///
							echo "<td style='width:30%'>";
								foreach($acc->tecnicos as $tec){
									if( isset($primero) ) echo "<br />";
									else $primero = 1;
									echo "<div><b>".$tec->delegacione->corto."</b> <span class='verde' title='".$tec->cargo."'>".$tec->nombre."</span></div>";
								}
								unset($primero);
								
							echo "</td>";
							echo "<td style='width:5%'>";
								echo $this->Html->link('+T', ['controller' => 'Acciones', 'action' => 'implicar', $acc->id,  $proyecto->id], 
										['title'=>'Modificar técnicos asignados a la acción', 'class' => 'button3 blanco float-right']);
							echo "</td>";
							echo "</tr>";
						 }
					?>
					</tbody></table>
                            </td>
				
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<br /> <br />
