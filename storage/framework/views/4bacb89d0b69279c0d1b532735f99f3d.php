


<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h4 class="mb-1">Your score: <?php echo e($attempt->score); ?>%</h4>
      <div class="text-muted">Module: <?php echo e($attempt->module->title); ?> · Duration: <?php echo e($attempt->duration_sec); ?>s</div>
      <a href="<?php echo e(route('learn.index')); ?>" class="btn btn-primary mt-3">Back to modules</a>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Your answers & feedback</div>
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead><tr><th>#</th><th>Question</th><th>Your answer</th><th>Correct</th><th>Feedback</th></tr></thead>
        <tbody>
        <?php $__currentLoopData = $qas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($i+1); ?></td>
            <td class="w-50"><?php echo e($qa->question->stem); ?></td>
            <td>
              <?php $ua = (array) ($qa->user_answer ?? []); ?>
              <?php echo e(implode(', ', $ua)); ?>

            </td>
            <td>
              <?php $ca = (array) ($qa->question->answer ?? []); ?>
              <span class="badge <?php echo e($qa->is_correct ? 'text-bg-success':'text-bg-danger'); ?>">
                <?php echo e($qa->is_correct ? 'Correct' : implode(', ', $ca)); ?>

              </span>
            </td>
            <td class="text-muted small"><?php echo e($qa->question->explanation); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cybercore\resources\views/quiz/result.blade.php ENDPATH**/ ?>