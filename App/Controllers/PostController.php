<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Post;

class PostController extends AControllerBase
{
    const UPLOAD_DIR = "public/upload";

    public function authorize($action)
    {
        // runs action of whole controller to only logged user
        switch ($action) {
            case 'edit' :
            case 'delete' :
            // get id of post to toggle like
            $id = $this->request()->getValue("id");
            // get post from db
            $postToCheck = Post::getOne($id);

            // check if the actual logged user name is the same as of the post author
            // if yes, he can edit and delete such post
            return $postToCheck->getUser() == $this->app->getAuth()->getLoggedUserName();
            default:
                // all other action to just logged
                return $this->app->getAuth()->isLogged();
        }

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

    public function edit(){

        // get id of post to edit
        $id = $this->request()->getValue("id");
        // load from database. If there is no such post, new will be greated
        $editedPost = Post::getOne($id);

        // reuse template
        return $this->html([
            'post' => $editedPost
            ],
            "showForm"
        );
    }

    public function delete() : Response{

        // get id and post to be deleted
        $id = $this->request()->getValue("id");
        $toBeDeletedPost = Post::getOne($id);

        // if there is one found
        if ($toBeDeletedPost) {
            // first remove file of image
            FileStorage::deleteFile($toBeDeletedPost->getPicture());
            // then delete id from DB. Likes has to be set to cascade delete
            $toBeDeletedPost->delete();
        }
        // return home
        return new RedirectResponse("?");
    }

    public function add() : Response {

        // adding can create new or save chenges
        // we need to get edited post if possible otherwise we get null here
        $id = $this->request()->getValue("id");
        $editedPost = Post::getOne($id);

        // validation first
        $fileErr = "";

        // empty post for edit means creating new one and new one needs image to be uploade... validate
        if (empty($editedPost)) {
            if (isset($_FILES['picture']['name'])) {
                if (!FileStorage::checkIfIsFileImage($_FILES['picture']['name'])) {
                    $fileErr .= "Odoslaný súbor nie je obrázok.";
                }
            } else {
                $fileErr .= "Príspevok musí obsahovať obrázok.";
            }
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
            return $this->showErrorInForm($fileErr, $textErr, $editedPost);
        }

        if ($editedPost) {
            // if editing just update text of post
            $editedPost->setText($text);
            $editedPost->save();
        } else {
            // if creating new, create new model
            // if so, store it
            $picturePath = FileStorage::uploadFile($_FILES['picture'], self::UPLOAD_DIR);
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
        }
        return new RedirectResponse("?");
    }

    private function showErrorInForm($file_err = null, $text_err = null, $editedPost = null) : Response{
        // else show error
        return $this->html([
            'post' => $editedPost,
            'file_err' => $file_err,
            'text_err' => $text_err,
            'text' => $this->request()->getValue("text")
        ], "showForm");
    }

}