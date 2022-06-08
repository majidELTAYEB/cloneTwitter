<?php
namespace App\Models;

class Theme extends Model {

    protected $table = 'user_preference';

    public function getPreference($user_id){
        $preference = $this->query("SELECT * FROM user_preference WHERE user_id = ?", [$user_id], true);
        if($preference)
            return $preference;
        else
            return $this;
    }

    public function updatePreference($user_id, $preference){
        $update = $this->query("UPDATE user_preference SET preference = ? WHERE user_id = ?", [$preference, $user_id], true);
        if($update)
            return $update;
        else
            return $this;
    }

    public function createPreference($user_id, $theme){
        $innertable = $this->query("INSERT INTO user_preference(user_id, theme) VALUES(?,?)", [$user_id, $theme]);
        if($innertable)
            return $innertable;
        else
            return $this;
    }


}