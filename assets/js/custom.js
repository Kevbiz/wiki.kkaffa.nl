$(document).ready(function () {

    $(".edit_cat_modal").click(function () {
        call_edit_cat_modal($(this).data('id'));
    });

    $(".edit_sub_cat_modal").click(function () {
        call_edit_sub_cat_modal($(this).data('id'));
    });

    $(".delete_cat").click(function(){
        call_confirm_delete($(this).data('id'));
    })

    $('#summernote').summernote({
        tabsize: 2,
        height: 600,
        prettifyHtml: false,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']],
            //     Add highlight plugin
            ['highlight', ['highlight']],
        ]


    });

    var array = {cat: 1};

    dropdown(array);

    $('#categorie').on('change', function () {

        var array = {cat: this.value};
        dropdown(array);

    });


    $("#article_form").validate({
        rules: {
            title: true,
        },
        messages: {
            title: "Er is geen titel ingevoerd."
        },
        submitHandler: save_new_article
    });

    $("#article_form_edit").validate({
        rules: {
            title: true,
        },
        messages: {
            title: "Er is geen titel ingevoerd"
        },
        submitHandler: save_edit_article
    })

    $("#login-form").validate({
        rules: {
            password: {
                required: true,
            },

            user_email: {
                required: true,
                email: true
            },
        },
        messages: {
            password: {
                required: "pass"
            },
            user_email: "mail"
        },
        submitHandler: submitForm
    });

    $("#new-cat-form").validate({
        rules: {
            cat_name: {
                required: true,
            },
        },
        messages: {
            cat_name: "Vul een categorie naam in."
        },
        submitHandler: save_new_categorie
    });

    $("#new-sub-cat-form").validate({
        rules: {
            sub_cat_name: {
                required: true,
            },
        },
        messages: {
            sub_cat_name: "Vul een Subcategorie in."
        },
        submitHandler: save_new_subcategorie
    });

    $('#searchfield').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "/lib/ajax/ajax_search.php",
                method: "POST",
                data: {query: query},
                dataType: "json",
                success: function (data) {
                    result($.map(data, function (item) {
                        return item;
                    }));
                }
            })
        },
        afterSelect: function (item) {
            window.location.href = '/article/' + item.id;
        }
    });


    window.setInterval(function () {
        get_notify();
    }, 1000);

    //end doc ready
});

function call_edit_cat_modal(id) {
    var array = {id: id};

    $.ajax({
        type: 'POST',
        url: "/lib/ajax/modal/edit_cat_modal.php",
        data: array,
        success: function (response) {
            $('#call_modals').html(response);
            $('#myModal').modal('show');

        }
    })
}

function call_edit_sub_cat_modal(id) {
    var array = {id: id};
    $.ajax({
        type: 'POST',
        url: "/lib/ajax/modal/edit_sub_cat_modal.php",
        data: array,
        success: function (response) {
            $('#call_modals').html(response);
            $('#myModal').modal('show');

        }
    })
}

function call_confirm_delete(id){
    var array = {id: id};
    $.confirm({
        theme: 'Bootstrap',
        title: 'Confirm!',
        content: 'Weet u zeker dat u deze categorie wilt verwijderen?',
        buttons: {
            confirm: function () {
                //ajax call with reload when deleted
                console.log('Confirm');
                $.ajax({
                    type: 'POST',
                    url: "/lib/ajax/ajax_delete_cat.php",
                    data: array,
                    success: function (response) {
                        var parse = $.parseJSON(response);
                        console.log(parse);
                        if (parse.status == "ok") {
                            save_notify('Success!', 'Categorie verwijderd', 'success');
                            location.reload();
                        } else {
                            save_notify('Error!', 'Er is een fout opgetreden bij het verwijderen van deze categorie', 'danger');

                        }
                    }
                })

            },
            cancel: function () {
                //close
            },
        }
    });
}

function dropdown(arr) {

    $.ajax({
        type: 'POST',
        url: "/lib/ajax/ajax_subcat_dropdown.php",
        data: arr,
        success: function (response) {
            var json = $.parseJSON(response);
            var dropdown = $('#subcategorie');

            dropdown.empty();

            dropdown.prop('selectedIndex', 0);

            $.each(json, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.id).text(entry.naam));
            })
        }
    });
}

function save_new_article() {
    var form_data = $("#article_form").serialize();
    $.ajax({
        type: 'POST',
        url: "/lib/ajax/save_new_article.php",
        data: form_data,
        success: function (response) {
            var parse = $.parseJSON(response);
            if (parse.status == "ok") {
                save_notify('Success!', 'Artikel is successvol aangemaakt.', 'success');
                window.location.href = "/article/" + parse.last_id;
            } else {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Er is eem veld leeg. !</div>');
                });
                $('html, body').animate({
                    scrollTop: ($('#error').first().offset().top)
                }, 500);
            }
        }
    })
}

