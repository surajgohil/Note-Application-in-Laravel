<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            height: 100vh;
            width: 100%;
            background-color: #1f2020;
        }

        /* width */
        ::-webkit-scrollbar {
        width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #0e0d0dad;
        border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #000000;
        }

        /* .main-container {
            height: 100%;
        } */
        .right-section{
            overflow-y: scroll;
            height: 100vh;
        }
        #folder-list-menu .active{
            background: #ffffff40;
            color: #000000;
            border-radius: 10px;
        }
        #folder-list-menu .folder,
        #folder-list-menu .note{
            margin-top: 10px;
        }

        /* START : folder Animation for button */
        .folder > a > div {
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.1s ease;
        }
        .folder > a > div:nth-child(2) {
            transition-delay: 0.1s;
        }

        .folder:hover > a > div {
            opacity: 1;
            transform: translateX(0);
        }
        /* END : folder Animation for button */

        /* START : note Animation for button */
        .note > a > div {
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.1s ease;
        }
        .note > a > div:nth-child(2) {
            transition-delay: 0.1s;
        }

        .note:hover > a > div {
            opacity: 1;
            transform: translateX(0);
        }
        /* END : note Animation for button */
    </style>
</head>
<body>

    <input type="hidden" id="uid" value="{{ Auth::id() }}">
    <input type="hidden" id="fid" value="{{ session('folder_id') }}">

    <main class="container-fluid">
        <div class="row">
            <div class="col-3 p-0">
                @include('partials.sidebar')
            </div>
            <div class="col-9 right-section">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- BootStrap -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('script')

</body>
</html>
