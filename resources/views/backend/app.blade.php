<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" type="image/png" href="/wp-content/uploads/2017/11/v_5_telif-300x300.png">

    <title>ISESER | 2019</title>
    <meta name="description"
          content="International Symposium for Environmental Science and Engineering Research | ISESER2019"/>

    <link rel="stylesheet" href="{{ url ('/backend/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link href="{{url('/')}}/backend/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/build/css/custom.min.css" rel="stylesheet">
    <?php
    if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
        $local = True;
    } else {
        $local = False;
    }
    ?>
    @if($local==false)
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109514763-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-109514763-1');
        </script>
    @endif
    @yield('css')
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{url('/')}}/user/" class="site_title"> <span>ISESER <small>2019</small></span></a>
                </div>

                <div class="clearfix"></div>
                <br/>

                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menu</h3>
                        <ul class="nav side-menu">

                            <li><a href="{{url('/')}}/"><i class="fa fa-home"></i> Home</a></li>


                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 0)
                                <li><a href="{{url('/')}}/user/"><i class="fa fa-tasks"></i> Profile</a></li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a href="{{url('/')}}/user/papers-add"><i class="fa fa-pencil"></i>Paper Add
                                    </a>
                                </li>
                                <li><a href="{{url('/')}}/user/papers-all"><i class="fa fa-file-text-o"></i> All
                                        Papers </a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 0)
                                <li><a href="{{url('/')}}/user/paper-add"><i class="fa fa-pencil"></i> Paper
                                        Submission </a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 0)
                                <li><a href="{{url('/')}}/user/papers"><i class="fa fa-file-text-o"></i> Sended
                                        Papers </a>
                                </li>
                            @endif



                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a href="{{url('/')}}/user/review"><i class="fa fa-retweet"></i>Review
                                    </a>
                                </li>
                                <li><a href="{{url('/')}}/user/review-all"><i class="fa fa-arrows"></i> All
                                        review </a>
                                </li>
                            @endif


                            @if(\Illuminate\Support\Facades\Auth::user()->yetki <= 9)
                                <li><a href="{{url('/')}}/user/announcement"><i class="fa fa-bullhorn"></i> Announcement
                                    </a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a><i class="fa fa-bullhorn"></i> Announcement <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('/')}}/user/announcement">Announcements</a></li>
                                        <li><a href="{{url('/')}}/user/announcement/announce-add">Add Announcement</a>
                                        </li>
                                    </ul>
                                </li>

                            @endif


                            @if(\Illuminate\Support\Facades\Auth::user()->yetki <= 9)
                                <li><a href="{{url('/')}}/user/feedback/feedback-add"><i class="fa fa-comments-o"></i>
                                        Add
                                        Feedback </a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a><i class="fa fa-comments-o"></i> Feedbacks <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('/')}}/user/feedback">Feedbacks</a></li>
                                        <li><a href="{{url('/')}}/user/feedback/feedback-add">Add Feedbacks</a></li>
                                    </ul>
                                </li>
                            @endif

                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a><i class="fa fa-question"></i> FAQ <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('/')}}/user/faq">FAQs</a></li>
                                        <li><a href="{{url('/')}}/user/faq/faq-add">Add FAQs </a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a><i class="fa fa-crosshairs"></i> Types <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('/')}}/user/tur/is-turu">Title Types </a></li>
                                        <li><a href="{{url('/')}}/user/tur/is-turu-ekle">Add Title Type </a></li>
                                        <li><a href="{{url('/')}}/user/tur/malzeme-turu">Type Types </a></li>
                                        <li><a href="{{url('/')}}/user/tur/malzeme-turu-ekle">Add Type Type </a></li>
                                        <li><a href="{{url('/')}}/user/tur/uygulama-turu">PresentationTypes </a></li>
                                        <li><a href="{{url('/')}}/user/tur/uygulama-turu-ekle"> Add Presentation
                                                Type </a></li>
                                        <li><a href="{{url('/')}}/user/tur/birim-turu">Paper Types </a></li>
                                        <li><a href="{{url('/')}}/user/tur/birim-turu-ekle"> Add Paper Type </a>
                                        </li>
                                        <li><a href="{{url('/')}}/user/tur/yetki-turu">Authority Types </a></li>
                                        <li><a href="{{url('/')}}/user/tur/yetki-turu-ekle">Add Authority Type </a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('/')}}/user/user/users">Users</a></li>
                                        <li><a href="{{url('/')}}/user/user/user-add">Add User</a></li>
                                    </ul>
                                </li>

                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a><i class="fa fa-volume-up "></i> Blog <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('/')}}/user/blog/">Blog Articles</a></li>
                                        <li><a href="{{url('/')}}/user/blog/blog-add">Add Blog</a></li>
                                        <li><a href="{{url('/')}}/user/blog/categories">Categories</a></li>
                                        <li><a href="{{url('/')}}/user/blog/categorie-add">Add Categories</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                <li><a href="{{url('/')}}/about-us"><i class="fa fa-bullseye"></i> About Us </a></li>
                            @endif


                            <li><a href="/documents"><i class="fa fa-download"></i>Documents</a></li>


                        </ul>

                    </div>

                </div>
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">

                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                @if(isset(Auth::user()->logo))
                                    <img src="{{url('/')}}/uploads/img/{{ Auth::user()->logo }}"
                                         alt="">{{ Auth::user()->name }}
                                @else
                                    <img src="{{url('/')}}/user/uploads/img/logo.png"
                                         alt="">{{ Auth::user()->name .' '. Auth::user()->surname }}
                                @endif
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <a href="{{url('/')}}/user/">Profile Settings</a>
                                </li>
                                <li>
                                    <a href="{{url('/')}}/user/faq">FAQ</a>
                                </li>
                                <li><a href="{{url('/')}}/cikisyap"><i class="fa fa-sign-out pull-right"></i>
                                        Logout</a>
                                </li>
                            </ul>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-volume-up"></i>
                                <span class="badge bg-green">3</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                                @foreach($announceup as $blog)
                                    <li>
                                        <a>
                                         <span>
