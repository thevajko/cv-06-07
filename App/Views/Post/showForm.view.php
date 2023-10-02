<?php
/** @var Array $data */
/** @var Post $post */

// @ will hide notice if array data has not index post
$post = @$data['post'];

function hasError($data, $key) {
    return isset($data) && array_key_exists($key, $data) && !empty($data[$key]);
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 d-flex gap-4  flex-column">
            <h1>Pridanie nového príspevku</h1>

            <form METHOD="post" action="?c=post&a=add" enctype="multipart/form-data">

                <?php
                // if new post, then show upload file inputs
                if (!isset($post)) {
                    ?>
                    <label for="inputGroupFile02" class="form-label">Súbor obrázka</label>
                    <div class="input-group mb-3 has-validation">
    <!--                    <input type="text" class="form-control" name="picture" id="inputGroupFile02">-->
                        <input type="file" class="form-control <?php echo hasError($data, "file_err") ? "is-invalid" :"" ?>" name="picture" id="inputGroupFile02">
                        <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                        <?php if  (hasError($data, "file_err")) { ?>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php echo $data['file_err'] ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php }  else {
                    // if editing, photo is not possible to change, so shoe only uploated image instead
                    ?>

                <div>
                    <label for="inputGroupFile02" class="form-label">Obrázok postu</label>
                    <img src="<?php echo $post->getPicture() ?>" class="img-fluid">
                </div>
                <?php } ?>

                <?php
                    if (isset($post) && empty($data['text']) ){
                        // set post test for textarea
                        $data['text'] = $post->getText();
                    }
                ?>
                <label for="post-text" class="form-label">Text príspevku</label>
                <div class="input-group has-validation mb-3 ">
                    <textarea class="form-control <?php echo hasError($data, "text_err") ? "is-invalid" :"" ?>"
                              aria-label="With textarea" name="text" id="post-text"><?php echo !empty($data['text']) ? $data['text'] : null;  ?></textarea>
                    <?php if  (hasError($data, "text_err")) { ?>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php echo $data['text_err'] ?>
                        </div>
                    <?php } ?>
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