<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
    <title>Loccana</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="icon" type="image/gif" href="{{ asset('/metronic/assets/media/logos/thumb.png') }}" />

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/metronic/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/metronic/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="/css/admin/index.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="/argon/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/argon/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="/argon/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="/argon/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body id="kt_body" class="g-sidenav-show   bg-gray-100">

    @include('admin.layouts.aside2')

    <main class="main-content position-relative border-radius-lg ">
        @include('admin.layouts.navbar2')

        <div class="container-fluid py-4" id="main_content">
            @yield('content')
        </div>

        @include('admin.layouts.footer2')

    </main>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                    transform="rotate(90 13 6)" fill="black"></rect>
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="black"></path>
            </svg>
        </span>
    </div>


    <div id="kt_drawer_chat" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat"
        data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
        data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end"
        data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close">
        <div class="card w-100 rounded-0 border-0" id="notificiationModal">


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var hostUrl = "/metronic/assets/";
    </script>
    <script src="/metronic/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/metronic/assets/js/scripts.bundle.js"></script>
    <script src="/metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="/metronic/assets/js/custom/widgets.js"></script>
    <script src="/metronic/assets/js/custom/modals/create-app.js"></script>

    <script src="/metronic/assets/js/custom/modals/upgrade-plan.js"></script>
    <script src="/js/admin/index.js"></script>


    <script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js"></script>


    <div id="kt_explore" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="explore"
        data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
        data-kt-drawer-width="{default:'350px', 'lg': '475px'}" data-kt-drawer-direction="end"
        data-kt-drawer-toggle="#kt_explore_toggle" data-kt-drawer-close="#kt_explore_close">
        <div class="card shadow-none rounded-0 w-100 justify-content-end ribbon ribbon-start ribbon-clip">
            <div class="ribbon-label">
                Loccana
                <span class="ribbon-inner bg-info"></span>
            </div>
            <div class="card-body" id="kt_explore_body">
                <div id="kt_explore_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true"
                    data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_explore_body"
                    data-kt-scroll-dependencies="#kt_explore_header" data-kt-scroll-offset="5px">
                    <div class="mb-0" id="onlineList">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#kt_explore_toggle').on('click', function() {
            $('#onlineList').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>');
            $.get("{{ url('/admin/listuseronline') }}", {}, function(data) {
                $('#onlineList').html(data);
            })
        })

        // function openChat(id) {
        //         $.get("{{ url('/admin/openchat') }}/" + id, {}, function(data) {
        //             $('#onlineList').html(data);
        //         })
        //     }

        function changeDarkMode() {
            $.get("{{ url('/admin/changedarkmode') }}", {}, function(data) {
                location.reload()
            })
        }
    </script>

    {{-- Condition --}}
    @if (auth()->user()->userrole->role == 'Super Admin')
        <script>
            $('#kt_drawer_chat_toggle').on('click', function() {
                $('#notificiationModal').html(
                    '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>');


                $.get("{{ url('/admin/listnotification') }}", {}, function(data) {
                    $('#notificiationModal').html(data);
                })
            })
        </script>

        {{-- Toastr --}}
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toastr-bottom-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        </script>
        {{-- End Toastr --}}

        {{-- Pusher --}}
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>
            notif()

            function notif() {
                $.get("{{ url('/admin/checknotification') }}", {}, function(data) {
                    if (data === 0) {
                        $('#notifycountnya').remove();
                    } else {
                        $('#notifycountnya').html(
                            '<span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-primary">' +
                            data + '</span>');
                    }
                });
            }


            var pusher = new Pusher('2fb2f36b07796a95452d', {
                cluster: 'ap3'
            });

            var channel = pusher.subscribe('notification');
            channel.bind('notif', function(data) {
                toastr["info"](data.message, "Pemberitahuan");
                notif();
            });
        </script>
        {{-- End Pusher --}}
    @endif
    {{-- End Condition --}}


    {{-- Check Connection --}}
    <script type="text/javascript">
        var x = 0;
        var jumlah = 0;
        var data = [];

        $(document).ready(function() {
            $('#checkInternetSpeed').addClass('text-danger');
            $('#checkInternetSpeed').removeClass('text-warning');
            $('#checkInternetSpeed').removeClass('text-primary');
            $('#checkInternetSpeed').removeClass('text-success');
            setInterval(MeasureConnectionSpeed, 5000);
        });

        var imageAddr = "{{ url('storage/background/testconnect.PNG') }}";
        var downloadSize = 41500; //bytes

        function InitiateSpeedDetection() {
            window.setTimeout(MeasureConnectionSpeed, 1);
        };

        if (window.addEventListener) {
            window.addEventListener('load', InitiateSpeedDetection, false);
        } else if (window.attachEvent) {
            window.attachEvent('onload', InitiateSpeedDetection);
        }

        function MeasureConnectionSpeed() {
            var startTime, endTime;
            var download = new Image();
            download.onload = function() {
                endTime = (new Date()).getTime();
                showResults();
            }

            download.onerror = function(err, msg) {
                console.log('error download');
            }

            startTime = (new Date()).getTime();
            var cacheBuster = "?nnn=" + startTime;
            download.src = imageAddr + cacheBuster;

            function showResults() {
                var duration = (endTime - startTime) / 1000;
                var bitsLoaded = downloadSize * 8;
                var speedBps = (bitsLoaded / duration).toFixed(2);
                var speedKbps = (speedBps / 1024).toFixed(2);
                var speedMbps = (speedKbps / 1024).toFixed(2);

                if (speedMbps < 10) {
                    $('#checkInternetSpeed').removeClass('text-warning');
                    $('#checkInternetSpeed').removeClass('text-success');
                    $('#checkInternetSpeed').removeClass('text-primary');
                    $('#checkInternetSpeed').addClass('text-danger');

                    jumlah = jumlah + 1;
                    if (speedMbps <= 5) {
                        toastr.warning("Be carefull, your connection not stable..");
                    }
                } else if (speedMbps < 20) {
                    jumlah = 0;
                    $('#checkInternetSpeed').addClass('text-warning');
                    $('#checkInternetSpeed').removeClass('text-danger');
                    $('#checkInternetSpeed').removeClass('text-success');
                    $('#checkInternetSpeed').removeClass('text-primary');
                } else {
                    jumlah = 0;
                    $('#checkInternetSpeed').addClass('text-primary');
                    $('#checkInternetSpeed').removeClass('text-danger');
                    $('#checkInternetSpeed').removeClass('text-warning');
                    $('#checkInternetSpeed').removeClass('text-success');
                }

                $('#checkInternetSpeed').html(Math.round(speedMbps) + "Mbps");
            }
        }
    </script>
    {{-- End Check Connection --}}


    {{-- Argon --}}

    <script src="/argon/assets/js/core/popper.min.js"></script>
    <script src="/argon/assets/js/core/bootstrap.min.js"></script>
    <script src="/argon/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/argon/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/argon/assets/js/plugins/chartjs.min.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/argon/assets/js/argon-dashboard.min.js?v=2.0.4"></script>

    {{-- End Argon --}}

    {{-- Menu --}}
    @if (!session('menu'))
        <script>
            var loadingMenu =
                "<button class='btn btn-primary' type='button' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...</button>"

            $('#kt_aside_menu').html(loadingMenu)

            menu();

            function menu() {
                $.get("{{ url('/admin/loadmenu/0') }}/" + {{ auth()->user()->role_id }}, {}, function(data, status) {
                    $('#kt_aside_menu').html(data)
                })
            }
        </script>
    @endif
    {{-- End Menu --}}


    @yield('js')

</body>

</html>
