<header>
	<h1><?=$client?></h1>
	<h5><?=$cat?></h5>
</header>

<p class="details">
	<b><?=$vid_title?></b><br />
	<?=$details?><br />
	in <?=$location?><br />
</p>

<div id='mediaplayer'></div>

<?=$player?> <!-- script tag if browser is firefox, empty string otherwise -->

<script>
  jwplayer('mediaplayer').setup({
    'id': 'playerID',
    'width': '640',
    'height': '360',
    'file': '<?=$vid?>.mov',
    'image': '<?=$img?>',
    'players': [
        {type: 'html5'},
        {type: 'flash', src: '<?=$url?>jw-player/player.swf'}
    ]
  });
 
  
</script>	

<p id="emailme">Email me at <a href="mailto:hello@collardeau.com?subject=<?=$client?> - <?=$vid_title?>">hello@collardeau.com</a> for link to see full video.</p>



