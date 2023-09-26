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
                        <img src="<?php echo $post->getPicture() ?>" class="img-fluid">
                    </div>
                    <div class="m-2">
                        <?php echo $post->getText() ?>
                    </div>
                </div>
                <?php } ?>
            <?php ?>
        </div>
    </div>
</div>
