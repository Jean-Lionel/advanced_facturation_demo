<!doctype html>
<html lang="en">
<head>
    <title>{{ auth()->user()->company()->tp_name ?? "" }}</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('css/css/all.css')  }}" defer="defer">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
    @livewireStyles
    <style>
        body{
            font-family: Arial, Helvetica,"Times New Roman", sans-serif;
        }
        #sidebar{
            /*background: #009a41;*/
            background: #5c3fd8;
        }

        .status {
            position: fixed;
            bottom: 0;
            right: 0;

            border-radius: 6px;

            background-color: rgb(33, 34, 35);
        }

        .active {
            background-color: rgb(48, 249, 75);
            padding: 6px;
        }

        @page {
            size: A4;
            margin: 0;
        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 2cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }

        @media print{
            .noprint{
                display: none !important;
            }
            html, body {
                width: 210mm;
                height: 297mm;
            }
        }
    </style>

</head>
<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active noprint" >
            <h1><a href="" class="logo">
                <img src="{{ asset('img/logo.jpg') }}" class="img-thumbnail"  alt="">
            </a></h1>
            <ul class="list-unstyled components mb-5">

                @can('is-vente')

                <li>
                    <a href="{{ route('ventes.index') }}">
                        <span class="fa fa-shopping-cart"></span> Vente</a>
                    </li>
                    <li>
                        <a href="{{ route('clients.index') }}"><span class="fa fa-users"></span> Client</a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('services.index') }}"><span class="fa fa-cubes"></span> Service</a>
                    </li> --}}
                    @endcan
                    @can('is-admin')
                    <li>
                        <a href="{{ route('products.index') }}"><span class="fa fa-sticky-note"></span> Stock</a>
                    </li>

                    <li>
                        <a href="{{ route('rapport') }}"><span class="fa fa-chart-bar"></span> Rapport</a>
                    </li>
                    <li>
                        <a href="{{ route('stockes.journal') }}"><span class="fa fa-calendar"></span> Journal</a>
                    </li>


                    <li>
                        <a href="{{ route('depenses.index') }}"><span class="fa fa-minus"></span> Depense</a>
                    </li>
                    <li>
                        <a href="{{ route('entreprises.index') }}">
                            <span class="fa fa-building"></span> Entreprise</a>
                        </li>

                        <li>
                            <a href="{{ route('users.index') }}"><span class="fa fa-user"></span> Utilisateur</a>
                        </li>
                        <li></li>
                        {{--  <li>
                            <a href="{{ route('register') }}"><span class="fa fa-paper-plane"></span> Utilisateur</a>
                        </li> --}}
                    </ul>
                    <div id="status" class="status"></div>
                    @endcan

                    <div class="footer">

                    </div>
                </nav>

                <!-- Page Content  -->
                <div id="content" class="p-0 p-md-6">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-0">
                        <div class="container-fluid">

                            {{-- <button type="button" id="sidebarCollapse" class="btn btn-primary">
                                <i class="fa fa-bars"></i>
                                <span class="sr-only">Toggle Menu</span>
                            </button> --}}
                            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-bars"></i>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <h5>{{ auth()->user()->company()->tp_name ?? "" }}</h5>


                                <ul class="nav navbar-nav ml-auto">
                                    <li>

                                        <img src="{{ asset('img/logo.jpg') }}" class="img-thumbnail"  alt="" style="width:40px; border-radius: 50%;">

                                    </li>
                                    <li>
                                        <h5 class="mr-4 mt-2 d-flex">
                                            <span>{{ Auth::user()->name }}</span>

                                        </li>

                                        <li class="nav-item">

                                            <a href="{{ route('panier.index') }}" class="btn btn-primary">

                                                <i class="fa fa-shopping-cart text-lg-center"></i> <span class="badge badge-light">{{ Cart::count()}}</span>

                                            </a>
                                        </li>
                                        <li class="nav-item ml-2">

                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-dark btn-sm rounded-bottom">

                                                    <i class="fa fa-power-off fa-2x" aria-hidden="true" title=" Se deconnecter"></i>


                                                </form>

                                            </li>

                                            {{--  <li class="nav-item">
                                                <a class="nav-link" href="{{ route('stockes.index') }}">Stocke</a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </nav>

                            <div class="container-fluid">

                                <div>
                                    @if (session('success'))
                                    {{-- expr --}}

                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>SUCCESS</strong> {{ session('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif


                                    @if (session('error'))
                                    {{-- expr --}}

                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>SUCCESS</strong> {{ session('error')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>

                                @yield('content')
                            </div>



                        </div>
                    </div>
                    <script src="{{ asset('js/jquery-3.5.min.js') }}"></script>
                    <script src="{{ asset('js/popper.js') }}"></script>
                    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
                    <script src="{{ asset('js/chart.js.2.9.4_Chart.min.js') }}"></script>
                    <script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>
                    <script src="{{ asset('datatable/datatables.min.js') }}"></script>
                    <script src="{{ asset('datatable/pdfmake.min.js') }}"></script>
                    <script src="{{ asset('js/main.js') }}"></script>

                    @livewireScripts

                    @yield('javascript')

                    <script>

                        const canSyncronize = @json( CAN_SYNCRONISE );
                        const timeSyncronisation = @json( TIME_OUT_SYNCRONISATION );

                        const checkOnlineStatus = async () => {
                            try {
                                const online = await fetch("https://jsonplaceholder.typicode.com/todos/1");
                                return online.status >= 200 && online.status < 300; // either true or false
                            } catch (err) {
                                return false; // definitely offline
                            }
                        };

                        const updateInternetStatus = async () => {
                            const result = await checkOnlineStatus();
                            const statusDisplay = document.getElementById("status");
                            statusDisplay.innerHTML = result ? ( `
                            <div class="avatar">
                                <span class="status active"> CONNECTED</span>
                            </div>`) : (`
                            <div class="avatar">
                                <span class="status"> NOT CONNECTED</span>
                            </div>`);
                            return result;
                        }

                        if(canSyncronize){

                            let  limitedInterval =  setInterval(async () => {
                                const result = await updateInternetStatus();
                                console.log(result);
                                if(result){
                                    // window.location.reload();
                                    $.ajax({
                                        url: "{{ url('syncronize_to_obr') }}", // the url we want to send and get data from
                                        type: "GET", // type of the data we send (POST/GET)
                                        // the data we want to send
                                    }).done(function(data){
                                        // this part will run when we send and return successfully
                                        console.log(data);
                                        if(!data.data){
                                            clearInterval(limitedInterval);
                                            console.log('interval cleared! Pas de donnees recu');
                                        }
                                    }).fail(function(error){
                                        // this part will run when an error occurres
                                        console.log("An error has occurred. => " , error);
                                    }).always(function(){
                                        // this part will always run no matter what
                                        console.log("Complete.");
                                    });
                                }else{
                                    clearInterval(limitedInterval);
                                    console.log('interval cleared!');
                                }
                            }, timeSyncronisation); // probably too often, try 30000 for every 30 second

                        }
                    </script>

                </body>
                </html>
