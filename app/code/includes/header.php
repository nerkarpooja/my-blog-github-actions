<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Blog</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: system-ui, sans-serif; background: #f5f5f5; color: #333; }
    nav { background: #1a1a2e; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
    nav a { color: #eee; text-decoration: none; margin-left: 1rem; font-size: 14px; }
    nav a:hover { color: #e94560; }
    nav .brand { color: #e94560; font-weight: bold; font-size: 1.2rem; margin-left: 0; }
    .container { max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
    .btn { display: inline-block; padding: 8px 18px; border-radius: 6px; border: none; cursor: pointer; font-size: 14px; text-decoration: none; }
    .btn-primary { background: #e94560; color: white; }
    .btn-danger  { background: #cc3333; color: white; }
    .btn-secondary { background: #555; color: white; }
    .card { background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; font-size: 13px; margin-bottom: 4px; color: #555; }
    .form-group input, .form-group textarea { width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; font-family: inherit; }
    .form-group textarea { resize: vertical; min-height: 120px; }
    .alert { padding: 10px 14px; border-radius: 6px; margin-bottom: 1rem; font-size: 14px; }
    .alert-error   { background: #fde8e8; color: #c0392b; border: 1px solid #f5c6cb; }
    .alert-success { background: #e8f8e8; color: #27ae60; border: 1px solid #c3e6cb; }
    .meta { font-size: 12px; color: #999; margin-top: 4px; }
  </style>
</head>
<body>
<nav>
  <a href="/index.php" class="brand">📝 MyBlog</a>
  <div>
    <?php if (isset($_SESSION['user_id'])): ?>
      <span style="color:#aaa;font-size:13px">Hi, <?= htmlspecialchars($_SESSION['username']) ?></span>
      <a href="/posts/create.php">New Post</a>
      <a href="/auth/logout.php">Logout</a>
    <?php else: ?>
      <a href="/auth/login.php">Login</a>
      <a href="/auth/register.php">Register</a>
    <?php endif; ?>
  </div>
</nav>
