


<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Leaderboard (All-time Avg Score)</h3>
    <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('learn.index')); ?>">Back to modules</a>
  </div>

  <div class="card">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead><tr><th>#</th><th>Name</th><th>Avg Score</th><th>Attempts</th></tr></thead>
        <tbody>
          <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($i+1); ?></td>
              <td><?php echo e($r->user->name ?? 'User '.$r->user_id); ?></td>
              <td><?php echo e(number_format($r->avg_score,1)); ?>%</td>
              <td><?php echo e($r->attempts); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cybercore\resources\views/leaderboard/index.blade.php ENDPATH**/ ?>