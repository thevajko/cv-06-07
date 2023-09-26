<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 d-flex gap-4  flex-column">
            <h1>Pridanie nového príspevku</h1>
            <form METHOD="post" action="?c=post&a=add" enctype="multipart/form-data">
                <label for="inputGroupFile02" class="form-label">Súbor obrázka</label>
                <div class="input-group mb-3 has-validation">
                    <!--                    <input type="text" class="form-control" name="picture" id="inputGroupFile02">-->
                    <input type="file" class="form-control " name="picture" id="inputGroupFile02">
                    <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                </div>
                <label for="post-text" class="form-label">Text príspevku</label>
                <div class="input-group has-validation mb-3 ">
                    <textarea class="form-control" aria-label="With textarea" name="text" id="post-text"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Pridať</button>
            </form>
        </div>
    </div>
</div>