<!DOCTYPE html>
<html>
    @include('vendor.site-bases.admin.inc.head')

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                @include('vendor.site-bases.admin.inc.sidebar')
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="{{url('/')}}" target="_blank"> საიტზე გადასვლა <i class="fa fa-angle-right"></i></a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/profile')}}" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('assets/admin/img/default_avatar.png') }}">
                                        {{ auth()->user()->name }}
                                        <span class=" fa fa-angle-down"></span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li>
                                            <a href="{{ url('admin/admins/edit/' . auth()->user()->id) }}" data-remote="false" data-toggle="modal" data-target="#modal" >
                                                <i class="fa fa-user pull-right"></i> პროფილი
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out pull-right"></i> გასვლა
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="right_col" role="main">
                    @include('vendor.site-bases.admin.inc.errors')
                    @yield('content')
                </div>
            </div>
        </div>

        <footer>
            <div class="pull-right">
                <a href="https://unicode.ge/" target="_blank">Unicode</a> Admin Panel
            </div>
            <div class="clearfix"></div>
        </footer>
    </body>

    @include('vendor.site-bases.admin.inc.footer')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            height: 500,
            toolbar: "insertfile undo redo | styleselect | fontsizeselect bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            fontsize_formats: "8pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt 48pt",
            relative_urls: false,
            height: 500,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            },
            setup: function (editor) {
                editor.on('change', function (e) {
                    editor.save();
                });
            }
        };

        tinymce.init(editor_config);
    </script>
</html>
