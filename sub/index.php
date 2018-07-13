<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';

$cat_name = $wiki->get_subcat_name( $_GET['id'] );

$cat_name = $cat_name['naam'];
$articles = $wiki->get_articles( $_GET['id'] );

$wiki->add_log( $user_id, "Heeft Subcategorie: #{$_GET['id']} {$cat_name} bekeken." );
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-<?= $wiki->random_color() ?>">
                <div class="panel-heading">
                    <div class="panel-title pull-left">
	                    <?= $cat_name ?>
                    </div>
	                <?php if($wiki->logged_in()){ ?>
                    <div class="panel-title pull-right">
                        <a href="javascript:;" data-id="<?php echo $_GET['id'] ?>" class="edit_sub_cat_modal">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a> | <a href="javascript:;" data-id="<?php echo $_GET['id'] ?>" class="delete_sub_cat">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>

                <ul class="list-group">
					<?php

					if ( ! is_array( $articles ) ) {
						echo '<p class="list-group-item">geen artikelen gevonden</p>';
					} else {
						foreach ( $wiki->get_articles( $_GET['id'] ) as $keyt ) { ?>
                            <a href="/article/<?= $keyt['id'] ?>" class="list-group-item"><?= $keyt['onderwerp'] ?></a>
						<?php }
					} ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
