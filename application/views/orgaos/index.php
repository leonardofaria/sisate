<a href="#" class="btn btn-primary btn-new pull-right">
  Cadastrar orgão
</a>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			Todos os orgãos
		</h4>
	</div>
	<div class="panel-body">

		<table data-toggle="table" data-search="true" class="table table-hover table-striped">
			<thead>
				<tr>
					<th data-sortable="true">OL</th>
					<th data-sortable="true">Nome</th>
					<th data-sortable="true">Modalidade</th>
				</tr>
			</thead>
			<tbody>

		<?php

		foreach ($orgaos as $row) {

			$modalidade_id = $row->getId();

			echo "<tr>";
			echo "<td>" . $row->getOl() . "</td>";
			echo "<td>" . $row->getNome() . "</td>";
			// echo "<td>" . $row->getModalidade()->getNome() . "</td>";
			echo "<td><a href=\"#\" class=\"modalidade editable editable-click\" data-type=\"select\" data-pk=\"$modalidade_id\" data-name=\"Modalidade\" data-source=\"api/modalidades\" data-url=\"orgaos/atualizar\" data-value=\"" . $row->getModalidade()->getId(). "\" data-showbuttons=\"false\">" . $row->getModalidade()->getNome() . "</td>";

			echo "</tr>";

		}

		?>

		</tbody>
		</table>

	</div>
</div>
