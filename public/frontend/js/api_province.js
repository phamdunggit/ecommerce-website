function renderData(array, select) {
    let row = ' <option disable value="">Select '+select+'</option>';
    array.forEach(element => {
        row += `<option value="${element.id}">${element.name}</option>`;
    });
    document.querySelector("#" + select).innerHTML = row;
}
$(document).ready(function () {
    $(document).on('change','#province', function (e) {
        e.preventDefault();
        var province = $('#province').val();
        var link= "/get-district/"+ province
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "GET",
            url: link,
            success: function (response) {
                console.log(response.districts);
                renderData(response.districts, "district");
            }
        });
    });
    $(document).on('change','#district', function (e) {
        e.preventDefault();
        var district = $('#district').val();
        var link= "/get-ward/"+ district;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "GET",
            url: link,
            success: function (response) {
                console.log(response.wards);
                renderData(response.wards, "ward");
            }
        });
    });
});