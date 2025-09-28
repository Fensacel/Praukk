<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data){
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];

        if($data['level'] == 'admin'){
            header("Location: index.php");
        } elseif ($data['level'] == 'user'){
            header("Location: index_user.php");
        } else{
            header("Location: home.php");
        }
        exit();
    } else{
        $error= "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height:100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-lg rounded-3">
          <div class="card-body p-4">
            <h4 class="text-center mb-3">Login</h4>

            <?php if (!empty($error)) { ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>

            <form method="post">
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
