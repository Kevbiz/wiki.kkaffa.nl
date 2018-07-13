<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';

$article = $wiki->get_article_content( $_GET['id'] );

$cat_name    = $wiki->get_cat_name( $article['cat_id'] );
$cat_name    = $cat_name['naam'];
$subcat_name = $wiki->get_subcat_name( $article['sub_id'] );
$subcat_name = $subcat_name['naam'];

?>
<div class="container">
	<?php
	if ( ! is_array( $article ) ) {
		echo 'Dit artikel bestaat niet.';
	} else {
		$wiki->add_log( $user_id, "Heeft artikel: #{$_GET['id']} {$article['onderwerp']} bekeken." );

		?>
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="#"><?= $cat_name ?></a></li>
            <li><a href="#"><?= $subcat_name ?></a></li>
            <li class="active"><?= $article['onderwerp'] ?></li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-<?= $wiki->random_color() ?>">
                    <div class="panel-heading">
                        <div class="panel-title pull-left">
							<?= $article['onderwerp'] ?>
                        </div>
                        <?php if($wiki->logged_in()){ ?>
                        <div class="panel-title pull-right">
                            <a href="/edit_article/<?= $_GET['id'] ?>">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </div>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
						<?= $article['bericht'] ?>
                    </div>
                </div>

            </div>
        </div>
		<?php
	}
	?>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
