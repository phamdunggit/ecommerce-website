$(document).ready(function () {
    var url;
    var currenturl = window.location.href;
    if (currenturl.search("categories") != "-1") {
        url = "/categories/fetch_data?";
    } else if (currenturl.search("products") != "-1") {
        url = "/products/fetch_data?";
    } else if (currenturl.search("orders") != "-1") {
        url = "/orders/fetch_data?";
    } else if (currenturl.search("users") != "-1") {
        url = "/users/fetch_data?";
    }

    function fetch_data(page, sort_type, sort_by, query) {
        $.ajax({
            url:
                url +
                "page=" +
                page +
                "&sortby=" +
                sort_by +
                "&sorttype=" +
                sort_type+"&query="+query,
            success: function (data) {
                console.log(sort_by);
                $(".table").html("");
                $(".table").html(data);
            },
        });
    }

    // $(document).on('click', '.search', function(){
    //  var query = $('.search').val();
    //  var column_name = $('#hidden_column_name').val();
    //  var sort_type = $('#hidden_sort_type').val();
    //  var page = $('#hidden_page').val();
    //  fetch_data(page, sort_type, column_name, query);
    // });

    $(document).on("click", ".sorting", function () {
        console.log($("#hidden_sort_type").val());
        var column_name = $(this).data("column_name");
        var order_type = $("#hidden_sort_type").val();
        var reverse_order = "";
        if (order_type == "asc") {
            $(this).data("sorting_type", "desc");
            reverse_order = "desc";
        } else if (order_type == "desc") {
            $(this).data("sorting_type", "asc");
            reverse_order = "asc";
        }
        $("#hidden_column_name").val(column_name);
        $("#hidden_sort_type").val(reverse_order);
        var page = $("#hidden_page").val();
        var query = $("#hidden_search_input").val();
        fetch_data(page, reverse_order, column_name, query);
    });

    $(document).on("click", ".pagination a", function (event) {
        event.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        console.log(page)
        $('#hidden_page').val(page);
        var column_name = $("#hidden_column_name").val();
        var sort_type = $("#hidden_sort_type").val();
        var query = $("#hidden_search_input").val();

        $("li").removeClass("active");
        $(this).parent().addClass("active");
        fetch_data(page, sort_type, column_name, query);
    });
});
