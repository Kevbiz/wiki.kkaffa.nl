<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php'; ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Categorie</h4>
            </div>
            <div class="modal-body">

				<?php

				$cat = $wiki->get_cat_name( $_POST['id'] );
				if ( $cat == 'error' ) {
					?>
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Deze categorie bestaat niet.
                    </div>
				<?php
				} else {
				?>
                    <!-- Begin # Login Form -->
                    <form class="form-horizontal" method="post" id="edit-cat-form">
                        <div id="error">
                            <!-- error will be shown here ! -->
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="sub_cat_name">Categorie Naam</label>
                                <input type="text" class="form-control" id="cat_name" value="<?= $cat['naam'] ?>"
                                       placeholder="Categorie Naam"
                                       name="cat_name" required/>
                            </div>
                        </div>

                        <input type="hidden" value="<?= $_POST['id'] ?>" name="id"/>


                        <div class="form-group">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-default" name="btn-save-edit-cat">Save</button>
                            </div>
                        </div>
                    </form>

                    <script>
                        $("#edit-cat-form").validate({
                            rules: {
                                cat_name: {
                                    required: true,
                                },
                            },
                            messages: {
                                cat_name: "Vul een Categorie in."
                            },
                            submitHandler: save_edit_categorie
                        });
                    </script>
				<?php } ?>
            </div>
        </div>
    </div>
</div>
