<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Post;

class PostController extends AControllerBase
{

    public function authorize($action)
    {
        return $this->app->getAuth()->isLogged();
    }


    public function index(): Response
    {
        // this controller does not have index, so do redirect to home page
        return new RedirectResponse("?");
    }

    public function showForm() : Response{
        // just show form
        return $this->html();
    }

    public function like(){
        // get id of post to toggle like
        $id = $this->request()->getValue("id");
        // get post from db
        $postToLike = Post::getOne($id);
        // toggle like
        $postToLike->likeToggle($this->app->getAuth()->getLoggedUserName());
        // redirect to home
        return new RedirectResponse("?");
    }

    public function add(): Response {

        // validation first
        $fileErr = "";
        if (isset($_FILES['picture']['name'])) {
            if (!FileStorage::checkIfIsFileImage($_FILES['picture']['name'])) {
                $fileErr .= "Odoslaný súbor nie je obrázok.";
            }
        } else {
            $fileErr .= "Príspevok musí obsahovať obrázok.";
        }

        $textErr = "";
        $text = @trim($this->request()->getValue("text"));
        if (empty($text)) {
            $textErr .= "Príspevok musí mať zadaný text.";
        }else {
            if (strlen($text) < 3) {
                $textErr .= "Príspevok musí byť dlhší ako 2 znaky.";
            }
        }

        if (!empty($fileErr) || !empty($textErr) ) {
            return $this->showErrorInForm($fileErr, $textErr);
        }

        // if so, store it
        $picturePath = FileStorage::uploadFile($_FILES['picture'], "public/upload");
        if (empty($picturePath)) {
            return $this->showErrorInForm("Súbor sa nepodarilo uploadnuť, skúste odoslať formulár opäť.");
        }

        // create new model instance
        $newPost = new Post();
        // fill sent data to new model
        $newPost->setPicture($picturePath);
        $newPost->setText($text);
        $newPost->setUser($this->app->getAuth()->getLoggedUserName());
        // store in DB => run the insert
        $newPost->save();
        // after successful save, redirect to home page
        return new RedirectResponse("?");
    }

    private function showErrorInForm($file_err = null, $text_err = null) : Response{
        // else show error
        return $this->html([
            'file_err' => $file_err,
            'text_err' => $text_err,
            'text' => $this->request()->getValue("text")
        ], "showForm");
    }

}