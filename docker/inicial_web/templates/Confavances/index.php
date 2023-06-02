<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Confavance[]|\Cake\Collection\CollectionInterface $confavances
 */
?>
<style>
	.verde{
		color: darkgreen;
	}
	.rojo{
		color: red;
	}
	.tinfo{
		background-color: darkgreen;
		color: white;
		padding: 0.2em 0.4em;
		margin: 0.2em 0.4em !important;
	}
	.tinfo:hover{
		background-color: gray;
		color: white;
		cursor:help;
	}
</style>
<h3 class='rojo'>Configuración: Avances</h3>
<div class="row">
	<?= $this->Html->link('Técnicos', ['controller'=>'Tecnicos','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Tareas', ['controller'=>'Tareas','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Delegaciones', ['controller'=>'Delegaciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>

<?php
	function desarrollaHijos($uno, $obj){
		foreach($uno->hijos as $hh){
			echo "<tr>";
				echo "<td>".$hh->cavance."</td>";	
				echo "<td>";
					foreach($hh->tareas as $tt){
						echo "<span class='tinfo' title='".$tt->descripcion."'>".$tt->codigo." - ".$tt->tarea. "</span><br />";
					}
					echo $obj->Html->link('Asigna Tareas', ['action' => 'asigna', $hh->id], ['class' => 'button2 float-right']);
				echo "</td>";
			echo "</tr>";
			desarrollaHijos($hh, $obj);
		}
	}
?>

<span class='verde'>Los avances son agrupaciones de tareas para todos los proyectos que luego serán acciones en cada proyecto concreto.</span><br />
<span class='verde'>Los avances suponen un hito conseguido cuando se finalizan.</span><br />
<span class='verde'>Modifique o cree los avances y asígnele las tareas que no estén ya asignadas a otros avances.</span><br />
<span class='verde'>Dos avances o más pueden avanzar en paralelo, por ser hijos de otro avance anterior, por ejemplo 'Acopios' y 'PRL'.</span>

<div class="row">
	<div class="column-responsive column-25">
		<div class="confavances index content">
			<h4>Conf. Avances</h4>
			<?php
			foreach ($arbol as $cavance) {
				echo $cavance . "<br />";
			}
			?>
		</div>
	</div>
	<div class="column-responsive column-75">
		<div class="confavances index content">
			<?php
				if($tech->user == 1){
					echo $this->Html->link('Nuevo Avance', ['action' => 'add'], ['class' => 'button2 float-right']);
				}
			?>
			<h3><?= 'Configuración de los avances de proyecto'?></h3>
				<table>  <thead>  <tr> <th>AVANCE </th> <th>TAREAS</th></tr></thead>
				<tbody>
			<?php
				foreach($iniciales as $aa){
					echo "<tr>";
						echo "<td>".$aa->cavance."</td>";	
						echo "<td>";
							foreach($aa->tareas as $tt){
								echo "<span class='tinfo' title='".$tt->descripcion."'>".$tt->codigo." - ".$tt->tarea. "</span><br />";
							}
							echo $this->Html->link('Asigna Tareas', ['action' => 'asigna', $aa->id], ['class' => 'button2 float-right']);
						echo "</td>";
					echo "</tr>";
					desarrollaHijos($aa, $this);
				}
			?>
			</tbody></table>
		</div>
	</div>
</div>

<br /><br />