function save_edit_article() {
    var form_data = $("#article_form_edit").serialize();
    $.ajax({
        type: 'POST',
        url: "/lib/ajax/save_edit_article.php",
        data: form_data,
        success: function (response) {
            var parse = $.parseJSON(response);
            if (parse.status == "ok") {
                save_notify('Success!', 'Artikel is successvol aangepast', 'success');
                window.location.href = "/article/" + parse.edit_id;
            } else {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Er is eem veld leeg. !</div>');
                });
                $('html, body').animate({
                    scrollTop: ($('#error').first().offset().top)
                }, 500);
            }
        }
    })
}

function save_new_categorie() {
    var data = $("#new-cat-form").serialize();
    $.ajax({
        type: 'POST',
        url: "/lib/ajax/save_new_categorie.php",
        data: data,
        success: function (response) {
            var parse = $.parseJSON(response);
            if (parse.status == "ok") {
                save_notify('Success!', 'Categorie is successvol aangemaakt.', 'success');
                window.location.href = "/";
            } else {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Er is eem veld leeg. !</div>');
                });
                $('html, body').animate({
                    scrollTop: ($('#error').first().offset().top)
                }, 500);
            }
        }

    });
}

function save_new_subcategorie() {
    var data = $("#new-sub-cat-form").serialize();
    $.ajax({
        type: 'POST',
        url: "/lib/ajax/save_new_subcategorie.php",
        data: data,
        success: function (response) {
            var parse = $.parseJSON(response);
            if (parse.status == "ok") {
                save_notify('Success!', 'Subcategorie successvol aangemaakt.', 'success');
                window.location.href = "/sub/" + parse.last_id;
            } else {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Er is eem veld leeg. !</div>');
                });
                $('html, body').animate({
                    scrollTop: ($('#error').first().offset().top)
                }, 500);
            }
        }
    })
}

function save_edit_categorie() {
    var data = $("#edit-cat-form").serialize();
    $.ajax({
        type: 'POST',
        url: "/lib/ajax/ajax_edit_categorie.php",
        data: data,
        success: function (response) {
            var parse = $.parseJSON(response);
            if (parse.status == "ok") {
                save_notify('Success!', 'Categorie successvol aangepast.', 'success');
                location.reload();
            } else {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Er is eem veld leeg. !</div>');
                });
                $('html, body').animate({
                    scrollTop: ($('#error').first().offset().top)
                }, 500);
            }
        }
    })
}

function save_edit_sub_categorie() {
    var data = $("#edit-sub-cat-form").serialize();
    $.ajax({
        type: 'POST',
        url: "/lib/ajax/ajax_edit_sub_categorie.php",
        data: data,
        success: function (response) {
            var parse = $.parseJSON(response);
            if (parse.status == "ok") {
                save_notify('Success!', 'Subcategorie successvol aangepast.', 'success');
                location.reload();
            } else {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Er is eem veld leeg. !</div>');
                });
                $('html, body').animate({
                    scrollTop: ($('#error').first().offset().top)
                }, 500);
            }
        }
    })
}

function submitForm() {
    var data = $("#login-form").serialize();
    $.ajax({
        type: 'POST',
        url: "/lib/ajax/ajax_login_process.php",
        data: data,
        beforeSend: function () {
            $("#error").fadeOut();
            $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
        },
        success: function (response) {
            if (response == "ok") {
                save_notify('Welkom!', 'U bent zojuist successvol ingelogd!', 'success');
                $("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                window.location.href = "/";
            } else {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                    $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                });
            }
        }
    });

    return false;
}


function save_notify(title, message, type) {
    var data = {title: title, message: message, type: type};

    $.ajax({
        type: 'POST',
        url: "/lib/ajax/notification/save_notification.php",
        data: data
    })
}

function get_notify() {
    $.ajax({
        url: "/lib/ajax/notification/get_notifications.php",
        success: function (response) {
            if (response != 'no notifications') {
                var parse = $.parseJSON(response);
                for (var key in parse) {
                    if (parse.hasOwnProperty(key)) {
                         $.notify({
                             // options
                             title: parse[key]["title"],
                             message: parse[key]["message"]
                        },{
                             // settings
                             type: parse[key]["msgtype"],
                             newest_on_top: true,
                             timer: 5000,
                             template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                             '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                             '<span data-notify="icon"></span> ' +
                             '<span data-notify="title"><strong>{1}</strong></span></br>' +
                             '<span data-notify="message">{2}</span>' +
                             '<div class="progress" data-notify="progressbar">' +
                             '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                             '</div>' +
                             '<a href="{3}" target="{4}" data-notify="url"></a>' +
                             '</div>'
                         });
                    }
                }

            }
        }
    })
}

