$(document).ready(function () {
    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log(url);
        $.ajax({
            url: url,
            type: 'post',
            success: function (data) {
                console.log("sucess");
            },
        });
    });
    $('.increase-qty').on('click', function (e) {
        console.log($(this).data('href'));
        var that = this;
        $.ajax({
            url: $(this).data('href'),
            type: 'post',
            success: function (data) {
                console.log(data);
                if (data['success']) {
                    var inputId = $(that).data("input");
                    $(inputId).val(data['qty']);

                    var priceId = $(that).data("price");
                    $(priceId).text(data['price']);

                    var total_price = $("#total_price");
                    $(total_price).text(data['total_price']);
                    console.log(total_price);
                }
            },
        });
    });
    $('.decrease-qty').on('click', function (e) {
        console.log($(this).data('href'));
        var that = this;
        $.ajax({
            url: $(this).data('href'),
            type: 'post',
            success: function (data) {
                console.log(data);
                if (data['success']) {
                    var inputId = $(that).data("input");
                    $(inputId).val(data['qty']);

                    var priceId = $(that).data("price");
                    $(priceId).text(data['price']);

                    var total_price = $("#total_price");
                    $(total_price).text(data['total_price']);
                    if (data['total_price'] == 0) {
                        $(that).parent().parent().parent().parent().remove();
                        $(".money-counter").remove();
                    }
                    console.log($(total_price).text(data['total_price']));

                }
            },
        });
    });
    $('.remove-from-shoping_cart').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var data_id = $(this).data("id");
        var that = this;

        $.ajax({
            url: url,
            type: 'post',
            success: function (data) {
                if (data['success']) {
                    $(that).parent().parent().parent().parent().remove();
                    var total_price = $("#total_price");
                    $(total_price).text(data['total_price']);
                    var dom_counter = $('.card-element').length;
                    if (dom_counter == 0) {
                        $(".money-counter").remove();
                        $('.money-container').append('<h1>your cart is empty!</h1>');

                    }
                }
            },
            error: function () {
                alert('error in ajax');
            },
        });
    });

    // $('.languages').on('click', function (e) {
    //     e.preventDefault();
    //     alert("hellow");

    // });

});

