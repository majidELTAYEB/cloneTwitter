<?php
namespace App\Controllers;

class NoticationsController extends Controller
{
    public function index()
    {
        $titrepage = 'Notications Page -';
        return $this->view('pages.notifications',compact('titrepage'));   
    }

}
