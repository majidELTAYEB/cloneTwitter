<?php

namespace App\Models;

class User extends Model {

    protected $table = 'user';

    public function UserSearch($search) {
        $user = $this->query("SELECT id,username,name,avatar,location FROM user WHERE username LIKE '%$search%' OR name LIKE '%$search%' LIMIT 10");
        if ($user) {
            return $user;
        } else {
            return $this;
        }
    }

    public function selectUser($id){
        $user = $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
        if($user instanceof User){
            return $user;
        }
        else
            return $this;
    }
    

    public function findByUsername($username){
        $user = $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
        if($user instanceof User){
            return $user;
        }
        else
            return $this;
    }

    public function findByEmail(string $email): User
    {
        $userMail = $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$email], true);
        if($userMail instanceof User){

            return $userMail;
        }
        else
            return $this;
    }
    
    public function InsertUser($username,$name,$email,$hashed_password,$birthdate)
    {      
       $req = $this->db->getPDO()->prepare("INSERT INTO {$this->table}(username,name,email, password,birthdate) 
       VALUES ( ?, ?, ?, ?, ?)");
       $req->execute([$username,$name, $email, $hashed_password,$birthdate]); 
       
       if($req)
       {
           return $this->db->getPDO()->lastInsertId();
       }
       else
       {
       
        return $this;
       }
    }

    public function userMention($user){
        $user = $this->query("SELECT id, username,name, avatar FROM user
        WHERE username =  LIKE '$user%' OR name LIKE '$user%' LIMIT 5");
        if($user)
            return $user;
        else
            return $this;
    }

}