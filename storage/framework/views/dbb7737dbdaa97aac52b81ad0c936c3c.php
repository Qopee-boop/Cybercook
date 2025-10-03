


<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <h3 class="mb-3">Available modules</h3>

  <div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title"><?php echo e($m->title); ?></h5>
            <p class="text-secondary small mb-3">
              <?php echo e(\Illuminate\Support\Str::limit($m->description, 140)); ?>

            </p>

            <?php $pct = (int) ($progress[$m->id] ?? 0); ?>
            <div class="progress mb-3" style="height:10px">
              <div class="progress-bar" role="progressbar" style="width: <?php echo e($pct); ?>%"></div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <div class="text-muted small">Progress: <?php echo e($pct); ?>%</div>
              <form action="<?php echo e(route('quiz.start', $m)); ?>" method="POST" class="m-0">
                <?php echo csrf_field(); ?>
                <button class="btn btn-primary btn-sm">Start / Resume</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="col-12 text-muted">No modules yet.</div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cybercore\resources\views/learn/index.blade.php ENDPATH**/ ?>