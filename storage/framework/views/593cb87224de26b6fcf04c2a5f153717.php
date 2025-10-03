



<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Your Performance</h3>
    <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('learn.index')); ?>">Back to modules</a>
  </div>

  
  <div class="card mb-4">
    <div class="card-header">Weekly (last 12 weeks)</div>
    <div class="card-body">
      <canvas id="ccWeekly" height="110"></canvas>
    </div>
  </div>

  
  <div class="card mb-4">
    <div class="card-header">Monthly (last 12 months)</div>
    <div class="card-body">
      <canvas id="ccMonthly" height="110"></canvas>
    </div>
  </div>

  
  <div class="card mb-4">
    <div class="card-header">Recent attempts</div>
    <div class="card-body p-0">
      <table class="table mb-0 align-middle">
        <thead><tr><th>Date</th><th>Module</th><th>Score</th><th>Duration</th><th></th></tr></thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e(optional($a->completed_at)->format('Y-m-d H:i')); ?></td>
              <td><?php echo e($a->module->title ?? '—'); ?></td>
              <td><?php echo e($a->score); ?>%</td>
              <td><?php echo e($a->duration_sec); ?>s</td>
              <td><a class="btn btn-sm btn-primary" href="<?php echo e(route('quiz.result', $a)); ?>">View</a></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" class="text-center text-muted py-4">No attempts yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  
  <div class="card">
    <div class="card-header">Module status</div>
    <div class="card-body p-0">
      <table class="table mb-0 align-middle">
        <thead><tr><th>Module</th><th style="width:40%">Progress</th><th>Percent</th></tr></thead>
        <tbody>
          <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $pct = (int) ($progress[$m->id] ?? 0); ?>
            <tr>
              <td><?php echo e($m->title); ?></td>
              <td>
                <div class="progress" style="height:10px">
                  <div class="progress-bar" role="progressbar" style="width: <?php echo e($pct); ?>%"></div>
                </div>
              </td>
              <td><?php echo e($pct); ?>%</td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
  <script>
    // Weekly
    const wCtx = document.getElementById('ccWeekly').getContext('2d');
    new Chart(wCtx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($weeklyLabels, 15, 512) ?>,
        datasets: [
          { label: 'Avg score', data: <?php echo json_encode($weeklyAvg, 15, 512) ?>, yAxisID: 'y1' },
          { label: 'Attempts',  data: <?php echo json_encode($weeklyCount, 15, 512) ?>, yAxisID: 'y2' }
        ]
      },
      options: {
        parsing: false,
        scales: {
          x: { type: 'time', time: { unit: 'week' } },
          y1: { type: 'linear', position: 'left', suggestedMin: 0, suggestedMax: 100, title: { display: true, text: 'Score %' } },
          y2: { type: 'linear', position: 'right', suggestedMin: 0, ticks: { stepSize: 1 }, grid: { drawOnChartArea: false }, title: { display: true, text: 'Attempts' } }
        }
      }
    });

    // Monthly
    const mCtx = document.getElementById('ccMonthly').getContext('2d');
    new Chart(mCtx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($monthlyLabels, 15, 512) ?>,
        datasets: [
          { label: 'Avg score', data: <?php echo json_encode($monthlyAvg, 15, 512) ?>, yAxisID: 'y1' },
          { label: 'Attempts',  data: <?php echo json_encode($monthlyCount, 15, 512) ?>, yAxisID: 'y2' }
        ]
      },
      options: {
        parsing: false,
        scales: {
          x: { type: 'time', time: { unit: 'month' } },
          y1: { type: 'linear', position: 'left', suggestedMin: 0, suggestedMax: 100, title: { display: true, text: 'Score %' } },
          y2: { type: 'linear', position: 'right', suggestedMin: 0, ticks: { stepSize: 1 }, grid: { drawOnChartArea: false }, title: { display: true, text: 'Attempts' } }
        }
      }
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cybercore\resources\views/performance/index.blade.php ENDPATH**/ ?>