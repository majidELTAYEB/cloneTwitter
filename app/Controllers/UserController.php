<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use App\Models\Follow;
use App\Models\Theme;

class UserController extends Controller
{
    

    public function followers($username)
    {
        $css= 'follow.css';
        $js = 'follow.js';
        $followers = "";
        $following = "";
        $username = htmlspecialchars($username);
        $username = '@'.$username;
        $user = (new User($this->getDB()))->findByUsername($username);
        // var_dump($user);
        if(!empty($user->id)){
            $followers = (new Follow($this->getDB()))->getFollowers($user->id);
            $following = (new Follow($this->getDB()))->getFollowing($user->id);
            return $this->view('pages.followers', compact('css','js','followers','following'));
        }
        else{
            return $this->view('pages.followers', compact('css','js'));
        }

    }

    public function login()
    {
        return $this->simpleView('auth.login');
    }

    public function loginPost()
    {
        $_SESSION['errorLogin'] = '';  
           $email = htmlspecialchars($_POST['email']);
           $password = htmlspecialchars($_POST['password']);
           $user = (new User($this->getDB()))->findByEmail($email);
           $pass = hash('ripemd160', $password . 'vive le projet Tweet_academy');

            if (!empty($user->password)) {
                if (($user->password === $pass) && $user)  //hash le mot de passe
                {
                    $_SESSION['errorLogin'] = '';
                    $_SESSION['user_id'] = (int) $user->id;
                    $_SESSION['username'] = $user->username;
                    $_SESSION['name'] = $user->name;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['avatar'] = $user->avatar;
                    return header('Location: ' . BASE_NAME ); //  l'admin est connecter il sera rediriger vers la page profile
                }
                else{
                    var_dump($_SESSION);
                    $_SESSION['errorLogin'] = "La connexion a échoué, veuillez réessayer";
                }

            }
            else{
                return $this->simpleView('auth.login');
            }
        
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        return header('Location:' . BASE_NAME);
    }

    public function register()
    {
        return $this->simpleView('auth.register');
    }

    public function userProfile($username)
    {
        // var_dump($username);
        $username = htmlspecialchars($username);
        $username= '@'.$username;
        $titrepage = 'Profile / Twitter';
        $user = (new User($this->getDB()))->findByUsername($username);
        if(empty($user)){
            $titrepage = $user->name .' ('.$user->username.')'.' / Twitter';
            // var_dump($user);
        }
        $css = "profile.css";
        
        return $this->view('user.profile',compact('titrepage','css','username','user'));
    }

    public function edit()
    {
        $titrepage = 'Edit Page - ';
        $this->isAdmin();
        if (isset($_SESSION['id'])) {
            $user = (new User($this->getDB()))->selectUser($_SESSION['id']);
        }
        return $this->view('user.edit', compact('titrepage', 'user'));
    }

    public function registerPost()
    {
        $errors = [];
        $data = [];

        $name = htmlentities($_POST['Name_Lastname']);
     

        $NomPrenom = explode(' ', $name);
        $username = $NomPrenom[1] . $NomPrenom[0][0];
     

        // var_dump($replace);
        $email = htmlentities($_POST['Email']);
        

        $mois = htmlentities($_POST['mois']);
        $jour =  htmlentities($_POST['jour']);
        $annee =  htmlentities($_POST['annee']);
        $password = htmlentities($_POST['Password']);

        $birthdate = $annee . '-' . $mois . '-' . $jour;


        if (empty($name)) {
            $errors['name'] = "Veuillez entrer votre prénom";
        }
        if (empty($email)) {
            $errors['email'] = "Veuillez entrer votre email";
        }
        if (empty($password)) {
            $errors['password'] = "Veuillez entrer votre mot de passe";
        }
        if (empty($birthdate)) {
            $errors['date_of_birth'] = "Veuillez entrer votre date de naissance";
        }
        // if (strlen($password) < 8) {
        //     $errors['PasswordLenght'] = "Password not long enough! Must be at least 8 characters long";
        // }
        $selectUser = (new User($this->getDB()))->selectUser(1);
        $user = (new User($this->getDB()))->findByUsername($username);
        $userMail = (new User($this->getDB()))->findByEmail($email);
            var_dump($user, 'VARDUMP');
        if (empty($user)) {
            $errors['usernameEXist'] = "Ce nom d'utilisateur existe deja";
        }
        if (empty($userMail)) {
            $errors['emailEXist'] = "Cette adresse email est deja utilisee";
        }
        if (empty($errors)) {
            
            $hashed_password = hash('ripemd160', $password . 'vive le projet Tweet_academy');
            $user = (new User($this->getDB()))->InsertUser($username, $name, $email, $hashed_password, $birthdate);
            
            $data['success'] = true;
            $data['message'] = 'Success!';
            return header('Location: ' . BASE_NAME."login" );
            var_dump('marche');
        } 
        else 
        {
            $data['success'] = false;
            $data['errors'] = $errors;
            var_dump('rfefefe');
        }
        echo json_encode($data);
    }
    public function editPost()
    {
        $titrepage = 'Edit Page - ';
        return $this->view('user.edit', compact('titrepage'));
    }
}
