<?php include('content/head.php'); ?>
<body>

<main>

	<?php include('content/header.php'); ?>

	<div class="title-page">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center mt-5">
					<h1>Pesquisa de personagens da Marvel</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="part-pesquisa py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form action="#" method="POST">
						<div class="form-group form-basic">
							<input type="text" class="form-control" placeholder="Digite para pesquisar um personagem" name="pesquisar" required>
							<button type="submit" class="btn btn-danger btn-canto" name="submit">Pesquisar</button>
						</div>

					</form>

					<?php
					if ( isset($_POST['submit']) ) {
						$pesquisar = $_POST['pesquisar'];
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="boxes-marvel py-5">
		<div class="container">
			<div class="card-columns">

				<?
				if ( isset($pesquisar) ) {

					include('content/key.php');

					$url = 'https://gateway.marvel.com:443/v1/public/characters?nameStartsWith='  . $pesquisar .'&' . $query;

					//make the request
					$response = file_get_contents($url);

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_URL, $url);
					$result = curl_exec($ch);
					curl_close($ch);

					//convert the json string to an array
					$marvelArray = json_decode($result, true);

					$results = $marvelArray['data']['results'];

					foreach ($results as $marvelChars) {
					?>

						<div class="card">
							<a href="informacao.php?id=<?=$marvelChars['id'];?>">
								<img class="card-img-top" src="<?=$marvelChars['thumbnail']['path'] . '.' . $marvelChars['thumbnail']['extension'];?>" alt="<?=$marvelChars['name'];?>">
							</a>
							<div class="card-body">
								<h5 class="card-title"><?=$marvelChars['name'];?></h5>
								<p class="card-text"><?=$marvelChars['description'];?></p>
							</div><!-- /card-body-->
							<ul class="list-group list-group-flush">
								<?php
								if ($marvelChars['series']['available'] > 0) {
									echo '<li class="list-group-item active"><h6>Séries:</h6></li>';
								}

								$series = $marvelChars['series']['items'];

								foreach ($series as $serie) {
									echo '<li class="list-group-item">' . $serie['name'] . '</li>';
								}//foreach serie

								?>
							</ul>
						</div><!-- /card -->

					<?php
					}//foreach marvel
					?>

				<?php
				}//if isset(pesquisar)
				?>
			</div>
		</div>
	</div><!--boxes-marvel-->

	<?php include('content/footer.php'); ?>


</main>

<?php include('content/scripts.php'); ?>

</body>
</html>
