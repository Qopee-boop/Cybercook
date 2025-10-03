
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CyberCore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-light bg-light border-bottom">
    <div class="container">
      <a class="navbar-brand" href="/">CyberCore</a>
      <a class="btn btn-outline-primary btn-sm" href="<?php echo e(route('learn.index')); ?>">Learn</a>
      <a class="btn btn-outline-primary btn-sm" href="<?php echo e(route('performance.index')); ?>">Performance</a>

      <?php if(auth()->guard()->check()): ?>
        <a class="btn btn-outline-primary btn-sm me-2" href="<?php echo e(route('leaderboard.index')); ?>">Leaderboard</a>
        <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(url('/badges')); ?>">Badges</a>
      <?php endif; ?>

      <?php if(auth()->guard()->check()): ?>
        <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('account.index')); ?>">Account</a>
      <?php endif; ?>

      <?php if(auth()->guard()->check()): ?>
        <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0">
          <?php echo csrf_field(); ?>
          <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
      <?php endif; ?>
    </div>
  </nav>

  <main class="py-4">
    <div class="container">
      
      <?php if(session('status') === 'session-expired'): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          You were signed out due to inactivity.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php elseif(session('status')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo e(session('status')); ?>

          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>

    
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\cybercore\resources\views/layouts/app.blade.php ENDPATH**/ ?>