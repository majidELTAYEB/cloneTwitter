<?php
namespace App\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Models\Hashtag;
use App\Models\Tweet;

class PageController extends Controller
{
    public function home()
    {
        if(isset($_GET['q']) && !empty($_GET['q'])){
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
        

            $titrepage = 'Accueil - ';
            $css = 'home.css';
            $js = 'SendTweet.js';
            return $this->view('pages.home',compact('titrepage','css', 'js'));
        
    }

    public function display()
    {
        return $this->simpleView('pages.display');
    }

    public function galerie()
    {
        $titrepage = 'Galerie';
        return $this->simpleView('pages.galerie',compact('titrepage'));
    }

    public function SendTweet()
    {
       $id_user = $_SESSION['user_id'];
         $heure = date("Y-m-d h:m:s");
         $contenu = $_POST['tweet'];
        if(count($_POST) === 2){
            var_dump($_POST['tweet']);
            $tweet = (new Tweet($this->getDB()))->sendTweets($contenu,$heure,$id_user);
        }
        if(count($_POST) === 1){
            var_dump($_POST);
            var_dump($_FILES);

            $target_dir = "/Users/majideltayeb/Sites/twitter/public/assets/TweetImg/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['image']['tmp_name'];
            $path_filename_ext = $target_dir . $filename . "." . $ext;
            move_uploaded_file($temp_name, $path_filename_ext);
            $tweet = (new Tweet($this->getDB()))->sendTweetsImage($contenu, $path_filename_ext, $heure,$id_user);
        }
            
        
    
    }

    public function displayTweets(){
        $id_user = $_SESSION['user_id'];
          $displayTweet = (new tweet($this->getDB()))->GetTweets($id_user);
          echo json_encode($displayTweet);
    }

    


}