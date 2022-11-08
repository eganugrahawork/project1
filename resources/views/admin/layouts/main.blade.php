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
    <link rel="icon" type="image/gif" href="{{ asset('storage/logos/logoputih.png') }}" />

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/metronic/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/metronic/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="/metronic/assets/css/darkmode.bundle.css"> --}}
    <link rel="stylesheet" href="/css/admin/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-enabled">

    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('admin.layouts.header')


                @yield('content')


                @include('admin.layouts.footer')

            </div>
        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> --}}

    <script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



    <button id="kt_explore_toggle"
        class="explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0 notify"
        title="Online Users" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover">
        <span id="kt_explore_toggle_label">Online Users</span>
    </button>

    <div id="kt_explore" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="explore"
        data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
        data-kt-drawer-width="{default:'350px', 'lg': '475px'}" data-kt-drawer-direction="end"
        data-kt-drawer-toggle="#kt_explore_toggle" data-kt-drawer-close="#kt_explore_close">
        <div class="card shadow-none rounded-0 w-100">
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

        function openChat(id) {
                $.get("{{ url('/admin/openchat') }}/" + id, {}, function(data) {
                    $('#onlineList').html(data);
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
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        {{-- End Toastr --}}

        {{-- Pusher --}}
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>
            notif()

            function notif() {
                $.get("{{ url('/admin/checknotification') }}", {}, function(data) {
                    $('#notifycountnya').html(data);
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

    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> --}}

    <script>
        $(document).ready(function() {
            var indukTable = $('#indukTable').DataTable({
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
            });

            $('#searchIndukTable').keyup(function() {
                indukTable.search($(this).val()).draw()
            });
        });
    </script>

    {{-- Menu --}}
    @if (!session('menu'))
        <script>
            var loadingMenu =
                "<button class='btn btn-primary' type='button' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...</button>"

            $('#kt_header_menu').html(loadingMenu)

            menu();

            function menu() {
                $.get("{{ url('/admin/loadmenu/0') }}/" + {{ auth()->user()->role_id }}, {}, function(data, status) {
                    $('#kt_header_menu').html(data)
                })
            }
        </script>
    @endif
    {{-- End Menu --}}
    @yield('js')

</body>

</html>
