
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CyberCore Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
      <a class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>">CyberCore Admin</a>
      <div class="ms-auto">
        <a class="btn btn-sm btn-outline-secondary" href="<?php echo e(route('dashboard')); ?>">Learner View</a>
        <a class="btn btn-outline-primary btn-sm" href="<?php echo e(route('admin.reports.index')); ?>">Reports</a>
      </div>
    </div>
  </nav>

  <main class="container py-4">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\cybercore\resources\views/admin/layout.blade.php ENDPATH**/ ?>