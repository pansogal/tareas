<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto $proyecto
 */
?>

<?= $this->Html->script('node_modules/frappe-gantt/dist/frappe-gantt.min.js') ?>
<?= $this->Html->css('frappe-gantt.css') ?>

<div class="row">
	<?= $this->Html->link('Avances', ['controller'=>'Avances','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Acciones', ['controller'=>'Acciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div><br />



<div class="row">
	<div class="column-responsive column-100">
		<div class="proyectos view content">
			<h3><?= h($proyecto->proyecto) ?></h3>
			<?php 
				$user = $this->request->getAttribute('identity');
				if( $user->id == 1){  // admin
					echo  $this->Form->postLink('Borrar' , ['action' => 'delete', $proyecto->id], 
							['confirm' => __('Quieres borrar este proyecto # {0}?', $proyecto->id), 'class' => 'button2 float-right']);
				}
			?>
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

<!--   GANTT -------------------------------->   
<div class="row">
	<div class="column-responsive">
		<svg  id="gantt"></svg>
	</div>
</div><br />
<?= '<script>var tasks='.$proyecto->gantt.';</script>' ?>
<script>
/*var tasks = [
  {
    id: 'Task 1',
    name: 'Redesign website',
    start: '2016-12-28',
    end: '2016-12-29',
    progress: 20,
    dependencies: 'Task 2, Task 3',
    //custom_class: 'bar-milestone' // optional
  }];*/

var gantt = new Gantt("#gantt", tasks, {
    header_height: 50,
    column_width: 30,
    step: 24,
    view_modes: ['Quarter Day', 'Half Day', 'Day', 'Week', 'Month'],
    bar_height: 20,
    bar_corner_radius: 3,
    arrow_curve: 5,
    padding: 18,
    view_mode: 'Day',
    date_format: 'YYYY-MM-DD',
    language: 'es', // or 'es', 'it', 'ru', 'ptBr', 'fr', 'tr', 'zh', 'de', 'hu'
    custom_popup_html: null
});

gantt.change_view_mode('Day'); // Quarter Day, Half Day, Day, Week, Month 
</script>


<!--   AVANCES -------------------------------->            
<div class="row">
	<div class="column-responsive column-100">
		<div class="proyectos view content">            
			<?= $this->Html->link('Crear Arbol', ['controller' => 'Avances', 'action' => 'arbol', $proyecto->id], ['class' => 'button2 float-right']) ?>
			<div class="related">
				<h4><?= "ESTADO DE AVANCES" ?></h4>
				<div class='leyenda'>Leyenda: 
					<span class='rojo' title='La acción necesita otras para empezar.'>Esperando</span>
					<span class='naranja' title='La acción puede empezar, pero no ha empezado aún.'>Lista para empezar</span>
					<span class='ama' title='La acción ya está en marcha, se le asignó fecha de inicio.'>En marcha</span>
					<span class='verde' title='La acción fue compoletada.'>Completada</span>
				</div>
			  
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
									$title = $sema['accion']." terminado, no bloquea";
								} else{
									$title = $acc->accion." está esperando por ".$sema['accion'];
								}
								if( $idx > 1){
									$dx=0;
									echo "<br /><br />";
								}
								$color = $sema['color'];
								echo "<span class='$color' title='$title'>".$sema['code']."</span>";
								$idx++;
							}
							$idx=0;
							echo "</td>";
							$comp2 = $acc->color;  // extraemos la clase de color
							
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
									echo "<div><span style='white-space: nowrap;' class='verde' title='".$tec->cargo."'>".$tec->nombre."</span>".
									"<span class='peque' style='white-space: nowrap;'>".$tec->cargo."<b> (".$tec->delegacione->corto.")</b> </span></div>";
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
