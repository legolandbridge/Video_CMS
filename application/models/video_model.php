<?php

class Video_model extends CI_Model {

    function Video_model() {
        parent::__construct();
    }
    
    //returns all rows in table
    function getAll() {
    	$q = $this->db->query('SELECT * FROM video ORDER BY video_ID DESC');
    	if($q->num_rows() > 0) {  	
    		foreach ($q->result() as $row) {
    		$data[] = $row; }
    		return $data;
		}  	
    }
 	
function getOne($video_ID) {
	  	$sql = 'SELECT * FROM video WHERE video_ID = ?';
	  	$q = $this->db->query($sql, $video_ID);
	  	if($q->num_rows() > 0) {
			$row = $q->row();
			return $row;
	  	}	  	
	}
  	
    
    //returns array of all clients
    function getClients() {
    	$q = $this->db->query('SELECT DISTINCT client FROM video ORDER BY video_ID DESC');
    	
    	if($q->num_rows() > 0) {
    		foreach ($q->result() as $row) {
    		$data[] = $row->client; }
    		return $data;
    	}  	
    }
    
    //returns all commercial projects
    function getCommercial() {
		//see proj_type table for reference
		$sql = 'SELECT * FROM video WHERE type >= ? ORDER BY video_ID DESC';
    	$q = $this->db->query($sql, 4);
    	if($q->num_rows() > 0) {
    		foreach ($q->result() as $row) {
    		$data[] = $row; }
    		return $data;
		}  	
    }
    
    //returns all films that I directed
    function getDirected() {
    	//see proj_type table for reference
    	$sql = 'SELECT * FROM video WHERE vid_type <= ? ORDER BY video_ID DESC';
    	$q = $this->db->query($sql, 3);
    	if($q->num_rows() > 0) {
    		foreach ($q->result() as $row) {
    		$data[] = $row; }
    		return $data;
    	}  	
    }
      
    //returns array with all projects for selected client
    function getProjects($client) {
    
	    $sql = 'SELECT * FROM video WHERE client = ? ORDER BY video_ID DESC';
	    $q = $this->db->query($sql, $client);
    	
    	if($q->num_rows() > 0) {
    		foreach ($q->result() as $row) {
    		if ($row->title != "Elise") { //don't want to show elise as a project
    			$data[] = $row; }
    		}
    		return $data;
    	}  	
    }

}
