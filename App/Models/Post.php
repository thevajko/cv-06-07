<?php

namespace App\Models;

use App\Core\Model;

class Post extends  Model {

    protected int $id;
    protected string $picture;
    protected string $text;
    protected string $user;

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    public function getLikeCount(){
        // get all likes of this post
        $r = Like::getAll("post_id = ?", [$this->id]);
        // count them
        return count($r);
    }

    public function likeToggle($userName) {

        // only for stored
        if (empty($this->id)) {
            throw new \Exception("Post must be stored or loaded to toggle like.");
        }

        // get all likes from this user for this post
        $likes = Like::getAll("post_id = ? AND liker like ?", [$this->id, $userName]);
        if (count($likes) > 0) {
            // remove likes if there are any
            foreach ($likes as $like) {
                $like->delete();
            }
        } else {
            // if there are not, create one
            $l =  new Like();
            $l->setPostId($this->id);
            $l->setLiker($userName);
            $l->save();
        }
    }


}