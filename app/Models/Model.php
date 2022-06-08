<?php

namespace App\Models;
use Database\DBConnection;
use PDO;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        return $this->query("SELECT * FROM {$this->table}");
    }

    public function findById(int $id): Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function create(array $data, ?array $relations = null)
    {
        $donnees = "";
        $valuedonnees = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $fin = $i === count($data) ? "" : ', ';
            $donnees .= "{$key}{$fin}";
            $valuedonnees .= ":{$key}{$fin}";
            $i++;
        }

        return $this->query("INSERT INTO {$this->table} ($donnees) VALUES($valuedonnees)", $data);
       
    }

    public function updates(int $id, array $data, ?array $relations = null)
    {
        $sqlReq = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $fin = $i === count($data) ? "" : ', ';
            $sqlReq .= "{$key} = :{$key}{$fin}";
            $i++;
        }

        $data['id'] = $id;
        
        return $this->query("UPDATE {$this->table} SET {$sqlReq} WHERE id = '' ", $data);
    }

    public function delete(int $id): bool
    {
        
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
       
    }

    public function deletes()
    {
        return $this->query("DELETE FROM {$this->table} LIMIT 1");
       
    }
      
    public function query(string $sql, array $option = null, bool $single = null ){
        
        $method = is_null($option) ? 'query' : 'prepare';
       

        if (
            strpos($sql, 'DELETE') === 0
            || strpos($sql, 'UPDATE') === 0
            || strpos($sql, 'INSERT') === 0) {

            $req = $this->db->getPDO()->$method($sql);
            $req->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            return $req->execute($option);
        }

        $fet = is_null($single) ? 'fetchAll' : 'fetch';

        $req = $this->db->getPDO()->$method($sql);
        $req->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        
        if ($method === 'query'){
            return $req->$fet();
        } else{
            $req->execute($option);
            return $req->$fet();
        }
    }
}