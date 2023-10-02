<?php
use App\Models\Post;
/** @var \App\Core\IAuthenticator $auth */
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
                    <div class="m-1 d-flex gap-1  justify-content-end">
                        <?php if ($auth->isLogged()) {
                            // logged user cak like any post
                            ?>
                            <a href="?c=post&a=like&id=<?php echo $post->getId() ?>" class="btn btn-primary btn-sm"><?php echo $post->getLikeCount() ?> <i class="bi bi-hand-thumbs-up"></i></a>
                            <?php if ($auth->getLoggedUserName() == $post->getUser() )
                                // only post author can his post edit or delete
                            {?>
                                <a href="?c=post&a=edit&id=<?php echo $post->getId() ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="?c=post&a=delete&id=<?php echo $post->getId() ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
                            <?php } ?>
                        <?php } else {
                            // to non logged show only dummy button with likes count
                            ?>
                            <a href="#" class="btn btn-primary btn-sm"><?php echo $post->getLikeCount() ?> <i class="bi bi-hand-thumbs-up"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php ?>
        </div>
    </div>
</div>
