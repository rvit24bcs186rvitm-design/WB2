<?php
// CAREER CONNECT – Internship Application Portal
// success.php: displays the submitted application details.
// Academic demonstration only — no data is stored in a database.

session_start();

if (empty($_SESSION['application'])) {
    header('Location: index.html');
    exit;
}

$app = $_SESSION['application'];

// Clear session data after displaying (optional; keeps refresh safe).
unset($_SESSION['application']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Application Submitted – CAREER CONNECT</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
<nav class="navbar">
<div class="logo">CAREER CONNECT<span>.</span></div>
<ul class="nav-links">
<li><a href="index.html">Home</a></li>
<li><a href="internships.html">Internships</a></li>
<li><a href="apply.html">Apply</a></li>
<li><a href="about.html">About</a></li>
<li><a href="contact.html">Contact</a></li>
</ul>
</nav>
</header>

<section>
<div class="success-container">
<div class="success-header">
<div class="success-badge">✔ Application Submitted</div>
<h1>Application Submitted Successfully!</h1>
<p>Thank you, <?= $app['full_name'] ?>, for applying through CAREER CONNECT.</p>
</div>

<div class="success-card">
<h3>Applicant Details</h3>
<div class="detail-row">
<div class="detail-item"><strong>Name</strong><span><?= $app['full_name'] ?></span></div>
<div class="detail-item"><strong>Email</strong><span><?= $app['email'] ?></span></div>
<div class="detail-item"><strong>Mobile</strong><span><?= $app['mobile'] ?></span></div>
<div class="detail-item"><strong>City</strong><span><?= $app['city'] ?></span></div>
<div class="detail-item"><strong>State</strong><span><?= $app['state'] ?></span></div>
</div>
</div>

<div class="success-card">
<h3>Education Details</h3>
<div class="detail-row">
<div class="detail-item"><strong>College</strong><span><?= $app['college'] ?></span></div>
<div class="detail-item"><strong>University</strong><span><?= $app['university'] ?></span></div>
<div class="detail-item"><strong>Degree</strong><span><?= $app['degree'] ?></span></div>
<div class="detail-item"><strong>Branch</strong><span><?= $app['branch'] ?></span></div>
<div class="detail-item"><strong>Semester</strong><span><?= $app['semester'] ?></span></div>
<div class="detail-item"><strong>Graduation Year</strong><span><?= $app['graduation_year'] ?></span></div>
<div class="detail-item"><strong>CGPA</strong><span><?= $app['cgpa'] ?></span></div>
</div>
</div>

<div class="success-card">
<h3>Internship Details</h3>
<div class="detail-row">
<div class="detail-item"><strong>Position</strong><span><?= $app['position'] ?></span></div>
<div class="detail-item"><strong>Work Mode</strong><span><?= $app['work_mode'] ?></span></div>
<div class="detail-item"><strong>Technical Skills</strong><span><?= $app['technical_skills'] ?></span></div>
<div class="detail-item"><strong>Languages</strong><span><?= $app['languages'] ?></span></div>
<div class="detail-item" style="flex:1 1 100%;"><strong>Projects</strong><span><?= $app['projects'] ?></span></div>
<div class="detail-item" style="flex:1 1 100%;"><strong>Why Select You</strong><span><?= nl2br($app['why_select']) ?></span></div>
<div class="detail-item"><strong>Resume</strong><span><?= empty($app['resume_original']) ? 'None uploaded' : $app['resume_original'] ?></span></div>
<div class="detail-item"><strong>Declaration</strong><span><?= $app['declaration'] ?></span></div>
</div>
</div>

<div class="success-card">
<h3>Application Reference</h3>
<div class="detail-row">
<div class="detail-item" style="flex:1 1 100%;"><strong>Reference Number</strong><span class="reference-number"><?= $app['reference'] ?></span></div>
<div class="detail-item"><strong>Submitted At</strong><span><?= $app['submitted_at'] ?></span></div>
</div>
<p style="font-size:0.875rem;color:var(--slate);margin-top:1rem;">Please save this reference number. This is a demo — applications do not reach real companies.</p>
</div>

<div class="action-group">
<button class="btn-print" onclick="window.print()">Print Application</button>
<a href="index.html" class="btn btn-outline">Back to Home</a>
</div>
</div>
</section>

<footer>
<div class="container">
<p>&copy; 2026 CAREER CONNECT – Internship Application Portal. Academic Demonstration Project.</p>
<p>No personal data or resumes are stored permanently.</p>
</div>
</footer>

</body>
</html>