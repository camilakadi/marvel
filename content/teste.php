<?

$url = './apimarvel.json';
$data = file_get_contents($url);
$marvel = json_decode($data, true);

$results = $marvel[0]['data']['results'];


?>
<div class="boxes-marvel mt-5">
	<div class="container">
		<div class="row">


			<?php
			foreach ($results as $marvelChars) {
			?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
					<div class="card ">
						<a href="#">
							<img class="card-img-top" src="<?=$marvelChars['thumbnail']['path'] . '.' . $marvelChars['thumbnail']['extension'];?>" alt="<?=$marvelChars['name'];?>">
						</a>
						<div class="card-body">
							<h3 class="card-title"><?=$marvelChars['name'];?></h5>
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
							}

							?>
						</ul>
					</div><!-- /card -->
				</div>

			<?php
			}
			?>

		</div>
	</div>
</div>