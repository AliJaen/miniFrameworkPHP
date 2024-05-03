<!doctype html>
<html lang="<?= SITE_LANG ?>">

<head>
  <meta charset="<?= SITE_CHARSET ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="<?= SITE_VERSION ?>">
  <meta name="description" content="<?= SITE_DESC ?>">
  <meta name="author" content="<?= SITE_AUTHOR ?>">
  <title><?= SITE_NAME ?></title>
  <?= get_favicon(); ?>
  <link rel="stylesheet" href="<?= CSS ?>/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?= get_logo(); ?>" width="180" alt="">
                </a>
                <p class="text-center">A MiniFramework PHP</p>
                <form>
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="email" class="form-control" id="username" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="showPass" onchange="showPassword(this);">
                      <label class="form-check-label text-dark" for="showPass">Show password</label>
                    </div>
                    <a class="text-primary fw-bold" href="#">Forgot Password ?</a>
                  </div>
                  <button type="button" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" onclick="login();">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                    <a class="text-primary fw-bold ms-2" href="<?= base_url ?>/Register">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= LIBS ?>/jquery/dist/jquery.min.js"></script>
  <script src="<?= LIBS ?>/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert 2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- JS Admin -->
  <script src="<?= ASSETS ?>/app/js/<?php echo $data["function_js"]; ?>"></script>
  <script>
    function showPassword(showPass) {
      const password = document.getElementById("password");
      if (showPass.checked) {
        password.type = "text";
      } else {
        password.type = "password";
      }
    }
  </script>
</body>

</html>