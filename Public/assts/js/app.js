
$(document).ready( function () {
    $('#example1').DataTable({
        scrollX: 0
    });

    /**
     *
     */
    $(".pass i").click(function () {
        ($(this).toggleClass("pass-showed").hasClass("pass-showed"))
            ? $(this).removeClass("fa-eye").addClass("fa-eye-slash").prev("input").attr("type", "text").val($(this).parent().attr("data"))
            : $(this).removeClass("fa-eye-slash").addClass("fa-eye").prev("input").attr("type", "password").val($(this).parent().data("o"));
    });

    /**
     *
     */
    $(".show-all-pass i").click(function () {
        input_pass = $(".input-pass");

        input_pass.toggleClass("pass-showed");

        if (input_pass.hasClass("pass-showed")) {

            input_pass.attr("type", "text").val($(".pass i ").parent().attr("data"));

            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            $(".pass i").removeClass("fa-eye").addClass("fa-eye-slash").addClass("pass-showed");

        }

        else {

            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            $(".pass i").removeClass("fa-eye-slash").addClass("fa-eye").removeClass("pass-showed");

            input_pass.attr("type", "password");
        }
    });


    $('#add-pass-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "ajax/passwords.php",
            data: $(this).serialize() + '&action=add-pass',
            type: "post",
            dataType:"JSON",
            success: function (result) {
                $(".err-frm-ajax-meg").html = result.msg;
                location.reload();
            },
            error: function (xhr) {
                $(".err-frm-ajax-meg").html =  xhr
            }
        })
    });

    $(".edit-account").click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "ajax/passwords.php",
            data: {action:"get-pass",id: $(this).data("id")},
            type: "post",
            dataType:"JSON",
            success: function (result) {
                var user  =result.data.user;
                $("#id").val(user.id);
                $("#url").val(user.website);
                $("#email").val(user.email);
                $("#user").val(user.username);
                $("#pass-id").val(user.password).parent().attr("data",result.data.pass).attr("data-o",user.password);
            },
        })

    });
    $('#edit-pass-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "ajax/passwords.php",
            data: $(this).serialize() + '&action=update-pass',
            type: "post",
            dataType:"JSON",
            success: function (result) {
                if (result.status === 1) {
                    if (confirm(result.msg)) location.reload();
                    this.reset();
                    $("#edit-pass-form").trigger("reset");
                    $("#new_account").modal("hide")
                }
            },
            error: function (xhr) {
                $(".err-frm-ajax-meg").css("display","block").html =  xhr
            }
        })
    });
    $('.delete').click(function (event) {
        event.preventDefault();
        if (confirm("Are Sure To Delete [" + $(this).data("url") + "]")){
            $.ajax({
                url: "ajax/passwords.php",
                data: {id: $(this).data("id"),action:"delete-pass"},
                type: "post",
                dataType:"JSON",
                success: function (result) {
                    if (result.status === 1)
                        if(confirm(result.msg)) location.reload();
                },
                error: function (xhr) {
                    $(".err-frm-ajax-meg").html =  xhr
                }
            })
        }
    });

});
