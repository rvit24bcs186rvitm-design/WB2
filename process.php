<?php
// CAREER CONNECT – Internship Application Portal
// process.php: handles form POST, validates data and resume upload,
// then redirects to success.php.
// Academic demonstration only — no data is stored in a database.

session_start();

// Ensure upload directory exists (outside web root is ideal; here it is
// protected by .gitignore and should not be served directly on production).
$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Helper: sanitize for safe output.
function sanitize($value) {
    if (is_array($value)) {
        return array_map('sanitize', $value);
    }
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// Collect submitted fields.
$application = [
    'full_name'       => sanitize($_POST['full_name']       ?? ''),
    'dob'             => sanitize($_POST['dob']             ?? ''),
    'email'           => sanitize($_POST['email']           ?? ''),
    'mobile'          => sanitize($_POST['mobile']          ?? ''),
    'city'            => sanitize($_POST['city']            ?? ''),
    'state'           => sanitize($_POST['state']           ?? ''),
    'college'         => sanitize($_POST['college']         ?? ''),
    'university'      => sanitize($_POST['university']      ?? ''),
    'degree'          => sanitize($_POST['degree']          ?? ''),
    'branch'          => sanitize($_POST['branch']          ?? ''),
    'semester'        => sanitize($_POST['semester']        ?? ''),
    'graduation_year' => sanitize($_POST['graduation_year'] ?? ''),
    'cgpa'            => sanitize($_POST['cgpa']            ?? ''),
    'position'        => sanitize($_POST['position']        ?? ''),
    'work_mode'       => sanitize($_POST['work_mode']       ?? ''),
    'technical_skills'=> sanitize($_POST['technical_skills']?? ''),
    'languages'       => sanitize($_POST['languages']       ?? ''),
    'projects'        => sanitize($_POST['projects']        ?? ''),
    'why_select'      => sanitize($_POST['why_select']      ?? ''),
    'declaration'     => !empty($_POST['declaration']) ? 'Accepted' : 'Not Accepted',
    'resume_name'     => '',
    'reference'       => 'CC-' . strtoupper(uniqid()),
    'submitted_at'    => date('Y-m-d H:i:s'),
];

// Server-side validation of required fields.
$required = [
    'full_name' => 'Full Name',
    'dob' => 'Date of Birth',
    'email' => 'Email Address',
    'mobile' => 'Mobile Number',
    'city' => 'City',
    'state' => 'State',
    'college' => 'College Name',
    'university' => 'University',
    'degree' => 'Degree',
    'branch' => 'Branch / Department',
    'semester' => 'Current Semester',
    'graduation_year' => 'Graduation Year',
    'cgpa' => 'CGPA',
    'position' => 'Internship Position',
    'work_mode' => 'Preferred Work Mode',
    'technical_skills' => 'Technical Skills',
    'languages' => 'Programming Languages Known',
    'projects' => 'Previous Project Experience',
    'why_select' => 'Why should we select you?',
    'declaration' => 'Declaration',
];
$missing = [];
foreach ($required as $field => $label) {
    if (trim($application[$field]) === '' || $application[$field] === 'Not Accepted') {
        $missing[] = $label;
    }
}

// Validate email format.
if (!empty($application['email']) && !filter_var($application['email'], FILTER_VALIDATE_EMAIL)) {
    $missing[] = 'valid Email Address';
}

// Validate 10-digit mobile number.
if (!empty($application['mobile']) && !preg_match('/^\d{10}$/', $application['mobile'])) {
    $missing[] = 'valid 10-digit Mobile Number';
}

// Resume file validation.
$resumeError = '';
$resumeName = '';
if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['resume'];
    $originalName = basename($file['name']);
    $fileSize = $file['size'];
    $fileTmp = $file['tmp_name'];

    // Allowed extension.
    $allowedExt = ['pdf'];
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt)) {
        $resumeError = 'Only PDF files are allowed.';
    }
    // Max size: 2 MB.
    elseif ($fileSize > 2 * 1024 * 1024) {
        $resumeError = 'Resume must not exceed 2 MB.';
    }
    // Mime type check (defence in depth).
    elseif (mime_content_type($fileTmp) !== 'application/pdf') {
        $resumeError = 'Invalid file type. Please upload a PDF.';
    }
    else {
        $resumeName = uniqid('resume_', true) . '.' . $ext;
        $destination = $uploadDir . '/' . $resumeName;
        if (!move_uploaded_file($fileTmp, $destination)) {
            $resumeError = 'Failed to save uploaded resume.';
        } else {
            $application['resume_name'] = $resumeName;
            $application['resume_original'] = sanitize($originalName);
        }
    }
} elseif (isset($_FILES['resume']) && $_FILES['resume']['error'] !== UPLOAD_ERR_NO_FILE) {
    $resumeError = 'Resume upload error.';
} else {
    $resumeError = 'Please upload your resume (PDF, max 2 MB).';
}

if ($resumeError) {
    $missing[] = $resumeError;
}

// If validation failed, go back to apply form with error.
if (!empty($missing)) {
    $_SESSION['apply_error'] = $missing;
    $_SESSION['apply_data'] = $_POST;
    header('Location: apply.html');
    exit;
}

// Store sanitized application in session and redirect to success page.
$_SESSION['application'] = $application;
header('Location: success.php');
exit;