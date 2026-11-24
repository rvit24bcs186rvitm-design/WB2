# CAREER CONNECT – Internship Application Portal

A complete, modern web application for an online internship application/registration portal, built with **HTML5, CSS3, JavaScript, jQuery, and PHP**. Developed as a Web Technology laboratory assignment.

> ⚠️ **Academic Demonstration Only** — This is a college lab project. It is not a real recruitment service, applications do not reach real companies, and no personal data or resumes are stored permanently.

## Project Structure

```
career-connect-internship-portal/
├── index.html          # Home page
├── internships.html    # Internship listing cards
├── apply.html          # Internship application form (+ resume upload)
├── about.html          # About page
├── contact.html        # Contact page
├── process.php         # PHP POST processing + file upload handling
├── success.php         # Success / result page
├── style.css           # Stylesheet (navy, white, orange, blue theme)
├── script.js           # Vanilla JS + jQuery form validation
├── uploads/            # Resume upload directory (not committed)
├── README.md           # This file
└── .gitignore          # Git ignore rules
```

## Features

- Professional UI with dark navy, white, orange, and blue accents
- Fully responsive layout (mobile, tablet, desktop)
- Navigation: Home, Internships, Apply, About, Contact
- Internship listing page with 5 role cards:
  - Web Development Intern
  - Python Developer Intern
  - Java Developer Intern
  - UI/UX Design Intern
  - Data Analytics Intern
- Apply Now buttons preselect the internship in the form via query string
- Application form with:
  - Personal Details
  - Educational Details
  - Internship Details
  - Resume upload (PDF only, max 2 MB)
  - Declaration checkbox
- Client-side validation using HTML5, Vanilla JavaScript, and jQuery:
  - Required field validation
  - Email format validation
  - 10-digit mobile number validation
  - Resume file type and size validation
  - Friendly inline error messages
- Server-side processing with PHP (`POST`, `multipart/form-data`)
- Server-side re-validation and PDF checks (extension, MIME type, size)
- Uploaded files stored in a protected `uploads/` directory with unique names
- Sanitized output using `htmlspecialchars`
- Success page with application details card layout
- Auto-generated application reference number
- Print Application button (JavaScript `window.print()`)
- Back to Home button
- No database storage (demo project)

## Technologies

- HTML5
- CSS3 (CSS Grid, Flexbox, responsive media queries)
- JavaScript (Vanilla)
- jQuery 3.7.1 (via CDN)
- PHP

## Local Setup

1. **Install a PHP server stack** such as XAMPP, WAMP, MAMP, or Laragon.
2. Place the `career-connect-internship-portal` folder inside your web server's document root (e.g., `htdocs` for XAMPP).
3. Ensure the `uploads/` folder exists and is writable by the web server.
4. Start Apache (and PHP) from the control panel.
5. Open your browser and navigate to:

   ```
   http://localhost/career-connect-internship-portal/index.html
   ```

6. Browse internships, click **Apply Now**, fill out the form, upload a PDF resume (max 2 MB), and submit.

> Note: `process.php` and `success.php` require a PHP interpreter. Opening them directly as files (`file://`) will show raw PHP code.

## Cloud Deployment (PHP-compatible hosting)

This project can be deployed on any cloud platform that supports PHP, such as:

- **000webhost** (free PHP hosting)
- **InfinityFree** (free PHP hosting)
- **Heroku** (with a PHP buildpack)
- **Render** (PHP support)
- **DigitalOcean App Platform / AWS / Azure** (PHP-enabled environments)

General deployment steps:

1. Upload all files (except `.git`, `node_modules`, and uploaded resumes) to your host's public directory.
2. Ensure the `uploads/` directory is writable by the web server.
3. Do **not** commit or upload real applicant resumes to version control.
4. Confirm the jQuery CDN link is reachable (internet access required).
5. Visit your domain's `index.html` and test the full application flow.

## Testing Checklist

- [ ] All pages load and navigation links work
- [ ] Internship cards display correctly
- [ ] Apply Now button preselects the correct position
- [ ] Form loads all sections (Personal, Educational, Internship, Additional)
- [ ] Valid submission (with PDF ≤ 2 MB) redirects to `success.php`
- [ ] Invalid email shows an error message
- [ ] Non-10-digit mobile number shows an error message
- [ ] Empty required fields are blocked with inline errors
- [ ] Non-PDF resume or file > 2 MB shows an error
- [ ] Declaration checkbox must be checked
- [ ] Success page displays all applicant, education, and internship details
- [ ] Resume filename and reference number are shown
- [ ] Print button opens the browser print dialog
- [ ] Back to Home button returns to `index.html`
- [ ] Pages render correctly on mobile and desktop

## Git

This folder is a standalone Git repository. Uploaded resumes and personal data must never be committed.

```
git init
git add .
git commit -m "Initial commit: CAREER CONNECT Internship Application Portal"
```

> Do not push to GitHub unless explicitly requested.

## License

MIT License – for academic demonstration purposes.