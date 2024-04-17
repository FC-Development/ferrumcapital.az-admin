<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ferrum Capital</title>
    <link href="https://cdn.ferrumcapital.az/site/apple-icon.png" rel="shortcut icon" type="image/x-icon">
    <link href="https://cdn.ferrumcapital.az/site/favicon.svg" rel="apple-touch-icon">
    <link rel="stylesheet" href="/dashboard_/assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="/dashboard_/assets/css/backende209.css?v=1.0.0">
    <link rel="stylesheet" href="/dashboard_/assets/css/gridjs.css?v=1.0.0">
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="container">
    <div class="wrapper ">
        <section class="login-content ">
            <div class="container h-100 ">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-md-5">
                        <div class="card p-4">
                            <div>
                                <h3 class="mb-4 font-weight-bold text-left">Xoş gəlmişsiniz!</h3>
                                <form id="LoginForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label
                                                    class="f-sm text-secondary font-weight-bold text-uppercase">E-poçt</label>
                                                <input class="form-control" type="email" name="email"
                                                    placeholder="E-poçt">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label
                                                        class="f-sm text-secondary font-weight-bold text-uppercase">Şİfrə</label>
                                                </div>
                                                <input class="form-control" name="password" type="password"
                                                    placeholder="Şifrəni daxil edin">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mt-2">Daxil ol</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
</body>
<!-- Backend Bundle JavaScript -->
</body>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="/dashboard_/assets/js/auth.js?{{date(now())}}"></script>
<!-- Mirrored from templates.iqonic.design/datum/html/backend/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 May 2022 14:02:29 GMT -->

</html>
