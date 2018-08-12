<?php

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
 error_reporting(E_ERROR | E_PARSE);
class Songs extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
        // getting all songs and amount of songs
     //   $songs = $this->model->getAllSongs();
     //   $amount_of_songs = $this->model->getAmountOfSongs();

       // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/songs/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addSong
     * This method handles what happens when you move to http://yourproject/songs/addsong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a song" form on songs/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addsong(){

	  $postdata = file_get_contents("php://input");
	  $request = json_decode($postdata);
	  $artist = $request->artist;
	  $track = $request->track;
	  $linkv = $request->linkv;
	  
        if (isset($linkv)) {
			$this->model->addSong($artist,$track,$linkv );			
			
		}else{
			
			$this->model->addSong($artist,$track,'');	
		}			
			$outp='{"state":"successful"}';
			echo $outp;	
        

		
 		
		
    }

    /**
     * ACTION: deleteSong
     * This method handles what happens when you move to http://yourproject/songs/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a song" button on songs/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $song_id Id of the to-delete song
     */
    public function deleteSong($song_id)
    {
        // if we have an id of a song that should be deleted
        if (isset($song_id)) {
            // do deleteSong() in model/model.php
            $this->model->deleteSong($song_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'songs/index');
    }

     /**
     * ACTION: editSong
     * This method handles what happens when you move to http://yourproject/songs/editsong
     * @param int $song_id Id of the to-edit song
     */
    public function editsong($song_id)
    {
        // if we have an id of a song that should be edited
		
			  $postdata = file_get_contents("php://input");
			  $request = json_decode($postdata);
			  $id = $request->id;		
        if (isset($id)) {
            // do getSong() in model/model.php
			
			

			
              $song = $this->model->getSong($id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            //require APP . 'view/_templates/header.php';
            //require APP . 'view/songs/edit.php';
            //require APP . 'view/_templates/footer.php';
			$outp='';
			$outp ='{"id":'.$song->id.',"artist":"'.$song->artist.'","track":"'.$song->track.'","link":"'.$song->link.'"}';
			echo $outp;			
        } else {
            // redirect user to songs index page (as we don't have a song_id)
			
			
            header('location: ' . URL . 'songs/index');
        }
    }
    
    /**
     * ACTION: updateSong
     * This method handles what happens when you move to http://yourproject/songs/updatesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a song" form on songs/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updatesong()
    {

		
	  $postdata = file_get_contents("php://input");
	  $request = json_decode($postdata);
	  $artist = $request->artist;
	  $track = $request->track;
	  $linkv = $request->linkv;
	  $id = $request->id;	  
        if (isset($linkv)) {
			$this->model->updateSong($artist,$track,$linkv,$id);			
			
		}else{
			
			$this->model->updateSong($artist,$track,'',$id);	
		}		
			$outp='{"state":"successful"}';
			echo $outp;			

        // where to go after song has been added
      
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        $amount_of_songs = $this->model->getAmountOfSongs();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        //echo $amount_of_songs;
		$outp ='{"records":'.$amount_of_songs.'}';
		echo $outp;
    }

	
    public function ajaxGetList()
    {
        $songs =$this->model->getAllSongs();

		$outp = "";

		
           foreach ($songs as $song) { 
			
			    if ($outp != "") {$outp .= ",";}
					$outp .= '{"id":"'  . $song->id . '",';
					$outp .= '"artist":"'   . $song->artist . '",';
					$outp .= '"link":"'   . $song->link . '",';					
					$outp .= '"track":"'. $song->track . '"}';			

             } 		
		
		$outp ='{"records":['.$outp.']}';
		echo $outp;
    }	
	
}
