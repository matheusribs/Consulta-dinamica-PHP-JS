<?php
	//recebemos nosso par�metro vindo do form
	$parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
	$msg = "";
	//come�amos a concatenar nossa tabela
	$msg .="<table class='table table-hover'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th>Código:</th>";
	$msg .="			<th>Produto:</th>";
	$msg .="			<th>Grupo:</th>";
	$msg .="			<th>Fabricante:</th>";
	$msg .="			<th>Saldo:</th>";
	$msg .="			<th>Peso:</th>";
	$msg .="			<th>Comprimento:</th>";
	$msg .="			<th>Largura:</th>";
	$msg .="			<th>Altura:</th>";
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";
				
				//requerimos a classe de conex�o
				require_once('class/Conexao.class.php');
					try {
						$pdo = new Conexao(); 
						$resultado = $pdo->select("SELECT * FROM mytable WHERE CODIGO LIKE '$parametro%' ORDER BY NOMEPRODUTO ASC");
						$pdo->desconectar();
								
						}catch (PDOException $e){
							echo $e->getMessage();
						}	
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td>".$res['CODIGO']."</td>";
	$msg .="					<td>".$res['NOMEPRODUTO']."</td>";
	$msg .="					<td>".$res['GRUPO']."</td>";
	$msg .="					<td>".$res['FABRICANTE']."</td>";
	$msg .="					<td>".$res['SALDO_ESTOQUE']."</td>";
	$msg .="					<td>".$res['PESO_BRUTO']."</td>";
	$msg .="					<td>".$res['COMPRIMENTO']."</td>";
	$msg .="					<td>".$res['LARGURA']."</td>";
	$msg .="					<td>".$res['ALTURA']."</td>";

	$msg .="				</tr>";
							}	
						}else{
							$msg = "";
							$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="	</tbody>";
	$msg .="</table>";
	//retorna a msg concatenada
	echo $msg;
?>