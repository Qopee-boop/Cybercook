
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CyberCore — Cybersecurity E-Learning for Everyone</title>
    <meta name="description" content="CyberCore is a secure, user-friendly e-learning platform to raise cybersecurity awareness for students, educators, and non-technical audiences.">
    <link rel="icon" href="/assets/img/favicon.svg">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="/assets/css/cybercore.css">

    <style>
      html {
        scroll-behavior: smooth;
      }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <span class="brand-mark"></span>
      <span class="fw-bold">CyberCore</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ccNav" aria-controls="ccNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="ccNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="#how">How it works</a></li>
        <li class="nav-item"><a class="nav-link" href="#topics">Topics</a></li>
        <li class="nav-item"><a class="nav-link" href="#security">Security</a></li>

        <?php if(auth()->guard()->check()): ?>
          <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
            <li class="nav-item ms-lg-2">
              <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-sm btn-outline-danger">Admin</a>
            </li>
          <?php endif; ?>
          <li class="nav-item ms-lg-2">
            <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
          </li>
          <li class="nav-item ms-lg-2">
            <form method="POST" action="http://cybercore.local/logout" class="m-0 d-inline">
              <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
              <button type="submit" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                  <polyline points="16 17 21 12 16 7"></polyline>
                  <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Logout
              </button>
            </form>
          </li>
        <?php endif; ?>

        <?php if(auth()->guard()->guest()): ?>
          <li class="nav-item ms-lg-2">
            <a class="btn btn-outline-primary" href="<?php echo e(route('login')); ?>">Sign in</a>
          </li>
          <li class="nav-item ms-lg-2">
            <a class="btn btn-primary" href="<?php echo e(route('register')); ?>">Get started</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>


<header class="hero-wrap py-5 py-lg-5">
  <div class="container py-4">
    <div class="row align-items-center gy-4">
      <div class="col-lg-6">
        <div class="hero-kicker mb-2">Empowering Cybersecurity Knowledge</div>
        <h1 class="display-4 hero-title">
          Learn to spot threats. <span style="color:var(--cc-red)">Stay safe online.</span>
        </h1>
        <p class="lead hero-sub mt-3">
          CyberCore is a secure, user-friendly e-learning platform designed to raise cybersecurity awareness
          for students, educators, and non-technical users through interactive modules and quizzes.
        </p>
        <div class="d-flex gap-3 mt-4">
          <a class="btn btn-primary btn-lg" href="<?php echo e(route('register')); ?>">Start learning</a>
          <a class="btn btn-outline-danger btn-lg" href="#topics">Browse topics</a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="row g-3">
          <!-- Interactive Learning -->
          <div class="col-md-6">
            <div class="card h-100 text-center p-4 shadow-sm">
              <div class="mb-3 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open">
                  <path d="M12 7v14"></path>
                  <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
                </svg>
              </div>
              <h5 class="fw-bold">Interactive Learning</h5>
            </div>
          </div>

          <!-- Certificates -->
          <div class="col-md-6">
            <div class="card h-100 text-center p-4 shadow-sm">
              <div class="mb-3 text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award">
                  <circle cx="12" cy="8" r="6"></circle>
                  <path d="M8.21 13.89L7 23l5-2 5 2-1.21-9.11"></path>
                </svg>
              </div>
              <h5 class="fw-bold">Certificates</h5>
            </div>
          </div>

          <!-- Expert Instructors -->
          <div class="col-md-6">
            <div class="card h-100 text-center p-4 shadow-sm">
              <div class="mb-3 text-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users">
                  <circle cx="9" cy="7" r="4"></circle>
                  <path d="M17 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
              </div>
              <h5 class="fw-bold">Expert Instructors</h5>
            </div>
          </div>

          <!-- CyberCore Platform -->
          <div class="col-md-6">
            <div class="card h-100 text-center p-4 shadow-sm">
              <div class="mb-3 text-danger">
                <i class="fas fa-laptop-code fa-lg"></i>
              </div>
              <h5 class="fw-bold">CyberCore Platform</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>


