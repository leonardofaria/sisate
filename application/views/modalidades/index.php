<a href="#" class="btn btn-primary btn-new pull-right">
  Cadastrar modalidade
</a>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			Todas as modalidades
		</h4>
	</div>
	<div class="panel-body">

		<table data-toggle="table" data-search="true" class="table table-hover table-striped">
			<thead>
				<tr>
					<th data-sortable="true">ID</th>
					<th data-sortable="true">Nome</th>
				</tr>
			</thead>
			<tbody>

		<?php

		foreach ($modalidades as $row) {

			echo "<tr>";
			echo "<td>" . $row->getId() . "</td>";
			echo "<td><a href=\"#\" class=\"nome editable editable-click\" data-type=\"text\" data-pk=\"" . $row->getId() . "\" data-name=\"nome\" data-url=\"perfis/atualizar\" data-value=\"" . $row->getNome(). "\" data-showbuttons=\"false\">" . $row->getNome() . "</a></td>";
			echo "</tr>";

		}

		?>

		</tbody>
		</table>

	</div>
</div>
