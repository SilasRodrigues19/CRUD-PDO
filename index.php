<?php
	require_once 'clientClass.php';
	$c = new Customer("crudpdo", "localhost", "root", "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="https://www.grupoalliance.com.br/wp-content/uploads/2016/09/%C3%ADcone-cadastro.png">
	<title>Sistema de cadastros - Cadastre e visualize</title>
	<!-- Data Table -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

	<!-- Swal CSS -->
	<link rel="stylesheet" href="css/swal.css">
	
	<link rel="stylesheet" href="css/style.css">

	<!-- JQuery Plugin Script -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<!-- JQuery Compatible with JQuery Mask-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- JQuery Validator -->
	<script src="js/jquery.validate.min.js"></script>
	<!-- Validator Messages -->
	<script src="js/localization/messages_pt_BR.js"></script>
	<!-- Mask Plugin JQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	<!-- Data Table JS -->
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
	<script src="http://cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"></script>
	<script>
		$(document).ready( function () {
    		$('#table').DataTable({
    			"language": {
    			        url: 'http://cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
    			    }
    		});

		});
	</script>

	 	<script>

		  jQuery(function ($) {
	        $("#form").validate({
	          rules: {
	             nome: {
	              minlength: 2,
	              maxlength: 15,
	              required: true            

	             },
	             celular: {
	              required: true,
	              minlength: 15
	             },
	             email: {
	              required: true,
	              email: true
	             }
	          },
	          messages:{
	             nome: {
	              required:"Por favor, informe seu nome"
	             },
	             celular: {
	              required:"Informe seu celular (apenas números)",
	              minlength:"Digite seu número corretamente. Ex:. (11) 11111-1111 apenas números"
	             },
	             email: {
	              required:"Por favor, informe seu e-mail para contato"
	             }
	            }
	        })
	      });
	        $("#celular").mask("(00) 00000-0000");
	 	</script>


</head>
<body>

		<!-- Nav bar -->
		<nav class="navbar is-transparent">
		  <div class="navbar-brand">
		    <a class="navbar-item" href="#">
		      <i class="fas fa-ghost fa-2x"></i>
		    </a>
		    <div class="navbar-burger" data-target="navbarExampleTransparentExample">
		      <span></span>
		      <span></span>
		      <span></span>
		    </div>
		  </div>

		  <div id="navbarExampleTransparentExample" class="navbar-menu">
		    <div class="navbar-start">
		      <a class="navbar-item" href="#">
		        <span class="icon-text">
			         <span class="icon">
			           <i class="fas fa-home"></i>
			         </span>
			         <span>Home</span>
		        </span>
		      </a>
		      <div class="navbar-item has-dropdown is-hoverable">
		        <a class="navbar-link" href="#">
		          <span class="icon-text">
			          <span class="icon">
			            <i class="fas fa-tools"></i>
			          </span>
			          <span>Ações</span>
		          </span>
		        </a>
		        <div class="navbar-dropdown is-boxed">
		          <a class="navbar-item" href="#cadastrados">
			          <span>Cadastros</span>
		          </a>
		        </div>
		      </div>
		    </div>

		    <div class="navbar-end">
		      <div class="navbar-item">
		        <div class="field is-grouped">
		          <p class="control">
		            <a class="bd-tw-button button" href="https://silasrodrigues19.github.io/public/9" target="_blank">
		              <span class="icon">
		                <i class="fas fa-mug-hot"></i>
		              </span>
		              <span>
		                Portfolio
		              </span>
		            </a>
		          </p>	
		          <p class="control">
		            <a class="bd-tw-button button" href="https://github.com/SilasRodrigues19" target="_blank">
		              <span class="icon">
		                <i class="fab fa-github"></i>
		              </span>
		              <span>
		                GitHub
		              </span>
		            </a>
		          </p>
		          <p class="control">
		            <a class="bd-tw-button button" href="https://twitter.com/jinuye1" target="_blank">
		              <span class="icon">
		                <i class="fab fa-twitter"></i>
		              </span>
		              <span>
		                Twitter
		              </span>
		            </a>
		          </p>
		        </div>
		      </div>
		    </div>
		  </div>
		</nav>
		<!-- End Nav bar -->


		<!-- Section Form -->
		<?php 

			if (isset($_POST['nome'])) // Clicou no botão cadastrar ou editar
			{
				if (isset($_GET['id_up']) && !empty($_GET['id_up'])) 
				{
					$id_upd = addslashes($_GET['id_up']);
					$nome = addslashes($_POST['nome']);
					$celular = addslashes($_POST['celular']);
					$email = addslashes($_POST['email']);
					if (!empty($nome) && !empty($celular) && !empty($email)) 
					{
						// Editar
						($c->updateData($id_upd, $nome, $celular, $email))
						
		?>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
						<script>
							swal({
							  title: "Alterado com sucesso!",
							  text: "Registro alterado!",
							  icon: "success",
							});
							setTimeout(function(){location.href="index.php"} , 5000); 
						</script>
		<?php
								

					} 

				} 
				else // Cadastrar 
				{ 
					$nome = addslashes($_POST['nome']);
					$celular = addslashes($_POST['celular']);
					$email = addslashes($_POST['email']);
					if (!empty($nome) && !empty($celular) && !empty($email)) 
					{
						// Cadastrar
						if($c->registerCustomer($nome, $celular, $email))
						{
		?>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
						<script>
							swal({
							  title: "Cadastrado com sucesso!",
							  text: "Registro inserido!",
							  icon: "success",
							});
							setTimeout(function(){location.href="index.php"} , 5000); 
						</script>
		<?php
						} 
						else
						{
		?>
							<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
							<script>
								swal({
								  title: "Cadastrado falhou!",
								  text: "Este e-mail já existe no banco de dados!",
								  icon: "error",
								});
								setTimeout(function(){location.href="index.php"} , 5000); 
							</script>
		<?php
						}

					} 

				}

				
			}
		
		?>

		<?php 

		if (isset($_GET['id_up'])) { // Se clicou no editar
			$id_update = addslashes($_GET['id_up']);
			$response = $c->fetchDataCustomer($id_update);
		}

		?> 
		<section class="section">
			<div class="container">
				<div class="columns is-centered">
					<div class="column is-ralf">
						<h1 class="title has-text-centered"><?php if(isset($response)){echo "Alterar Cliente";} else {echo "Cadastrar Cliente";} ?></h1>

						<form action="" method="POST" id="form" onsubmit="fetchDataTerms();">
							<!-- Nome -->
							<div class="field">
								<label class="label height-label" for="nome">Nome</label>
								<div class="control has-icons-left has-icons-right">
									<input class="input is-dark is-rounded" type="text" placeholder="Seu nome" name="nome" id="nome" value="<?php if(isset($response)){echo $response['nome'];} ?>">
									 <span class="icon is-small is-left">
									   <i class="fas fa-user"></i>
									 </span>
									 <span class="icon is-small is-right">
									   <i class="fas fa-info-circle"></i>
								 	 </span>
								</div>
							</div>

							<!-- Celular -->
							<div class="field">
								<label class="label height-label" for="celular">Celular</label>
								<div class="control has-icons-left has-icons-right">
									<input class="input is-dark is-rounded" type="text" placeholder="Seu número" name="celular" id="celular" value="<?php if(isset($response)){echo $response['celular'];} ?>">
									 <span class="icon is-small is-left">
									   <i class="fas fa-phone"></i>
									 </span>
									 <span class="icon is-small is-right">
									   <i class="fas fa-info-circle"></i>
								 	 </span>
								</div>
							</div>

							<!-- E-mail -->
							<div class="field">
							  	<label class="label height-label" for="email">Email</label>
							  	<div class="control has-icons-left has-icons-right">
							    	<input class="input is-dark is-rounded" type="email" placeholder="Seu melhor e-mail" name="email" id="email" value="<?php if(isset($response)){echo $response['email'];} ?>">
							    	<span class="icon is-small is-left">
							      	  <i class="fas fa-envelope"></i>
							    	</span>
							    	<span class="icon is-small is-right">
							      	  <i class="fas fa-info-circle"></i>
							    	</span>
							  	</div>
							</div>

							<!-- Termos de uso -->
							<div class="field">
							  <div class="control">
							    <label class="checkbox">
							      <input type="checkbox" name="checkbox" class="termsAndConditions" id="agree" onclick="fetchDataTerms();" checked>
							      Li e concordo com os <a href="#" id="btn">termos e condições</a>
							    </label>
							  </div>
							</div>

							<!-- Termos de uso modal -->
							<div class="modal" id="myModal">
							  <div class="modal-background"></div>
							  <div class="modal-card">
							    <header class="modal-card-head">
							      <p class="modal-card-title has-text-centered">Termos de uso e condições</p>
							      <button class="delete" aria-label="close" data-bulma-modal="close"></button>
							    </header>
							    <section class="modal-card-body">
							    	<li>Seus dados serão salvos no <strong>Banco de dados</strong> dessa aplicação</li>
							    	<li>Clique em <strong>Concordar</strong> caso esteja em conformidade</li>
							    	<li>Clique em <strong>Discordar</strong> caso não esteja em conformidade</li>
							    	<li><strong>O formulário só será enviado caso concorde com os termos</strong></li>
							    </section>
							    <footer class="modal-card-foot">
							      <button class="button is-success is-outlined" onclick="acceptTerms();" data-bulma-modal="close">
							      	<span class="icon has-text">
							      	    <i class="fas fa-check"></i>
							      	 </span>
							      	 <span>Concordo</span>
							      </button>
							      <button class="button is-danger is-outlined" onclick="denyTerms();" data-bulma-modal="close">
							      	<span class="icon has-text">
							      	    <i class="fas fa-ban"></i>
							      	 </span>
							      	 <span>Não concordo</span>
							      </button>
							    </footer>
							  </div>
							</div>

							<!-- Submit Button -->
							<div class="field is-grouped">
							  <div class="control">
							  	<input type="submit" class="button is-link is-small is-rounded" value="<?php if(isset($response)){echo "Alterar";} else {echo "Enviar";} ?>" onclick="acceptTerms();">
							  </div>
							  <div class="control">
							  	<input type="reset" class="button is-link is-light is-small is-rounded" value="Limpar">
							  </div>
							</div>
						</form>
					</div>
				</div>																				
			</div> <!-- Container -->
		</section>
		<!-- End Form Section -->

		<section class="section" id="column-result">
			<div class="container">
				<div class="columns is-centered">
					<div class="column is-ralf">
						<h1 class="title has-text-centered" id="cadastrados">Clientes Cadastrados</h1>
						<table class="table is-hoverable" id="table">
							<thead>
							    <tr>
							        <th>Nome</th>
							        <th>Celular</th>
							        <th>E-mail</th>
							        <th>Ações</th>
							    </tr>
							</thead>
							<tbody>
						<?php 
							$data = $c->fetchData();
							if (count($data) > 0) {
								for ($i = 0; $i < count($data); $i++) {
									echo "<tr>";
									foreach ($data[$i] as $key => $value) {
										if ($key != "id") {
											echo "<td>".$value."</td>";
										}
									}
						?>
									<td>
										<a class="button is-success is-small is-outlined is-rounded" id="btn-action" href="index.php?id_up=<?php echo $data[$i]['id']; ?>">
											<i class="fas fa-user-edit"></i>
										</a>
										<a class="button is-danger is-small is-outlined is-rounded" id="btn-action" href="index.php?id=<?php echo $data[$i]['id']; ?>">
											<i class="fas fa-user-times"></i>
										</a>
									</td>

						<?php
									echo "</tr>";

								}
														
								
						
							} else { // Banco vazio
								echo 'Não há pessoas cadastradas';
							}
						?>
							</tbody>
							<tfoot>
							    <tr>
							        <th>Nome</th>
							        <th>Celular</th>
							        <th>E-mail</th>
							        <th>Ações</th>
							    </tr>
							</tfoot>							
						</table>
					</div>
				</div>
			</div>
		</section>

		<!-- Footer -->
		<footer class="footer">
		  <div class="content has-text-centered">
		    <p>
		      O código fonte é licenciado pelo
		      <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. O conteúdo do site é licenciado por <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
		    </p>
		    <blockquote>
		      "O sucesso é ir de fracasso em fracasso sem perder o entusiasmo."
		    </blockquote>
			<cite>- Winston Churchill</cite>
		  </div>
		</footer>
	
		<script src="js/modal-bulma.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
		<script src="js/script.js"></script>
</body>
</html>

<?php 

	if (isset($_GET['id'])) 
	{
		$id_customer = addslashes($_GET['id']);
		$c->deleteCustomer($id_customer);
		header("Location: index.php");
	}

?>