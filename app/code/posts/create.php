<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $body  = trim($_POST['body']  ?? '');
    if (empty($title) || empty($body)) {
        $error = 'Title and body are required.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, body) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $title, $body]);
        header('Location: /index.php');
        exit;
    }
}

require_once '../includes/header.php';
?>
<div class="container">
  <div class="card">
    <h2 style="margin-bottom:1.25rem;">New Post</h2>
    <?php if ($error): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" required>
      </div>
      <div class="form-group">
        <label>Body</label>
        <textarea name="body" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Publish</button>
      <a href="/index.php" class="btn btn-secondary" style="margin-left:8px">Cancel</a>
    </form>
  </div>
</div>
<?php require_once '../includes/footer.php'; ?>
