<?php

class Video extends CI_Controller {

	function Video()
	{
		parent::__construct();
		$this->load->model('video_model');	
	}
	
	function index()
	{
		//data to pass to head of document
		$data_head['url'] = base_url();
		$data_head['title'] = 'Video Works'; 
		$data_head['description'] = 'Thomas Collardeau film and video portfolio';
		$data_head['creator'] = 'Thomas Collardeau in Feb 2011';
		$this->load->view('template/html_head.php',  $data_head);
		//$this->load->view('template/heading.php');
		//$this->load->view('template/nav_video.php');

		//retrieve all clients in an array
		$clients = $this->video_model->getClients(); 
		foreach($clients as $client) { 
			// assign logo
			if ($client == "Fade In Films") {
				$logoPath = "img/logo/toma-black-tb.png"; 
			} else {
				$clientLC = strtolower($client);
				$logoPath = "img/logo/$clientLC.png"; 
			}
			//create associative array with name and corresponding projects
			$projectList = array( 
			   'name' => $client,
			   'projects' => $this->video_model->getProjects($client), //retrieve from mysql
			   'logo' => $logoPath
			);
			
			$arr[] = $projectList; //add to array with all clients
			$data['clients'] = $arr;  // pass to view
		
		}
		
		$this->load->view('video_view.php', $data);	
		$data_inst['instruction'] = 'Welcome to Collardeau.com<br />Enjoy the video clips!';
		$this->load->view('content_view.php', $data_inst);
		$data_footer['sayWhat'] = 'Contact &amp; Info';
		$data_footer['linkage'] = $data_head['url'] . 'info';
		$this->load->view('template/footer.php');
		
		//caching the page?
		//$this->output->cache(1440);	

	}
	
	//DISPLAYS PREVIEW OF VIDEO REQUESTED (from ajax call)
	function preview($video_ID) {
		$this->load->model('video_model'); //load db
		$video = $this->video_model->getOne($video_ID); //grab video info
		//assign variables to pass on
		$data['client'] = $video->client;
		$data['vid_title'] = $video->title;
		$data['root'] = $video->root;
		$data['credit'] = $video->credit;
		$data['details'] = $video->details;
		$data['location'] = $video->location;
		$data['cat'] = $video->cat;
		$data['url'] = base_url();
		//if it's a short film, the file names differ
		if ($data['client'] == "Fade In Films"){
			$data['vid'] = $data['url'] . "videos/teasers/directed-$video->root";
			$data['img'] = "img/screenshots/directed-$video->root.png";
		} else {
			$client = strtolower($video->client);
			$data['vid'] = $data['url'] . "videos/teasers/$client-$video->root";
			$data['img'] = "img/screenshots/$client-$video->root.png";
		}
		
		//hack for firefox, needs to reload jw player in ajax request
		$this->load->library('user_agent');
		$data['player'] = "";
		if ($this->agent->is_browser('Firefox'))
		{
		    $data['player'] = "<script src='jw-player/jwplayer.js'></script>";
		}
		
		//load this mofo
		$this->load->view('video_load.php', $data);
	}


}


