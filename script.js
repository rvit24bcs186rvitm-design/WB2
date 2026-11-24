/* ============================================================
   CAREER CONNECT – Internship Application Portal
   Vanilla JavaScript + jQuery validation
   ============================================================ */

(function ($) {
  "use strict";

  function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function isValidMobile(mobile) {
    var mobileRegex = /^\d{10}$/;
    return mobileRegex.test(mobile);
  }

  function showError(field, message) {
    field.removeClass("error");
    var container = field.closest(".form-group, .file-group, .checkbox-group");
    container.find(".error-text").remove();
    if (message) {
      field.addClass("error");
      container.append('<span class="error-text show">' + message + "</span>");
    }
  }

  function clearErrors(form) {
    form.find(".error-text").remove();
    form.find(".error").removeClass("error");
  }

  function handleFormSubmit(form) {
    form.on("submit", function (e) {
      e.preventDefault();
      e.stopPropagation();

      clearErrors(form);
      var isValid = true;

      var requiredFields = [
        { name: "full_name", label: "Full Name" },
        { name: "dob", label: "Date of Birth" },
        { name: "email", label: "Email Address" },
        { name: "mobile", label: "Mobile Number" },
        { name: "city", label: "City" },
        { name: "state", label: "State" },
        { name: "college", label: "College Name" },
        { name: "university", label: "University" },
        { name: "degree", label: "Degree" },
        { name: "branch", label: "Branch / Department" },
        { name: "semester", label: "Current Semester" },
        { name: "graduation_year", label: "Graduation Year" },
        { name: "cgpa", label: "CGPA" },
        { name: "position", label: "Internship Position" },
        { name: "work_mode", label: "Preferred Work Mode" },
        { name: "technical_skills", label: "Technical Skills" },
        { name: "languages", label: "Programming Languages Known" },
        { name: "projects", label: "Previous Project Experience" },
        { name: "why_select", label: "Why should we select you?" }
      ];

      requiredFields.forEach(function (field) {
        var input = form.find("[name='" + field.name + "']");
        var val = $.trim(input.val());
        if (val === "") {
          showError(input, field.label + " is required.");
          isValid = false;
        }
      });

      var emailInput = form.find("[name='email']");
      var emailVal = $.trim(emailInput.val());
      if (emailVal !== "" && !isValidEmail(emailVal)) {
        showError(emailInput, "Please enter a valid email address.");
        isValid = false;
      }

      var mobileInput = form.find("[name='mobile']");
      var mobileVal = $.trim(mobileInput.val());
      if (mobileVal !== "" && !isValidMobile(mobileVal)) {
        showError(mobileInput, "Please enter a valid 10-digit mobile number.");
        isValid = false;
      }

      // Resume file validation
      var resumeInput = form.find("[name='resume']");
      var file = resumeInput.get(0).files && resumeInput.get(0).files[0];
      if (!file) {
        showError(resumeInput, "Please upload your resume (PDF, max 2 MB).");
        isValid = false;
      } else {
        var ext = file.name.split('.').pop().toLowerCase();
        if (ext !== 'pdf') {
          showError(resumeInput, "Only PDF files are allowed.");
          isValid = false;
        }
        if (file.size > 2 * 1024 * 1024) {
          showError(resumeInput, "Resume must not exceed 2 MB.");
          isValid = false;
        }
      }

      var declaration = form.find("[name='declaration']");
      if (!declaration.is(":checked")) {
        showError(declaration, "You must accept the declaration.");
        isValid = false;
      }

      if (!isValid) {
        form.find(".error").first().find("input, select, textarea, [type='file']").first().trigger("focus");
        return false;
      }

      form[0].submit();
    });
  }

  function initLiveValidation(form) {
    form.find("input, select, textarea").on("blur change", function () {
      var field = $(this);
      var name = field.attr("name");
      var val = $.trim(field.val());

      if (name === "email" && val !== "") {
        showError(field, isValidEmail(val) ? "" : "Please enter a valid email address.");
      }
      if (name === "mobile" && val !== "") {
        showError(field, isValidMobile(val) ? "" : "Please enter a valid 10-digit mobile number.");
      }
      if (name === "declaration") {
        showError(field, field.is(":checked") ? "" : "You must accept the declaration.");
      }
    });

    form.find("[name='resume']").on("change", function () {
      var field = $(this);
      var file = this.files && this.files[0];
      if (!file) {
        showError(field, "Please upload your resume (PDF, max 2 MB).");
      } else {
        var ext = file.name.split('.').pop().toLowerCase();
        var msg = "";
        if (ext !== 'pdf') msg = "Only PDF files are allowed.";
        else if (file.size > 2 * 1024 * 1024) msg = "Resume must not exceed 2 MB.";
        showError(field, msg);
      }
    });
  }

  $(document).ready(function () {
    var internshipForm = $("form#internship-form");
    if (internshipForm.length) {
      handleFormSubmit(internshipForm);
      initLiveValidation(internshipForm);
    }

    $(".btn-print").on("click", function () {
      window.print();
    });
  });
})(jQuery);