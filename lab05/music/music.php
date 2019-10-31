<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
		<?php
		$song_count = 5678;
		?>
		<p>
			I love music.
			I have <?=$song_count?> total songs,
			which is over <?=(int)($song_count/10)?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
		
			<ol>
				<?php
					$news_pages = $_GET["newspages"];
					if(!isset($news_pages)){
						$news_pages = 5;
					}
					for($i=1;$i<=$news_pages;$i++){
						$month=sprintf('%02d', 12-$i);
						?>
						<li><a href="https://www.billboard.com/archive/article/2019<?=$month?>">2019-<?=$month?></a></li>
				<?php } ?>
			    <!-- <li><a href="https://www.billboard.com/archive/article/201910">2019-11</a></li>
				<li><a href="https://www.billboard.com/archive/article/201910">2019-10</a></li>
				<li><a href="https://www.billboard.com/archive/article/201909">2019-09</a></li>
				<li><a href="https://www.billboard.com/archive/article/201908">2019-08</a></li>
				<li><a href="https://www.billboard.com/archive/article/201907">2019-07</a></li> -->
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<!-- <li>Guns N' Roses</li>
				<li>Green Day</li>
				<li>Blink182</li> -->

				<!-- Ex 4 -->
				<!-- <?php 
				$artists = array("Guns N' Roses", "Green Day", "Blink182");
				$artists[] = "Queen";
				for($i=0;$i<count($artists);$i++){?>
					<li><?=$artists[$i]?></li>
				<?php } ?> -->

				<!-- Ex 5 -->
				<?php
				foreach(file("favorite.txt") as $artist){
					$artname=implode("_", explode(" ", $artist));
					?>
					<li><a href="http://en.wikipedia.org/wiki/<?=$artname?>"><?=$artist?></a></li>
				<?php } ?>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<!-- Ex 6, 7 -->
				<?php
				$mp3items=glob("lab5/musicPHP/songs/*.mp3");
				// print_r($mp3items);
				foreach($mp3items as $mp3item){
					$mp3size[$mp3item] = (int)(filesize($mp3item)/1024);
				}
				arsort($mp3size);
				foreach($mp3size as $mp3 => $size){
					?>
					<li class="mp3item">
						<a href="<?=$mp3?>" download><?=basename($mp3)?></a>
						(<?=$size?> KB)
					</li>
				<?php } ?>

				<!-- <li class="mp3item">
					<a href="lab5/musicPHP/songs/paradise-city.mp3">paradise-city.mp3</a>
				</li>
				
				<li class="mp3item">
					<a href="lab5/musicPHP/songs/basket-case.mp3">basket-case.mp3</a>
				</li>

				<li class="mp3item">
					<a href="lab5/musicPHP/songs/all-the-small-things.mp3">all-the-small-things.mp3</a>
				</li> -->

				<!-- Exercise 8: Playlists (Files) -->
				<?php
				$m3ufiles=glob("lab5/musicPHP/songs/*.m3u");
				rsort($m3ufiles);
				foreach($m3ufiles as $m3ufile){
					?>
					<li class="playlistitem"><?=basename($m3ufile)?>:
						<ul>
							<?php
							$lists= file($m3ufile);
							shuffle($lists);
							foreach($lists as $m3u){
								if($m3u[0] != '#'){
									?>
									<li><?=$m3u?></li>
								<?php } ?>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>
				<!-- <li class="playlistitem">326-13f-mix.m3u:
					<ul>
						<li>Basket Case.mp3</li>
						<li>All the Small Things.mp3</li>
						<li>Just the Way You Are.mp3</li>
						<li>Pradise City.mp3</li>
						<li>Dreams.mp3</li>
					</ul> -->
			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
