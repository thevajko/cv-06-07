<?php
use App\Models\Post;

/** @var Post[] $posts */
/** @var Array $data */

$posts = $data;

?><div class="container">
    <div class="row justify-content-center">
        <div class="col-3 d-flex gap-4  flex-column">
            <?php foreach ($posts as $post) { ?>
                <div class="border post d-flex flex-column">
                    <div>
                        <?php echo $post->getUser() ?>
                    </div>
                    <div>
                        <img src="<?php echo $post->getPicture() ?>" class="img-fluid">
                    </div>
                    <div class="m-2">
                        <?php echo $post->getText() ?>
                    </div>
                    <div class="m-1 d-flex  justify-content-end">
                        <a href="?c=post&a=like&id=<?php echo $post->getId() ?>" class="btn btn-primary btn-sm"><?php echo $post->getLikeCount() ?> <i class="bi bi-hand-thumbs-up"></i></a>
                    </div>
                </div>
                <?php } ?>
            <?php ?>
        </div>
    </div>
</div>
