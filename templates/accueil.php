<?php

//C'est la propriété php_self qui nous l'indique : 
// Quand on vient de index : 
// [PHP_SELF] => /chatISIG/index.php 
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}
?>

<main>
	<div id="nav">
		<div class="container">
			<ul class="right">		
				<li><a href="#">Facile</a></li>
				<li><a href="#">Moyen</a></li>
				<li><a href="#">Difficile</a></li>
				<li><a href="#">Scores</a></li>
				<li><a href="#">Langue</a></li>
				<li><a href="#">Règles </a></li>
			</ul>
		</div>
	</div>

	<div id="banner">
		<div class="swiper-container">
	        <div class="swiper-wrapper">
	            <div class="swiper-slide">
	            	<img src="images/banner1.jpg" width="90%;" height="90%">
	            </div>
	            <div class="swiper-slide">
	            	<img src="images/banner2.png" width="90%;" height="90%">
	            </div>
	            <div class="swiper-slide">
	            	<img src="images/banner3.jpg" width="90%;" height="90%">
	            </div>
	            <div class="swiper-slide">
	            	<img src="images/banner4.jpg" width="90%;" height="90%">
	            </div>
	        </div>
	        <!-- Add Pagination -->
	        <div class="swiper-pagination"></div>
	        <div class="swiper-button-next"></div>
	        <div class="swiper-button-prev"></div>
	    </div>
	    <div class="banner-nav-bg"></div>
	</div>

	<!-- 页面的开始游戏部分 -->
	<div id="star">
		<div class="container">
			<div class="star_top">
				<img src="images/start.png">
			</div>
			<ul>
				<li>
					<div>
						<img src="images/images（3）.jpg">
					</div>
					<h2>Facile</h2>
					<p>VITESSE LENT & 3 TROUS</p>
					<p class="money">Entrée  <span></span></p>
				</li>
				<li class="line"></li>
				<li>
					<div>
						<img src="images/images（4）.jpg">
					</div>
					<h2>Moyen</h2>
					<p>VITESSE NORMAL & 4 TROUS</p>
					<p class="money">Entrée  <span></span></p>
				</li>
				<li class="line"></li>
				<li>
					<div>
						<img src="images/images（5）.jpg">
					</div>
					<h2>Difficile</h2>
					<p>VITESSE RAPIDE & 5 TROUS</p>
					<p class="money">Entrée  <span></span></p>
				</li>
				<li class="line"></li>
				<li>
					<div>
						<img src="images/VS.jpg">
					</div>
					<h2>Salle de jeux</h2>
					<p>Invitez des amis</p>
					<p class="money">Entrée  <span></span></p>
				</li>
			</ul>
		</div>
	</div>
	<!-- 页面的精选商品部分 -->
	<div id="accessory">
		<div class="container">
			<div class="acc_top">
				<img src="images/images.jpg">
			</div>
			<div class="acc_main">
				<div class="acc_left left">
					<div>
						<img src="images/13.png">
					</div>
					<div class="acc_all">
						<p>Amazon Prime</p>
						<ul>
							<li>Logica Jeux </li>
							<li>Tobar </li>
							<li>TOOGOO </li>
							<li>Aquamarine </li>
							<li>Awalé Jeu </li>
							<li>Toys Pure </li>
						</ul>
						<h2 class="line"></h2>
						<p class="acc">Amazon.fr<span></span></p>
					</div>
					<div>
						<img src="images/16.png">
					</div>
					<div>
						<img src="images/12.jpg">
					</div>
				</div>
				<div class="acc_right right">
					<div>
						<img src="images/14.jpg">
					</div>
					<div>
						<img src="images/15.png">
					</div>
					<div>
						<img src="images/17.jpg">
					</div>
					<div>
						<img src="images/18.jpg">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 页面的学习空间部分 -->
	<div id="world">
		<div class="container">
			<div class="world_top">
				<img src="images/images.jpg">
			</div>
			<div class="world_main">
				<div class="world_left left">
					<div  class="a1 fade">
						<div>
							<img src="images/apprendre.jpg">
						</div>
						<h2>Apprendre</h2>
					</div>
					<div  class="a2 fade">
						<div>
							<img src="images/exercices.jpg">
						</div>
						<h2>Exercices</h2>
					</div>
					<div class="a3 fade">
						<div>
							<img src="images/conseils.png">
						</div>
						<h2>Conseils</h2>
					</div>
					<div class="a4 fade">
						<div>
							<img src="images/brainstorming.jpg">
						</div>
						<h2>Brainstorming</h2>
					</div>
				</div>
				<div class="world_right right">
					<div class="world_title">
						<div class="news">Forum</div>
						<div class="weibo">Annonce</div>
					</div>
					<ul>
						<li>
							<dl>
								<dt>
									<img src="images/competition.jpg">
								</dt>
								<a href="#">Tournois Awalé</a>
								
							</dl>
						</li>
						<li>
							<dl>
								<dt>
									<img src="images/news.jpg">
								</dt>
								<a href="#">Sujets les plus récents</a>
								
							</dl>
						</li>
						<li>
							<dl>
								<dt>
									<img src="images/gamify.png">
								</dt>
								<a href="#">Sujet d’actualité</a>						
							</dl>
						</li>
						<li>
							<dl>
								<dt>
									<img src="images/winner.png">
								</dt>
								<a href="#">Trophées</a>
							</dl>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</main>