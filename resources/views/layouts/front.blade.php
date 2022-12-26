<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link href="{{ asset('frontend/css/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.default.min.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"
        integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />

</head>

<body>
    @include('layouts.includes.frontnavbar')
    <div class="content">
        @yield('content')
    </div>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('frontend/js/bootstrap.js')}}"></script>

    <script src="{{ asset('frontend/js/avatar_upload.js')}}"></script>
    <script src="{{ asset('frontend/js/api_province.js')}}"></script>
    <script src="{{ asset('frontend/js/sort.js')}}"></script>
    <script src="{{ asset('frontend/js/custom.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"
        integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
    <script>
        const searchWrapper = document.querySelector(".search-input-wrapper");
        const inputBox = searchWrapper.querySelector(".search-input");
        const suggBox = searchWrapper.querySelector(".autocom-box");
        const icon = searchWrapper.querySelector(".icon");
        let linkTag = searchWrapper.querySelector(".link-search");
        let webLink;
        let suggestions;
        $.ajax({
            type: "GET",
            url: "/product-list",
            success: function (response) {
                console.log(response);
                autoComplete(response);
            }
            });
        
        function autoComplete(suggestions){
            inputBox.onkeyup = (e)=>{
            let userData = e.target.value; //user enetered data
            let emptyArray = [];
            
            if(userData){
                emptyArray = suggestions.filter((data)=>{
                    //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
                    return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
                });
                emptyArray = emptyArray.map((data)=>{
                    // passing return data inside li tag
                    return data = `<li>${data}</li>`;
                });
                searchWrapper.classList.add("active"); //show autocomplete box
                showSuggestions(emptyArray);
                let allList = suggBox.querySelectorAll("li");
                for (let i = 0; i < allList.length; i++) {
                    //adding onclick attribute in all li tag
                    allList[i].setAttribute("onclick", "select(this)");
                }
            }else{
                searchWrapper.classList.remove("active"); //hide autocomplete box
            }
        }
        }

        function select(element){
            let selectData = element.textContent;
            inputBox.value = selectData;
            searchWrapper.classList.remove("active");
        }

        function showSuggestions(list){
            let listData;
            if(!list.length){
                userValue = inputBox.value;
                listData = `<li>${userValue}</li>`;
            }else{
            listData = list.join('');
            }
            suggBox.innerHTML = listData;
        }
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if(session('status'))
    <script>
        swal({
            title: "{{session('status')}}",
            text: "",
            // icon: "success",
            button: "OK",
        });
    </script>
    @endif
    @yield('scripts')
</body>

</html>