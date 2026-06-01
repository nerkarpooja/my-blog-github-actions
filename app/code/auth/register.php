<?php
session_start();
require_once '../config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (empty($username) || empty($password)) {
        $error = 'All fields are required.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = 'Username already taken.';
        } else {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
            $success = 'Account created! You can now log in.';
        }
    }
}

require_once '../includes/header.php';
?>
<div class="container">
  <div class="card" style="max-width:400px; margin:2rem auto;">
    <h2 style="margin-bottom:1.25rem;">Register</h2>
    <?php if ($error):   ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?> <a href="/auth/login.php">Login</a></div><?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required minlength="6">
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%">Register</button>
    </form>
    <p style="margin-top:1rem; font-size:13px; text-align:center;">Already have an account? <a href="/auth/login.php">Login</a></p>
  </div>
</div>
<?php require_once '../includes/footer.php'; ?>
