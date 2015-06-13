<a href="<?php echo base_url('usuarios/cadastrar'); ?>" class="btn btn-primary btn-new pull-right">
  Cadastrar usuário
</a>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			Todos os usuários
		</h4>
	</div>
	<div class="panel-body">

		<table data-toggle="table" data-search="true" class="table table-hover table-striped">
			<thead>
				<tr>
					<th data-sortable="true">Siape</th>
					<th data-sortable="true">Nome</th>
					<th data-sortable="true">OL - Lotação</th>
					<th data-sortable="true">Perfil</th>
				</tr>
			</thead>
			<tbody>

		<?php

		foreach ($usuarios as $row) {

			$usuario_id = $row->getId();

			echo "<tr>";
			echo "<td>" . $row->getSiape() . "</td>";
			echo "<td>" . $row->getNome() . "<br/>" . $row->getEmail() . "</td>";
			echo "<td><a href=\"#\" class=\"ol editable editable-click\" data-type=\"select\" data-pk=\"$usuario_id\" data-name=\"Orgao\" data-source=\"api/orgaos\" data-url=\"usuarios/atualizar\" data-value=\"" . $row->getOrgao()->getId(). "\" data-showbuttons=\"false\">" . $row->getOrgao()->getOl() . " - ";
			echo $row->getOrgao()->getNome() . "</a></td>";
			echo "<td><a href=\"#\" class=\"perfil editable editable-click\" data-type=\"select\" data-pk=\"$usuario_id\" data-name=\"Perfil\" data-source=\"api/perfis\" data-url=\"usuarios/atualizar\" data-value=\"" . $row->getPerfil()->getId(). "\" data-showbuttons=\"false\">" . $row->getPerfil()->getNome() . "</td>";
			echo "</tr>";

		}

		?>

		</tbody>
		</table>

	</div>
</div>
