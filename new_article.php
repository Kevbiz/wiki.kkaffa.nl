<?php
require_once 'header.php';
if(!$_SESSION['user_session']){
    header('Location: /');
}

if($_POST){
	$wiki->new_article($_POST['categorie'], $_POST['subcategorie'], $_POST['title'], $_POST['bericht']);
}
//get categoories
$cats = $wiki->get_categories();
?>
    <div class="container">
        <form method="post" id="article_form" >
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div id="error">
                        <!-- error will be shown here ! -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Artikel Titel</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Artikel Titel" name="title">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="Categorie">Categorie</label>
                        <select class="form-control" id="categorie" name="categorie">
                            <?php
                            foreach($cats as $key){
                                echo "<option value='{$key['id']}'   >{$key['naam']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="Subcategorie">Subcategorie</label>
                        <select class="form-control" id="subcategorie" name="subcategorie">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <textarea id="summernote" cols="50" rows="50" name="bericht"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <button type="submit" class="btn btn-default btn-lg btn-block" name="save-new-article">Nieuw Artikel opslaan</button>
                </div>
            </div>
        </form>
    </div>

<?php
require_once 'footer.php';
?>