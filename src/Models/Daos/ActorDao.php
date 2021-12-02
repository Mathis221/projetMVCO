<?php

namespace cinema\Models\Daos;

use cinema\models\entites\Actor;

class ActorDao extends BaseDao
{
    public function findAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM actor");
        $res = $stmt->execute();
        
        if ($res){
            $actor = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
            {
                $actor[] = $this->createObjectFromFields($row);
            }
            return $actor;
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }

    public function createObjectFromFields($fields)
    {
        $actor = new Actor ();
        $actor->setId($fields['id'])->setNom($fields['last_name'])->setPrenom($fields['first_name']);

        return $actor;
    }

    public function findByMovie($id){

        $stmt = $this->db->prepare("SELECT * FROM actor, movies_actors WHERE actor.id = movies_actors.actor_id AND movies_actors.movie_id=$id");
        $res = $stmt->execute();
        if ($res){            
            return $stmt->fetchAll(\PDO::FETCH_CLASS, Actor::class);            
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    } 

    public function findById($id){
        $stmt = $this->db->prepare("SELECT * FROM actor WHERE id = $id ");
        $res = $stmt->execute();
        if ($res){            
            return $stmt->fetchObject(Actor::class);            
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }   
    
}