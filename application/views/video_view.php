<section id="video">

	<a id="loginButton" href='login'>Log In</a>
	
	<hgroup>
		
		<h3>Film &amp; Video</h3>

	</hgroup>
	
	<p>Click on a project to view the sample video:</p>
	<!--loop through clients-->
	<?php foreach($clients as $client): ?>	
	
		<article class="client">
		
			<img src="<?=base_url()?><?=$client['logo']?>" />
		
			<h1><?=$client['name']?></h1>
		
			<ul>
				<!--loop through projects-->			
				<?php foreach($client['projects'] as $project): ?>
					
					<li id="<?=$project->video_ID?>" class="editItem"><a href="#" onclick="return false;"><?=$project->title?></a></li>
				
				<?php endforeach; ?>
				
			</ul>
		
		</article>
		
	<?php endforeach; ?>

</section>	




