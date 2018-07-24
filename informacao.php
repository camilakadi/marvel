<?php include('content/head.php'); ?>
<body>

<main>

	<?php include('content/header.php'); ?>

	<div class="title-page">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center mt-5">
					<h1>Informações do Personagem</h1>
				</div>
			</div>
		</div>
	</div>

	<?

	$id = $_GET['id'];

	include('content/key.php');

	$url = 'https://gateway.marvel.com:443/v1/public/characters/' . $id . '?&' . $query;

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


	?>
		<div class="boxes-marvel my-5">
			<div class="container">
				<div class="row">

					<?php
					foreach ($results as $marvelChars) {
					?>
						<div class="col-12 mb-5">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<h2><?=$marvelChars['name'];?></h2>
									<p><?=$marvelChars['description'];?></p>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<a href="#">
										<img class="img-fluid" src="<?=$marvelChars['thumbnail']['path'] . '.' . $marvelChars['thumbnail']['extension'];?>" alt="<?=$marvelChars['name'];?>">
									</a>
								</div>
							</div><!--row-->
						</div><!--col-lg-12-->
						<div class="col-12">
							<!--series-->
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
							<!--comics-->
							<ul class="list-group list-group-flush">
								<?php
								if ($marvelChars['comics']['available'] > 0) {
									echo '<li class="list-group-item active"><h6>Comics:</h6></li>';
								}

								$comics = $marvelChars['comics']['items'];

								foreach ($comics as $comic) {
									echo '<li class="list-group-item">' . $comic['name'] . '</li>';
								}//foreach serie

								?>
							</ul>
							<!--stories-->
							<ul class="list-group list-group-flush">
								<?php
								if ($marvelChars['stories']['available'] > 0) {
									echo '<li class="list-group-item active"><h6>Stories:</h6></li>';
								}

								$stories = $marvelChars['stories']['items'];

								foreach ($stories as $storie) {
									echo '<li class="list-group-item">' . $storie['name'] . '</li>';
								}//foreach serie

								?>
							</ul>
							<!--events-->
							<ul class="list-group list-group-flush">
								<?php
								if ($marvelChars['events']['available'] > 0) {
									echo '<li class="list-group-item active"><h6>Events:</h6></li>';
								}

								$events = $marvelChars['events']['items'];

								foreach ($events as $event) {
									echo '<li class="list-group-item">' . $event['name'] . '</li>';
								}//foreach serie

								?>
							</ul>
						</div>



					<?php
					}//foreach marvel
					?>


				</div><!--row-->
			</div>
		</div>


	<?php include('content/footer.php'); ?>


</main>

<?php include('content/scripts.php'); ?>

</body>
</html>
