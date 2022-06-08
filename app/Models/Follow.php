<?php
namespace App\Models;

class Follow extends Model {

    protected $table = 'follow';

    // public function test($id) {
    //     SELECT user.id,username,name,avatar,location, COUNT(follower_id) AS 'follower' FROM user INNER JOIN follow ON user.id = follower_id WHERE username LIKE '%test%' OR name LIKE '%test%' GROUP BY follower_id
    //     UNION  DISTINCT
    //     SELECT user.id,username,name,avatar,location, 0 FROM user WHERE username LIKE '%test%' OR name LIKE '%test%'
    // }
   
    public function countFollow($follow_id){
        $follow = $this->query("SELECT COUNT(follow_id) AS count FROM follow WHERE follower_id  = ?", [$follow_id], true);
        if($follow)
            return $follow;
        else
            return $this;
    }

    public function countFollower($follower_id){
        $follower = $this->query("SELECT COUNT(follower_id) AS count FROM follow WHERE follow_id  = ?", [$follower_id], true);
        if($follower)
            return $follower;
        else
            return $this;
    }

    public function follow($follow_id, $follower_id){
        $follow = $this->query("INSERT INTO {$this->table}(follow_id, follower_id, follow_date) VALUES (?, ?,?)", [$follow_id, $follower_id, date('Y-m-d H:i:s')], true);
        if($follow)
            return $follow;
        else
            return $this;
    }

    public function unfollow($follow_id, $follower_id){
        $unfollow = $this->query("DELETE FROM {$this->table} WHERE follower_id = ? AND follow_id = ?", [$follower_id, $follow_id], true);
        if($unfollow)
            return $unfollow;
        else
            return $this;
    }

    public function getfollowers($follow_id){
        $usersFollowers = $this->query("SELECT follow_id,user.id AS 'follower_id',user.username,user.name,user.avatar FROM follow INNER JOIN user ON follower_id = user.id WHERE follow_id = ?", [$follow_id]);
        if($usersFollowers)
            return $usersFollowers;
        else
            return $this;
    }
    public function getfollowing($follower_id){
        $usersFollowing = $this->query("SELECT follower_id,user.id AS 'follow_id',user.username,user.name,user.avatar FROM follow INNER JOIN user ON follow_id = user.id WHERE follower_id = ?", [$follower_id]);
        if($usersFollowing)
            return $usersFollowing;
        else
            return $this;
    }
    


    // public function follow($user_id){
    //     $follow = $this->query("SELECT follow_id AS count FROM follow WHERE follower_id  = ?", [$user_id], true);
    //     if($follow)
    //         return $follow;
    //     else
    //         return $this;
    // }

    // public function followers($follower_id){
    //     $follower = $this->query("SELECT * FROM follow WHERE follower_id  = ?", [$follower_id], true);
    //     if($follower)
    //         return $follower;
    //     else
    //         return $this;
    // }

//  public function searchUser($search)
//     {      
//         $search = "%".$search."%";
    
//             return $this->query("SELECT name, AS 'name_genre', distributor.* ,distributor.name AS 'name_distributor'  
//             FROM movie_genre
//             INNER JOIN movie ON id_movie = movie.id 
//             INNER JOIN genre ON id_genre = genre.id 
//             INNER JOIN distributor ON id_distributor = distributor.id 
//             WHERE title LIKE '$search'
//             AND genre.name LIKE '$genre'
//             AND distributor.name LIKE '$distributeur'
//             ORDER BY id_movie ASC LIMIT $premier, $parpage;");
//     }
}