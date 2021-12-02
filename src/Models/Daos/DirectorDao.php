<?php

namespace cinema\Models\Daos;

use cinema\models\entites\Director;

class DirectorDao extends BaseDao
{
    public function findAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM director");
        $res = $stmt->execute();
        
        if ($res){
            $director = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
            {
                $director[] = $this->createObjectFromFields($row);
            }
            return $director;
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }   

    public function findByMovie($id){

        $stmt = $this->db->prepare("SELECT * FROM director, movie WHERE director.id = movie.director_id AND movie.id=$id");
        $res = $stmt->execute();
        if ($res){
            return $stmt->fetchObject(Director::class);
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }

    public function createObjectFromFields($fields)
    {
        $director = new Director ();
        $director->setId($fields['id'])->setNom($fields['last_name'])->setPrenom($fields['first_name']);

        return $director;
    }
}

?>