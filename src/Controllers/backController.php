<?php

namespace cinema\controllers;


use cinema\Models\Services\GenreService;
use cinema\Models\Services\MovieService;
use cinema\Models\Services\ActorService;


class BackController
{
    private $genreService ;     

    public function __construct()
    {
        $this->genreService = new genreService();  
        $this->movieService = new movieService();     
        $this->actorService = new actorService();        
    }

    public function addGenre($genreData)
    {
    
        $this->genreService->create($genreData);
       
    } 
    public function addMovie($movieData)
    {
    
        $this->movieService->create($movieData);
       
    }    
    public function addActor($actorData)
    {

    
        $this->movieService->addActor($actorData);
       
    }        
} 
?>