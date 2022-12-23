$(document).on("click", ".sorting", function (event) {
    event.preventDefault();
    var name = $(this).data("name");
    if (name == "price_asc") {
        $(".sorting").removeClass("btn-primary");
        $(".sorting").removeClass("btn-outline-primary");
        $(".sorting").addClass("btn-outline-primary");
        $("#price ").removeClass("btn-outline-primary");
        $("#price ").addClass("btn-primary");
        $("#price ").empty();
        $("#price ").append("Thấp đến cao")
    } else if(name == "price_desc") {
        $(".sorting").removeClass("btn-primary");
        $(".sorting").removeClass("btn-outline-primary");
        $(".sorting").addClass("btn-outline-primary");
        $("#price ").removeClass("btn-outline-primary");
        $("#price ").addClass("btn-primary");
        $("#price ").empty();
        $("#price ").append("Cao đến thấp")
    }else{
        $(".sorting").removeClass("btn-primary");
        $(".sorting").removeClass("btn-outline-primary");
        $(".sorting").addClass("btn-outline-primary");
        $("#price ").removeClass("btn-primary");
        $("#price ").addClass("btn-outline-primary");
        $("#price ").empty();
        $("#price ").append("Giá")
        $(this).removeClass("btn-outline-primary");
        $(this).addClass("btn-primary");
    }
    console.log(name);
});
