$(".btnEditUser").on("click", function() {
    $('#staticBackdrop').on('shown.bs.modal', function() {
        $('#name').trigger('focus');
    });

    const id = $(this).data("id");
    $.ajax({
        url: window.location.origin+'/editUserById',
        data: {
            id: id,
        },
        method: "post",
        dataType: "json",
        success: function (data) {
            console.log(data);
            $("#formEditUser input[type=hidden]").val(data.id);
            $("#name").val(data.name);
            $("#username").val(data.username);
            $("#role_id").val(data.role_id);
        },
    });
});