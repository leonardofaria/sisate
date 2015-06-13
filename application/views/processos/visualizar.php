<div class="panel panel-default">
	<div class="panel-heading">Dados principais</div>
	<div class="panel-body">

		<b>Data de cadastramento:</b> <?php echo $processo->getCriado(); ?> <br/>
		<b>APS Responsável:</b> <?php echo $processo->getOrgaoResponsavel()->getNome(); ?> <br/>
		<b>Órgão Atual:</b> <?php echo $processo->getOrgaoAtual()->getNome(); ?> <br/>

		<?php if ($processo->getOrgaoAtual()->getId() == $orgao_id) { ?>
		<br/>
		<p class="text-center">
			<a href="#" class="action" data-toggle="modal" data-target="#analisar_modal"><span class="glyphicon glyphicon-edit"></span> Analisar</a>
			<a href="#" class="action" data-toggle="modal" data-target="#encaminhar_modal"><span class="glyphicon glyphicon-share"></span> Encaminhar a outro órgão</a>
		</p>
		<?php } ?>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Histórico de Eventos</div>
	<div class="panel-body">

		<table class="table table-striped">
			<thead>
				<tr>
					<th style="width: 10px">#</th>
					<th style="width: 160px">Data</th>
					<th style="width: 85px">Usuário</th>
					<th>Evento</th>
					<th style="width: 140px">Documentos</th>
				</tr>
			</thead>
			<tbody>

		<?php

		$i = 1;

		foreach ($processo->getProcessoEventos() as $evento) {
			echo "<tr>";
			echo "<td>" . $i . "</td>";
			echo "<td>" . $evento->getCriado() . "</td>";
			echo "<td><span data-toggle=\"tooltip\" data-placement=\"top\" title=\"" . $evento->getUsuario()->getNome() . " <br/>" . $evento->getUsuario()->getPerfil()->getNome() . '<br/>' . $evento->getUsuario()->getOrgao()->getOl() . '<br/>' . $evento->getUsuario()->getOrgao()->getNome() . "\">" . $evento->getUsuario()->getSiape() . "</span></td>";
			echo "<td>" . $evento->getEvento()->getNome();
			if ($evento->getComplemento() != '') {
				echo " - " . $evento->getComplemento();
			}
			echo "</td>";
			echo "<td>";

			$j = 1;
			foreach ($evento->getDocumentos() as $documento) {
				echo "<a href=\"" . base_url('uploads/' . $documento->getNome()) . "\" target=\"_blank\"><span class=\"glyphicon glyphicon-file\"></span> Documento $j</a><br/>";
				$j++;
			}
			echo "</td>";
			echo "</tr>";

			$i++;
		}

		?>

		</tbody>
		</table>

</div>
</div>
