<?php
session_start();
require_once 'config/db.php';
require_once 'includes/header.php';
?>
<div class="container">
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
    <h2>Latest Posts</h2>
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="/posts/create.php" class="btn btn-primary">+ New Post</a>
    <?php endif; ?>
  </div>
  <?php
  $stmt = $pdo->query("SELECT posts.*, users.username FROM posts
                        JOIN users ON posts.user_id = users.id
                        ORDER BY posts.created_at DESC");
  $posts = $stmt->fetchAll();
  if (empty($posts)): ?>
    <div class="card">
      <p style="color:#999; text-align:center;">No posts yet. Be the first to write one!</p>
    </div>
  <?php else: ?>
    <?php foreach ($posts as $post): ?>
      <div class="card">
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <p class="meta">by <?= htmlspecialchars($post['username']) ?> &bull; <?= date('M j, Y', strtotime($post['created_at'])) ?></p>
        <p style="margin-top:0.75rem; line-height:1.6;"><?= nl2br(htmlspecialchars($post['body'])) ?></p>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
          <form method="POST" action="/posts/delete.php" style="margin-top:0.75rem;">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this post?')">Delete</button>
          </form>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
<?php require_once 'includes/footer.php'; ?>
