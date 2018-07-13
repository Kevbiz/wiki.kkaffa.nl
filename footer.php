</div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
<!--                <img src="--><?php //$_SERVER['DOCUMENT_ROOT'] ?><!--/assets/img/mewtwo.png" width="50" class="big-icon">-->

                <h2> Bedankt en copyrights</h2>

                <p>
                    Hier moet ik nog een keer een bedankt en copyright maken....
                </p>
            </div>
        </div>
    </div>
</footer>

<?php
if ( ! isset( $_SESSION['user_session'] ) ) {
	?>
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Login</h4>
                </div>

                <!-- Begin # DIV Form -->
                <div class="modal-body">
                    <!-- Begin # Login Form -->
                    <form class="form-horizontal" role="form" id="login-form">
                        <div id="error">
                            <!-- error will be shown here ! -->
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="user_email">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control"
                                       id="user_email" placeholder="email" name="user_email" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="password">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control"
                                       id="password" placeholder="Password" name="password" required/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-left" name="btn-login">Login</button>
                            <button id="login_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                            <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                        </div>
                    </form>
                </div>
                <!-- End # Login Form -->
            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
<?php } else { ?>
    <div class="modal fade" id="new-cat-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Voeg nieuwe categorie toe</h4>
                </div>

                <!-- Begin # DIV Form -->
                <div class="modal-body">
                    <!-- Begin # Login Form -->
                    <form method="post" id="new-cat-form">
                        <div id="error">
                            <!-- error will be shown here ! -->
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="cat_name">Naam</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       id="cat_name" placeholder="Categorie Naam" name="cat_name" required/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-left" name="btn-save-new-cat">Save</button>
                        </div>
                    </form>
                </div>
                <!-- End # Login Form -->
            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
    <div class="modal fade" id="new-sub-cat-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Voeg nieuwe Subcategorie toe</h4>
                </div>

                <!-- Begin # DIV Form -->
                <div class="modal-body">
                    <!-- Begin # Login Form -->
                    <form method="post" id="new-sub-cat-form">
                        <div id="error">
                            <!-- error will be shown here ! -->
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="Categorie">Categorie</label>
                                <select class="form-control" id="categorie" name="categorie">
				                    <?php
				                    foreach($wiki->get_categories() as $key){
					                    echo "<option value='{$key['id']}'   >{$key['naam']}</option>";
				                    }
				                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="sub_cat_name">Subcategorie Titel</label>
                                <input type="text" class="form-control" id="sub_cat_name" placeholder="Subcategorie Titel" name="sub_cat_name" required/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-left" name="btn-save-new-subcat">Save</button>
                        </div>
                    </form>
                </div>
                <!-- End # Login Form -->
            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
    <div id="call_modals"></div>

<?php } ?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/js/bootstrap.js"></script>
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/js/custom.js?time=<?php echo time(); ?>"></script>
<!-- include typeahead -->
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/js/bootstrap3-typeahead.min.js"></script>
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/js/handlebars.js"></script>
<!-- include summernote js -->
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/js/summernote.min.js"></script>
<!-- include summernote plugins -->
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/js/plugins/summernote-ext-specialchars.js?time=<?php echo time(); ?>"></script>
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/js/plugins/summernote-ext-highlight.js?time=<?php echo time(); ?>"></script>
<!-- include bootstrap notify js -->
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/js/bootstrap-notify.js?time=<?php echo time(); ?>"></script>
<!-- Include bootstrap alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
</body>
</html>

