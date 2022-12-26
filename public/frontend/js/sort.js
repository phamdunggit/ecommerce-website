$(document).ready(function () {
    var url, category, sort_by, sort_type, query, page;
        var currenturl = window.location.href;
        
        if (currenturl.search("category") != "-1") {
            category = currenturl.slice(31);
            url = "/cate/fetch_data?";
        } else if (currenturl.search("search-product") != "-1") {
            category = "";
            url = "/search-product/fetch_data?";
        }
    function fetch_data(page, sort_type, sort_by, query, category) {
        $.ajax({
            url:
                url +
                "page=" +
                page +
                "&sortby=" +
                sort_by +
                "&sorttype=" +
                sort_type +
                "&query=" +
                query+"&category="+category,
            success: function (data) {
                console.log(sort_by);
                $(".data").html("");
                $(".data").html(data);
                $(".price").digits();
            },
        });
    }
    $(document).on("click", ".sorting", function (event) {
        event.preventDefault();
        // console.log($("#hidden_search_input").val());
        var name = $(this).data("name");
        if (name == "price_asc") {
            $(".sorting").removeClass("btn-primary");
            $(".sorting").removeClass("btn-outline-primary");
            $(".sorting").addClass("btn-outline-primary");
            $("#price ").removeClass("btn-outline-primary");
            $("#price ").addClass("btn-primary");
            $("#price ").empty();
            $("#price ").append("Thấp đến cao");
            query = $("#hidden_search_input").val();
            sort_by = "selling_price";
            $("#hidden_sort_by").val(sort_by);
            sort_type = "asc";
            $("#hidden_sort_type").val(sort_type);
            page = $("#hidden_page").val();
        } else if (name == "price_desc") {
            $(".sorting").removeClass("btn-primary");
            $(".sorting").removeClass("btn-outline-primary");
            $(".sorting").addClass("btn-outline-primary");
            $("#price ").removeClass("btn-outline-primary");
            $("#price ").addClass("btn-primary");
            $("#price ").empty();
            $("#price ").append("Cao đến thấp");
            query = $("#hidden_search_input").val();
            sort_by = "selling_price";
            $("#hidden_sort_by").val(sort_by);
            sort_type = "desc";
            $("#hidden_sort_type").val(sort_type);
            page = $("#hidden_page").val();
        } else if (name == "new") {
            $(".sorting").removeClass("btn-primary");
            $(".sorting").removeClass("btn-outline-primary");
            $(".sorting").addClass("btn-outline-primary");
            $("#price ").removeClass("btn-primary");
            $("#price ").addClass("btn-outline-primary");
            $("#price ").empty();
            $("#price ").append("Giá");
            $(this).removeClass("btn-outline-primary");
            $(this).addClass("btn-primary");
            query = $("#hidden_search_input").val();
            sort_by = "created_at";
            $("#hidden_sort_by").val(sort_by);
            sort_type = "desc";
            $("#hidden_sort_type").val(sort_type);
            page = $("#hidden_page").val();
        } else if (name == "best_sell") {
            $(".sorting").removeClass("btn-primary");
            $(".sorting").removeClass("btn-outline-primary");
            $(".sorting").addClass("btn-outline-primary");
            $("#price ").removeClass("btn-primary");
            $("#price ").addClass("btn-outline-primary");
            $("#price ").empty();
            $("#price ").append("Giá");
            $(this).removeClass("btn-outline-primary");
            $(this).addClass("btn-primary");
            query = $("#hidden_search_input").val();
            sort_by = "sold";
            $("#hidden_sort_by").val(sort_by);
            sort_type = "desc";
            $("#hidden_sort_type").val(sort_type);
            page = $("#hidden_page").val();
        }
        fetch_data(page, sort_type, sort_by, query, category);
    });
    $(document).on("click", ".pagination a", function (event) {
        event.preventDefault();
        query = $("#hidden_search_input").val();
        sort_by = $("#hidden_sort_by").val();
        sort_type = $("#hidden_sort_type").val();
        var page = $(this).attr("href").split("page=")[1];
        console.log(page);
        $("#hidden_page").val(page);
        var query = $("#hidden_search_input").val();
        $("li").removeClass("active");
        $(this).parent().addClass("active");
        fetch_data(page, sort_type, sort_by, query, category);  
    });
    
});
