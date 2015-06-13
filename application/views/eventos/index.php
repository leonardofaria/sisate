<a href="#" class="btn btn-primary btn-new pull-right">
  Cadastrar evento
</a>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			Todos os eventos
		</h4>
	</div>
	<div class="panel-body">

		<table data-toggle="table" data-search="true" class="table table-hover table-striped">
			<thead>
				<tr>
					<th data-sortable="true">Nome</th>
					<th data-sortable="true">Perfil</th>
					<th data-sortable="true">Ativo?</th>
				</tr>
			</thead>
			<tbody>

		<?php

		foreach ($eventos as $row) {

			$evento_id = $row->getId();

			echo "<tr>";
			echo "<td><a href=\"#\" class=\"nome editable editable-click\" data-type=\"text\" data-pk=\"" . $row->getId() . "\" data-name=\"nome\" data-url=\"eventos/atualizar\" data-value=\"" . $row->getNome(). "\" data-showbuttons=\"false\">" . $row->getNome() . "</a></td>";
			echo "<td><a href=\"#\" class=\"perfil editable editable-click\" data-type=\"select\" data-pk=\"$evento_id\" data-name=\"Perfil\" data-source=\"api/perfis\" data-url=\"eventos/atualizar\" data-value=\"" . $row->getPerfil()->getId(). "\" data-showbuttons=\"false\">" . $row->getPerfil()->getNome() . "</td>";
			echo "<td><a href=\"#\" class=\"ativo editable editable-click\" data-type=\"select\" data-pk=\"$evento_id\" data-name=\"ativo\" data-url=\"eventos/atualizar\" data-value=\"" . $row->getAtivo	(). "\" data-showbuttons=\"false\">" . $row->getAtivo() . "</td>";
			echo "</tr>";

		}

		?>

		</tbody>
		</table>

	</div>
</div>
