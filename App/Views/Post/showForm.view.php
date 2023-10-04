<?php
/** @var Array $data */
/** @var Post $post */

// @ will hide notice if array data has not index post
use App\Models\Post;

$post = @$data['post'];

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 d-flex gap-4  flex-column">
            <h1>Pridanie nového príspevku</h1>

            <?php if (isset($data['text_err'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $data['text_err'] ?>
            </div>
            <?php } ?>
            <form METHOD="post" action="?c=post&a=add" enctype="multipart/form-data">

                <?php
                // if new post, then show upload file inputs
                if (!isset($post)) {
                    ?>
                    <label for="inputGroupFile02" class="form-label">Súbor obrázka</label>
                    <div class="input-group mb-3 has-validation">
                        <input type="file" class="form-control" name="picture" id="inputGroupFile02">
                        <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                    </div>
                <?php }  else {
                    // if editing, photo is not possible to change, so shoe only uploated image instead
                    ?>
                <div>
                    <label for="inputGroupFile02" class="form-label">Obrázok postu</label>
                    <img src="<?php echo $post->getPicture() ?>" class="img-fluid">
                </div>
                <?php } ?>

                <label for="post-text" class="form-label">Text príspevku</label>
                <div class="input-group has-validation mb-3 ">
                    <textarea class="form-control" aria-label="With textarea" name="text" id="post-text"><?php isset($post) ? $post->getText() : "" ?></textarea>
                </div>

                <div class="d-flex gap-1">
                    <?php if (isset($post)) {
                        // hiddent input is needed to preserve edited post id - no need to put it into <form> action attrib
                        // and show back button
                        ?>
                        <input type="hidden" name="id" value="<?php echo $post->getId() ?>">
                        <a href="?" class="btn btn-warning">Späť</a>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary">Pridať</button>
                </div>
            </form>
        </div>
    </div>
</div>