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

    public function index(): Response
    {
        // this controller does not have index, so do redirect to home page
        return new RedirectResponse("?");
    }

    public function showForm() : Response{
        // just show form
        return $this->html();
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

        if (!empty($fileErr) || !empty($textErr) ) {
            return $this->showErrorInForm($fileErr, $editedPost);
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
            // store in DB => run the insert
            $newPost->save();
            // after successful save, redirect to home page
        }
        return new RedirectResponse("?");
    }

    private function showErrorInForm($text_err = null, $editedPost = null) : Response{
        // else show error
        return $this->html([
            'post' => $editedPost,
            'text_err' => $text_err,
        ], "showForm");
    }

}