<?php
namespace App\Models;

class Tweet extends Model {

    protected $table = 'tweet';

    public function tweetSearch($search) {
        $tweet = $this->query("SELECT content,tweet_date,user_id,username,name,avatar,location FROM tweet
        INNER JOIN user ON user_id = user.id WHERE content LIKE '%$search%' OR username LIKE '%$search%' OR name LIKE '%$search%' LIMIT 10");
        if ($tweet) {
            return $tweet;
        } else {
            return $this;
        }
    }

   
     public function sendTweetsImage($content,$path_filename_ext,$heure,$id)
    {
        $sqlQuery = $this->query("insert into tweet (tweet_date,user_id, content, media) values (?,?,?,?)", [$heure, $id, $content, $path_filename_ext], true );
       // $tweets = $DB->query($sqlQuery)->fetchAll();
        if($sqlQuery){
            return $sqlQuery;
        }
        else
            return $this;
    }
    
    public function sendTweets($content,$heure,$id)
    {
        $tweet = $this->query("insert into tweet (tweet_date,user_id, content) values (?,?,?) " , [$heure, $id, $content], true);
        //$tweets = $DB->query($sqlQuery)->fetchAll();
        if($tweet){
            return $tweet;
        }
        else
            return $this;
    }

    public function GetTweets($id)
    {
        $tweet = $this->query("SELECT * from `tweet` inner join user on tweet.user_id = user.id
        WHERE user_id = ? OR user_id IN(SELECT follow_id from `follow` WHERE follower_id = ?) order by tweet.id desc", [$id,$id]);
        
        if($tweet){
            return $tweet;
        }
        else
            return $this;
    }
}