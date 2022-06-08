<?php
namespace App\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Models\Hashtag;
use App\Models\Tweet;
use App\Models\Theme;

class SearchController extends Controller
{
    public function test(){

        $errors = [];
        $data = [];
        var_dump($_POST);
        if(!isset($_POST['user_id'])){
            $errors['user_id'] = "erreur";
        }
        $theme = (new Theme($this->getDB()))->createPreference($_POST['user_id'], $_POST['theme']);
        var_dump($theme);

        if(!empty($errors)){
            $data['success'] = false;
            $data['errors'] = $errors;
        }
        else{
            $data['success'] = true;
            $data['ss'] = "suceess";
        }
        echo json_encode($data);   
       
        
      }

    public function search()
    {
        if(isset($_GET['q']) && !empty($_GET['q'])){
           

            $search =$_GET['q'];

            if(!isset($searchBar)){
                $errors['search'] = "erreur";
            }

            $tweet = (new Tweet($this->getDB()))->tweetSearch($search);
           
            return $this->view('pages.search',compact('tweet'));
        }
        
    }

    
    public function datasearch()
    {
        $errors = [];
        $data = [];

        $searchBar =$_GET['q'];
       
        if(!isset($searchBar)){
            $errors['search'] = "erreur";
        }
        
        $hashtags = (new Hashtag($this->getDB()))->hashtagSearch($searchBar);
        $users = (new User($this->getDB()))->UserSearch($searchBar);
        
                if(!empty($errors)){
                    $data['success'] = false;
                    $data['errors'] = $errors;
                }
                else{
                    $data['success'] = true;
                    $data['users'] = $users;
                    $data['hashtags'] = $hashtags;
                }
                echo json_encode($data);    
    }
    
    
}