<span>{{$blog->baslik}}</span>
<span class="time">{{$blog->istek_birimi}}</span>
</span>
                                            <span class="message"><?php echo html_entity_decode($blog->icerik); ?>
</span>
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <div class="text-right">
                                        <a href="{{url('/')}}/user/announcement">
                                            <strong>All Developments</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

    @yield('content')

        <footer>
            <div class="pull-right">
                ISESER
                <a target="_blank" href="//creativecommons.org/licenses/by-nc-nd/4.0/deed.tr" title="creativecommons"
                   rel="external">© 2019</a> ❤ BaykuşGrup. Tüm hakları saklıdır. |
                <a target="_blank" rel="external" href="//www.google.com.tr/search?hl=tr&amp;q=ISESER" title="ISESER">G-Arama</a>
                |
                <a target="_blank" href="//www.alexa.com/siteinfo/iseser.com" rel="external" title="Alexa">Alexa</a>

            </div>
            <div class="clearfix"></div>
        </footer>
    </div>
</div>

<!-- jQuery -->
<script src="{{url('/')}}/backend/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{url('/')}}/backend/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{url('/')}}/backend/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="{{url('/')}}/backend/vendors/nprogress/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="{{url('/')}}/backend/build/js/custom.min.js"></script>


<script src="https://cdn.jsdelivr.net/gh/alnorris/file-dialog/index.js"></script>
<script src="https://cdn.jsdelivr.net/gh/buraktamturk/upload-controller-factory/index.js"></script>
<script src="{{url('/')}}/js/prettysize.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/buraktamturk/file-upload-component/index.js"></script>

<script src="{{url('/')}}/js/multipleUpload.js" type="text/javascript"></script>

<script>
    var UploadController = UploadControllerFactory({
        uploader: function (name, blob, contentType, abort, progress) {
            var token = $('meta[name="csrf-token"]').attr('content');

            var form = new FormData();
            form.append("dosya", blob);
            form.append("_token", token);

            return new Promise(function (resolve, reject) {
                var xhr = new XMLHttpRequest();

                abort.onabort = function () {
                    xhr.onreadystatechange = null;
                    xhr.abort();
                    reject(new Error('Aborted!'));
                };

                xhr.upload.onprogress = xhr.upload.onloadstart = function (e) {
                    progress(e.loaded / e.total);
                };

                xhr.onreadystatechange = function (e) {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 200) {
                            resolve(JSON.parse(this.responseText));
                        } else {
                            reject(this);
                        }
                    }
                };

                xhr.open("POST", "/upload", true);
                xhr.send(form);
            });
        }
    });

    console.log("asdasdas");

    window.FileUploadComponent.register("file-picker", UploadController);
    window.MultipleFileUploadComponent.register("multi-file-upload", UploadController);
</script>

@yield('js')

<script type="application/ld+json" data-type="WebSite">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "iseser.com",
        "url": "https://iseser.com/",
        "image": "https://iseser.com/doc/logo/v6_telifsiz-300x72.png",
        "sameAs": [
            "https://www.facebook.com/isesercom/",
            "https://iseser.com/",
        ]
    }

</script>
<script type="application/ld+json" data-type="Organization">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "https://iseser.com/",
        "logo":  "https://iseser.com/doc/logo/v6_telifsiz-300x72.png",
        "name": "iseser.com",
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+90 554 867 56 60",
                "email":"iseser@iseser.com",
                "contactType": "customer"
            }
        ]
    }

</script>
</body>
</html>
