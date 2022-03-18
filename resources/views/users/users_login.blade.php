<!DOCTYPE html>
<html lang="ka" class="js">
<head>
    <title>DevLion CMS V 1.0</title>
    <meta charset="utf-8">
    <meta name="author" content="Foxes">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ url('/assets/css/dashlite.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/theme.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/custom.css') }}">

    @yield('css')
</head>
<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-header nk-header-fluid is-theme">
            <div class="container-xl wide-xl">
                <div class="nk-header-wrap">
                    <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-header-brand">
                        <a href="{{ route('actionMainIndex') }}" class="logo-link">
                            <img class="logo-light logo-img" src="{{ url('assets/images/logo.png') }}" srcset="{{ url('assets/images/logo2x.png') }} 2x" alt="logo">
                            <img class="logo-dark logo-img" src="{{ url('assets/images/logo-dark.png') }}" srcset="{{ url('assets/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title font-neue">ავტორიზაცია</h4>
                                        <div class="nk-block-des">
                                            <p class="font-helvetica-regular" style="font-size: 12px;">სამართავ პანელში შესასვლელად გთხოვთ გაიაროთ ავტორიზაცია</p>
                                        </div>
                                    </div>
                                </div>
                                <form id="user_login_form">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label font-helvetica-regular" for="user_email">ელ-ფოსტა</label>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" name="user_email" id="user_email" placeholder="ელ-ფოსტა">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label font-helvetica-regular" for="user_password">პაროლი</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch" data-target="user_password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="user_password" name="user_password" placeholder="პაროლი">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block font-neue" type="button" onclick="UserLoginSubmit()">ავტორიზაცია</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-footer-fluid bg-lighter">
                        <div class="container-xl wide-xl">
                            <div class="nk-footer-wrap">
                                <div class="nk-footer-copyright"> &copy; Crafted with ❤️ By <a href="#">Mito Chikhladze</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('/assets/js/bundle.js') }}"></script>
    <script src="{{ url('/assets/js/scripts.js') }}"></script>
    <script src="{{ url('/assets/scripts/users_scripts.js') }}"></script>
</html>