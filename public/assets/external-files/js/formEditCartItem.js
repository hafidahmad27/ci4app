$(".btnEditCartItem").on("click", function() {
    $('#staticBackdrop').on('shown.bs.modal', function() {
        $('#qty_edit').trigger('focus');
    });

    const id = $(this).data("id");
    $.ajax({
        url: window.location.origin+'/editCartItemById',
        data: {
            id: id,
        },
        method: "post",
        dataType: "json",
        success: function (data) {
            console.log(data);
            $("#formEditCartItem input[type=hidden]").val(data.id);
            $("#item_name").val(data.item_name);
            $("#qty_edit").val(data.qty);
        },
    });
});