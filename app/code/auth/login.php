<?php
session_start();

require_once '../config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: /index.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}

require_once '../includes/header.php';
?>
<div class="container">
  <div class="card" style="max-width:400px; margin:2rem auto;">
    <h2 style="margin-bottom:1.25rem;">Login</h2>
    <?php if ($error): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%">Login</button>
    </form>
    <p style="margin-top:1rem; font-size:13px; text-align:center;">No account? <a href="/auth/register.php">Register</a></p>
  </div>
</div>
<?php require_once '../includes/footer.php'; ?>
