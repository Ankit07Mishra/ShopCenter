// ===== Toast notification system =====
function showToast(message, duration = 3000) {
  const toast = document.createElement("div");
  toast.className = "toast";
  toast.innerText = message;
  document.body.appendChild(toast);

  setTimeout(() => toast.classList.add("show"), 100);

  setTimeout(() => {
    toast.classList.remove("show");
    setTimeout(() => toast.remove(), 400);
  }, duration);
}

// ===== DOM Ready =====
document.addEventListener("DOMContentLoaded", () => {
  // Product Buy Buttons
  document.querySelectorAll(".product form").forEach(form => {
    const btn = form.querySelector("button");
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      showToast("✅ Item added to cart!");
      setTimeout(() => form.submit(), 1000); // Submit after feedback
    });
  });

  // Contact form handling (demo only)
  const contactForm = document.querySelector(".container form");
  if(contactForm && contactForm.querySelector("textarea")) {
    contactForm.addEventListener("submit", (e) => {
      e.preventDefault();
      showToast("📩 Message sent successfully!");
      contactForm.reset();
    });
  }

  // Login/Register form success message (demo only)
  const authForm = document.querySelector(".login-form form, .register-form form");
  if(authForm) {
    authForm.addEventListener("submit", (e) => {
      e.preventDefault();
      showToast("🔐 Authentication request sent!");
      setTimeout(() => authForm.submit(), 1200);
    });
  }
});
