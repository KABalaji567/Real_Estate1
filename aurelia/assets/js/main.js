(function () {
  const header = document.querySelector(".site-header");
  const toggle = document.querySelector(".nav-toggle");
  const panel = document.querySelector(".mobile-panel");
  const toast = document.querySelector(".toast");

  const onScroll = () => {
    if (!header) return;
    header.classList.toggle("scrolled", window.scrollY > 24);
  };
  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });

  if (toggle && panel) {
    toggle.addEventListener("click", () => panel.classList.toggle("open"));
  }

  document.querySelectorAll("[data-count]").forEach((el) => {
    const target = Number(el.getAttribute("data-count"));
    const suffix = el.getAttribute("data-suffix") || "";
    let current = 0;
    const step = Math.max(1, Math.ceil(target / 48));
    const tick = () => {
      current = Math.min(target, current + step);
      el.textContent = current + suffix;
      if (current < target) requestAnimationFrame(tick);
    };
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          tick();
          io.disconnect();
        }
      });
    });
    io.observe(el);
  });

  document.querySelectorAll(".faq-tab").forEach((tab) => {
    tab.addEventListener("click", () => {
      document.querySelectorAll(".faq-tab").forEach((t) => t.classList.remove("active"));
      document.querySelectorAll(".faq-panel").forEach((p) => p.classList.remove("active"));
      tab.classList.add("active");
      const panelEl = document.getElementById(tab.dataset.target);
      if (panelEl) panelEl.classList.add("active");
    });
  });

  document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      if (toast) {
        toast.textContent = form.dataset.success || "Thank you. An Aurelia advisor will contact you shortly.";
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 3200);
      }
      form.reset();
    });
  });

  const search = document.getElementById("property-search");
  if (search) {
    search.addEventListener("submit", (e) => {
      e.preventDefault();
      const targetSelector = search.dataset.filterTarget;
      if (!targetSelector) {
        window.location.href = "properties.html";
        return;
      }

      const filters = [...search.querySelectorAll("[data-filter]")].reduce((values, field) => {
        values[field.dataset.filter] = field.value;
        return values;
      }, {});
      const cards = document.querySelectorAll(targetSelector);
      let visible = 0;
      cards.forEach((card) => {
        const matchesType = !filters.type || card.dataset.type === filters.type;
        const matchesLocation = !filters.location || card.dataset.location === filters.location;
        const matchesBudget = !filters.budget || card.dataset.budget === filters.budget;
        const matches = matchesType && matchesLocation && matchesBudget;
        card.hidden = !matches;
        if (matches) visible += 1;
      });
      const status = document.querySelector(".search-status");
      if (status) {
        status.textContent = visible + (visible === 1 ? " project" : " projects") + " match your selection.";
      }
    });
  }
})();
