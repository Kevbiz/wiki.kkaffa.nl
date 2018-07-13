<?php
require_once 'header.php';
?>
    <div class="container">
<?php
if ( ! is_array( $wiki->get_categories() ) ) {
	echo 'Geen categorien gemaakt.';
} else {

	foreach ( $wiki->get_categories() as $key ) { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-<?= $wiki->random_color() ?>">
                    <div class="panel-heading">
                        <div class="panel-title pull-left">
	                        <?= $key['naam'] ?>
                        </div>
                        <?php if($wiki->logged_in()){ ?>
                        <div class="panel-title pull-right">
<!--                            <a href="javascript:;" data-id="7777" class="testdataid">-->
                            <a href="javascript:;" data-id="<?php echo $key['id'] ?>" class="edit_cat_modal">
                                <span class="glyphicon glyphicon-edit"></span>
                            |</a> <a href="javascript:;" data-id="<?php echo $key['id'] ?>" class="delete_cat">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </div>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>

					<?php
					if ( ! is_array( $wiki->get_subcategories( $key['id'] ) ) ) {
						echo '<p class="list-group-item">Geen Subcategorien gevonden voor deze categorie</p>';
					} else { ?>
                        <ul class="list-group">
							<?php foreach ( $wiki->get_subcategories( $key['id'] ) as $keyt ) { ?>
                                <a href="/sub/<?= $keyt['id'] ?>" class="list-group-item"><?= $keyt['naam'] ?></a>
							<?php } ?>
                        </ul>
						<?php
					}
					?>
                </div>
            </div>
        </div>
		<?php
	}

}
?>


<?php
require_once 'footer.php';
?>