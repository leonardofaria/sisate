<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			Todos os processos do órgão, incluindo arquivados
		</h4>
	</div>
	<div class="panel-body">

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th style="width: 160px">Objeto</th>
					<th style="width: 160px">Data</th>
					<th>Último evento</th>
					<th style="width: 170px">Órgão Responsável</th>
				</tr>
			</thead>
			<tbody>

		<?php

		foreach ($processos as $processo) {

			echo "<tr>";
			echo "<td><a href=\"" . base_url('processos/visualizar/' . $processo->getId()) . "\">";
			if ($processo->getNb()) {
				echo $this->inss->formataProtocolo($processo->getNb());
			} else if ($processo->getCtc()) {
				echo $this->inss->formataProtocolo($processo->getCtc());
			}
			echo "</a></td>";
			echo "<td>" . $processo->getCriado() . "</td>";
			echo "<td>" . $processo->getProcessoEventos()[0]->getEvento()->getNome();
			if ($processo->getProcessoEventos()[0]->getComplemento() != '') {
				echo " - " . $processo->getProcessoEventos()[0]->getComplemento();
			}
			echo "</td>";
			echo "<td>" . $processo->getOrgaoResponsavel()->getNome() . "</td>";
			echo "</tr>\n";

		}

		?>

		</tbody>
		</table>


	</div>
</div>
