<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
if ( ! $_SESSION['user_session'] ) {
	header( 'Location: /' );
}
$article = $wiki->get_article_content( $_GET['id'] );
if($_POST){
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
}

?>
<div class="container">
	<?php
	if ( ! is_array( $article ) ) {
		echo 'Dit artikel bestaat niet.';
	} else {
	?>
    <form method="post" id="article_form_edit">
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
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Artikel Titel"
                           name="title" value="<?= $article['onderwerp'] ?>">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <textarea id="summernote" cols="50" rows="50" name="bericht"><?= $article['bericht'] ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <input type="hidden" name="id" value="<?= $_GET['id']?>">
                <button type="submit" class="btn btn-default btn-lg btn-block" name="save-article">Edit Artikel
                </button>
            </div>
        </div>
		<?php
		}
		?>
    </form>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
