


<?php $__env->startSection('content'); ?>
<div class="row g-3">
  <div class="col-md-3"><div class="card"><div class="card-body"><div class="small text-muted">Users</div><div class="h3"><?php echo e($users); ?></div></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><div class="small text-muted">Modules</div><div class="h3"><?php echo e($modules); ?></div></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><div class="small text-muted">Questions</div><div class="h3"><?php echo e($questions); ?></div></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><div class="small text-muted">Quiz Attempts</div><div class="h3"><?php echo e($attempts); ?></div></div></div></div>
</div>

<div class="card mt-4">
  <div class="card-header">Recent activity</div>
  <div class="card-body p-0">
    <table class="table align-middle mb-0">
      <thead><tr><th>User</th><th>Module</th><th>Score</th><th>Completed</th></tr></thead>
      <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($a->user->name ?? $a->user->email); ?></td>
          <td><?php echo e($a->module->title); ?></td>
          <td><?php echo e($a->score); ?>%</td>
          <td><?php echo e(optional($a->completed_at)->diffForHumans()); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="4" class="text-center text-muted py-4">No attempts yet.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cybercore\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>