<section id="how" class="py-5 bg-hint">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold">How CyberCore works</h2>
      <p class="text-secondary mb-0">Learn → Take quizzes → Earn certificates</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4"><div class="card h-100 module-card"><div class="card-body">
        <h5 class="card-title">1. Learn</h5>
        <p class="text-secondary mb-0">Short modules that respect your time.</p>
      </div></div></div>
      <div class="col-md-4"><div class="card h-100 module-card"><div class="card-body">
        <h5 class="card-title">2. Quiz</h5>
        <p class="text-secondary mb-0">Adaptive questions with instant feedback.</p>
      </div></div></div>
      <div class="col-md-4"><div class="card h-100 module-card"><div class="card-body">
        <h5 class="card-title">3. Certificate</h5>
        <p class="text-secondary mb-0">View-only certificate upon passing.</p>
      </div></div></div>
    </div>
  </div>
</section>


<section id="topics" class="py-5">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Featured Courses</h2>
      <p class="text-secondary mb-0">Discover our most popular courses designed by industry experts</p>
    </div>

    <div class="d-flex justify-content-end mb-4">
      <a class="btn btn-outline-primary" href="<?php echo e(route('register')); ?>">Enroll free</a>
    </div>

    <?php ($modules = \App\Models\Module::where('is_active',true)->orderBy('title')->limit(4)->get()); ?>
    <div class="row g-4">
      <?php $__empty_1 = true; $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 module-card">
            <div class="card-body">
              <h5 class="card-title"><?php echo e($m->title); ?></h5>
              <p class="card-text text-secondary"><?php echo e(\Illuminate\Support\Str::limit($m->description, 90)); ?></p>
              <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('learn.start',$m)); ?>" class="btn btn-sm btn-primary">Begin</a>
              <?php else: ?>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-sm btn-primary">Begin</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        
        <div class="col-12">
          <div class="alert alert-info mb-0">Modules will appear here once published by Admin.</div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>


<section id="security" class="py-5">
  <div class="container">
    <div class="row align-items-center gy-4">
      <div class="col-lg-6">
        <h2 class="fw-bold">Security by design</h2>
        <ul class="text-secondary mb-0">
          <li>Role-based access control (User/Admin)</li>
          <li>Hashed passwords (Argon2/bcrypt)</li>
          <li>Input validation & sanitization to prevent SQLi/XSS</li>
          <li>Session timeout & CSRF protection</li>
          <li>OTP email verification</li>
        </ul>
      </div>
      <div class="col-lg-6">
        <div class="cta rounded-4 p-4 p-lg-5">
          <h5 class="mb-3">Learners first, always.</h5>
          <p class="text-secondary mb-4">We combine engaging content with learning science so anyone can develop real-world cyber safety skills.</p>
          <a href="<?php echo e(route('register')); ?>" class="btn btn-danger">Create your free account</a>
        </div>
      </div>
    </div>
  </div>
</section>


<footer class="bg-dark text-light pt-5 pb-3 mt-5">
  <div class="container">
    <div class="row">
      
      
      <div class="col-md-3 mb-4">
        <h3 class="fw-bold">CyberCore</h3>
        <p class="small text-secondary">
          Empowering learners worldwide with expert-led courses, interactive content, 
          and industry-recognized certificates.
        </p>
      </div>

      
      <div class="col-md-3 mb-4">
        <h3 class="fw-bold">Platform</h3>
        <ul class="list-unstyled">
          <li><a href="#" class="text-secondary text-decoration-none">Browse Courses</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Our Instructors</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Certificates</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Pricing</a></li>
        </ul>
      </div>

      
      <div class="col-md-3 mb-4">
        <h3 class="fw-bold">Support</h3>
        <ul class="list-unstyled">
          <li><a href="#" class="text-secondary text-decoration-none">Help Center</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Contact Us</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Privacy Policy</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Terms of Service</a></li>
        </ul>
      </div>

      
      <div class="col-md-3 mb-4">
        <h3 class="fw-bold">Connect With Us</h3>
        <div class="d-flex gap-3 mt-2">
          <a href="#" class="text-secondary fs-4"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-secondary fs-4"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-secondary fs-4"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-secondary fs-4"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>

    </div>

    <div class="border-top pt-3 mt-3 text-center text-secondary small">
      &copy; <span id="year"></span> CyberCore. All rights reserved.
    </div>
  </div>
</footer>

<script>
  document.getElementById('year').textContent = new Date().getFullYear();
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script src="/assets/js/cybercore.js"></script>
<script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\cybercore\resources\views/landing.blade.php ENDPATH**/ ?>