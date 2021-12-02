<?php

namespace cinema\Models\Services;

use cinema\Models\Daos\MovieDao;
use cinema\Models\Daos\DirectorDao;
use cinema\Models\Daos\ActorDao;
use cinema\Models\Daos\GenreDao;

class MovieService

{
    private $movieDao;
    private $actorDao;
    private $directorDao;
    private $genreDao;


    public function __construct()
    {
    $this->movieDao  = new MovieDao();
    $this->genreDao = new GenreDao();
    $this->directorDao = new DirectorDao();
    $this->actorDao = new ActorDao();
    }

    public function getAllMovies()
    {
        var_dump($this->movieDao);
        $movies = $this->movieDao->findAll();
        return $movies;
    }

    public function getById($id)
    {
        $movie = $this->movieDao->findById($id);                  
        $actors = $this->actorDao->findByMovie($id);
        // montreMoi($movie);
        // montreMoi($actors);

        foreach ($actors as $actor)
        {
            $movie->addActor($actor);
        }

        $director = $this->directorDao->findByMovie($id);


        $movie->setDirector($director);

        $genre = $this->genreDao->findByMovie($id);
    

        $movie->setGenre($genre);



        return $movie;   
        
    }

    public function create($movieData)
    {
        $movie = $this->movieDao->createObjectFromFields($movieData);
        
        $this->movieDao->insert($movie);

    }

//     public function addActor($movieData){
    
//         $movie = $this->movieDao->createObjectFromFields2($movieData);
        
//         $this->movieDao->add($movie);
//     }

public function addActor($actorData)
    {            
        // m($actorData);
        $movie= $this->movieDao->findById($actorData['id']);
        $actors=$this->actorDao->findById($actorData['actor_id']);
       
        $this->movieDao->insertActor($movie,$actors);

    }

 }
    


?>