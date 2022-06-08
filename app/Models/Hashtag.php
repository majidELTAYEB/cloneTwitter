<?php
namespace App\Models;

class Hashtag extends Model {
    protected $table = 'hashtag';

    public function hashtagSearch($search) {
        $gethashtag = $this->query("SELECT * FROM hashtag WHERE hashtag = '%$search' OR hashtag LIKE '%$search%'LIMIT 3");
        if ($gethashtag) {
            return $gethashtag;
        } else {
            return $this;
        }
    }

    public function hashtagExist($search) {
        $gethashtag = $this->query("SELECT * FROM hashtag WHERE hashtag = $search");
        if ($gethashtag) {
            return $gethashtag;
        } else {
            return $this;
        }
        
    }
}