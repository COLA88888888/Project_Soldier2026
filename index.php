<!-- login.php -->
<!DOCTYPE html>
<html lang="lo">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
  <link rel="icon" type="image/x-icon" href="logo/1.jfif">
<!-- Fonts + Icons -->
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Noto+Sans+Lao|Source+Sans+Pro:300,400,400i,700&display=swap">
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<link rel="stylesheet" href="ionicons-2.0.1/css/ionicons.min.css">

<style>
*{font-family:'saysettha ot','Noto Sans Lao','Source Sans Pro',sans-serif;}

body{
  margin:0;
  padding:0;
  min-height:100vh;
  background:linear-gradient(135deg,rgba(1,93,118,0.94),rgb(164,187,220)); /* fallback หากวีดีโอไม่โหลด */
  background-size:cover;
  position:relative;
  overflow:hidden;
}

/* วีดีโอพื้นหลัง */
.bg-video{
  position:fixed;
  top:0;left:0;
  width:100%;height:100%;
  object-fit:cover;
  z-index:-2;
  pointer-events:none;
  filter:brightness(70%); /* ปรับความมืดให้ฟอร์มอ่านง่าย */
}

/* เลเยอร์ไล่เฉดมืดทับวีดีโอ */
.bg-overlay{
  position:fixed;
  top:0;left:0;
  width:100%;height:100%;
  z-index:-1;
  background:linear-gradient(
      to bottom,
      rgba(0,0,0,.35) 0%,
      rgba(0,0,0,.15) 40%,
      rgba(0,0,0,.35) 100%
  );
  pointer-events:none;
}

/* Animation Keyframes */
@keyframes fadeSlideUp{
  0%{opacity:0;transform:translateY(50px) scale(.97);}
  100%{opacity:1;transform:translateY(0) scale(1);}
}

/* กล่องล็อกอิน */
.login-box{
  position:relative;
  z-index:10;
  width:360px;
  margin:8px auto 0 auto;
  animation:fadeSlideUp 0.9s ease-out both;
  box-shadow:0 10px 30px #00000040;
}

/* การ์ด */
.card{
  border-radius:10px;
  background-color:rgba(255,255,255,.82);
  backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
}

/* โลโก้ */
.login-logo img{
  border-radius:50%;
  box-shadow:0 4px 10px rgba(0,0,0,.2);
}
</style>
</head>

<body class="hold-transition login-page">

<!-- วีดีโอพื้นหลัง -->
<video class="bg-video" autoplay muted loop playsinline>
  <source src="video/4729723-uhd_3840_2160_30fps.mp4" type="video/mp4">
  <!-- <source src="video/background.webm" type="video/webm"> -->
  <!-- ถ้าไม่โหลดจะใช้ background gradient -->
</video>
<div class="bg-overlay"></div>

<div class="login-box">
  <div class="login-logo">
    <img src="logo/1.jfif" alt="logo" width="100" height="100">
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <h4 class="login-box-msg"><b>ພະນັກງານ</b></h4>
      <form>
        <div class="input-group mb-3">
          <input type="text" id="username" class="form-control" placeholder="ຊື່ຜູ້ໃຊ້" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" placeholder="ລະຫັດຜ່ານ" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 text-center">
            <button type="button" id="send" class="btn btn-danger btn-block">
              <i class="ion-android-checkbox-outline"></i> ເຂົ້າລະບົບ
            </button>
          </div>
        </div>
      </form>
      <div class="show mt-3"></div>
    </div>
  </div>
</div>

<!-- JS Libraries -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<!-- SweetAlert2 -->
<script src="sweetalert/dist/sweetalert2.all.min.js"></script>

<script>
$(function() {
  $("#send").click(function() {
    let username = $("#username").val().trim();
    let password = $("#password").val().trim();

    if (username === "") {
      Swal.fire({
        icon: 'warning',
        title: 'ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້',
        timer: 1500,
        showConfirmButton: false
      });
      return;
    }

    if (password === "") {
      Swal.fire({
        icon: 'warning',
        title: 'ກະລຸນາປ້ອນລະຫັດຜ່ານ',
        timer: 1500,
        showConfirmButton: false
      });
      return;
    }

    $.post("check_login.php", { username: username, password: password }, function(data) {
      $(".show").html(data);
    }).fail(function() {
      Swal.fire({
        icon: 'error',
        title: 'ເກີດຂໍ້ຜິດພາດ',
        text: 'ບໍ່ສາມາດຕິດຕໍ່ server',
        confirmButtonText: 'OK'
      });
    });
  });
});
</script>

</body>
</html>
