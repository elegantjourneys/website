const priceDowndown = document.getElementById("priceDropdown");
const fourthAccordion = document.getElementById("collapseFour");

if (priceDowndown) {
  priceDowndown.addEventListener("click", (e) => {
    e.preventDefault();
    fourthAccordion.classList.add("show");
  });
}

function customCss() {
  const properties = {
    mr: "margin-right",
    ml: "margin-left",
    mt: "margin-top",
    mBottom: "margin-bottom",
    pr: "padding-right",
    pl: "padding-left",
    pt: "padding-top",
    pb: "padding-bottom",
    left: "left",
    right: "right",
    top: "top",
    bottom: "bottom",
    bgC: "background-color",
    width: "width",
    minWidth: "min-width",
    maxWidth: "max-width",
    height: "height",
    fontSize: "font-size",
    cursor: "cursor",
    color: "color",
  };

  document.querySelectorAll('[class*="["][class*="]"]').forEach((el) => {
    el.className.split(" ").forEach((cls) => {
      const match = cls.match(/(\w+)-\[(.*?)\]/);
      if (match && properties[match[1]]) {
        el.style[properties[match[1]]] = match[2];
      }
    });
  });
}
customCss();

function moveReviewCards(direction) {
  const reviewContainer = document.getElementById("reviewContainer");
  const reviewCard = document.getElementById("reviewCard");

  const cardWidth = reviewCard.offsetWidth;

  if (direction === "left") {
    reviewContainer.scrollTo({
      left: reviewContainer.scrollLeft - cardWidth, // Move left
      behavior: "smooth",
    });
  } else {
    reviewContainer.scrollTo({
      left: reviewContainer.scrollLeft + cardWidth, // Move right
      behavior: "smooth",
    });
  }
}

function moveHotelCards(direction) {
  const hotelContainer = document.getElementById("hotelContainer");
  const hotelCard = document.getElementById("hotelCard");

  const cardWidth = hotelCard.offsetWidth;

  if (direction === "left") {
    hotelContainer.scrollTo({
      left: hotelContainer.scrollLeft - cardWidth, // Move left
      behavior: "smooth",
    });
  } else {
    hotelContainer.scrollTo({
      left: hotelContainer.scrollLeft + cardWidth, // Move right
      behavior: "smooth",
    });
  }
}
/*
function showChildCount(count, i) {
  const childCount = count.value;
  childContainer = document.getElementById(`childContainer${i}`);

  childContainer.innerHTML = "";

  for (let i = 1; i <= childCount; i++) {
    const childDropdown = `<div class="col-4">
    <label for="child${i}" class="form-label">Child ${i} Age</label>
    <select class="form-select" id="child${i}" name="child${i}Age">
    <option selected>--select--</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    </select>
    </div>`;
    childContainer.innerHTML += childDropdown;
  }
}

var roomCount = 2;
var childContainerCount = 2;
function addRooms(e) {
  // e.preventDefault();

  var roomContainer = document.getElementById("roomContainer");
  const roomTemplate = document.getElementById("roomTemplate");
  const roomClone = roomTemplate.cloneNode(true);

  const span = roomClone.querySelector("span");
  span.innerHTML = `Room ${roomCount}`;
  span.innerHTML += `<i class="ri-delete-bin-line" style=" color: rgb(222, 17, 17); font-size: 15px; cursor: pointer;" onclick="removeRoom(this)"></i>`;
  roomCount++;

  const childContainer = roomClone.querySelector("#childContainer1");
  const childs = roomClone.querySelector("#childs");
  childs.setAttribute(
    "onchange",
    `showChildCount(this, ${childContainerCount});`
  );
  childContainer.id = `childContainer${childContainerCount}`;
  childContainerCount++;

  roomContainer.appendChild(roomClone);
}

function removeRoom(event) {
  event.parentElement.parentElement.remove();
  roomCount--;
}
*/
function loadComponent(component, placeholderId) {
  fetch(`components/${component}.html`)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById(placeholderId).innerHTML = data;
    })
    .catch((error) => {
      console.error();
    });
}

//loadComponent("form", "form-placeholder");
//loadComponent("reviews", "reviews-placeholder");

function openReviewModal(el) {
  const name = el.dataset.name;
  const location = el.dataset.location;
  const image = el.dataset.image;
  const rating = parseFloat(el.dataset.rating);
  const title = el.dataset.title;
  const review = el.dataset.review;

  // Fill modal content
  document.getElementById("modalImg").src = image;
  document.getElementById("modalName").textContent = name;
  document.getElementById("modalLocation").textContent = location;
  document.getElementById("modalTitle").textContent = title;
  document.getElementById("modalReview").textContent = review;

  // Fill stars
  const starContainer = document.getElementById("modalStars");
  starContainer.innerHTML = ""; // Clear previous

  const fullStars = Math.floor(rating);
  const halfStar = rating % 1 >= 0.5;

  for (let i = 0; i < fullStars; i++) {
    starContainer.innerHTML +=
      '<li><i class="fas fa-star fa-sm text-teal"></i></li>';
  }
  if (halfStar) {
    starContainer.innerHTML +=
      '<li><i class="fas fa-star-half-alt fa-sm text-teal"></i></li>';
  }
}

if (document.getElementById("reviewModal")) {
  document
    .getElementById("reviewModal")
    .addEventListener("show.bs.modal", (e) => {
      const name = e.relatedTarget.dataset.name;
      const location = e.relatedTarget.dataset.location;
      const image = e.relatedTarget.dataset.image;
      const rating = parseFloat(e.relatedTarget.dataset.rating);
      const title = e.relatedTarget.dataset.title;
      const review = e.relatedTarget.dataset.review;

      console.log(e);

      // Fill modal content
      document.getElementById("modalImg").src = image;
      document.getElementById("modalName").textContent = name;
      document.getElementById("modalLocation").textContent = location;
      document.getElementById("modalTitle").textContent = title;
      document.getElementById("modalReview").textContent = review;

      // Fill stars
      const starContainer = document.getElementById("modalStars");
      starContainer.innerHTML = ""; // Clear previous

      const fullStars = Math.floor(rating);
      const halfStar = rating % 1 >= 0.5;

      for (let i = 0; i < fullStars; i++) {
        starContainer.innerHTML +=
          '<li><i class="fas fa-star fa-sm text-teal"></i></li>';
      }
      if (halfStar) {
        starContainer.innerHTML +=
          '<li><i class="fas fa-star-half-alt fa-sm text-teal"></i></li>';
      }
    });
}

if (document.getElementById("nestedAccordion")) {
  document
    .getElementById("nestedAccordion")
    .addEventListener("click", function (e) {
      console.log(e);
      const card = e.target.closest(".clickable-card");
      if (card) {
        const title = card.getAttribute("data-title");
        const content = card.getAttribute("data-content");

        // Set modal content
        document.getElementById("cardModalLabel").textContent = title;
        document.getElementById("cardModalBody").textContent = content;

        // Show modal using Bootstrap's JS API
        const modal = new bootstrap.Modal(document.getElementById("cardModal"));
        modal.show();
      }
    });
}

document.querySelectorAll(".cutomGroup .location-icon").forEach((icon) => {
  const image = icon.closest(".card").querySelector(".tour-image");

  icon.addEventListener("mouseenter", () => {
    const mapSrc = image.getAttribute("data-map");
    if (mapSrc) image.src = mapSrc;
  });

  icon.addEventListener("mouseleave", () => {
    const defaultSrc = image.getAttribute("data-default");
    if (defaultSrc) image.src = defaultSrc;
  });
});

function handleFormSubmit(formId, btn) {
  const form = document.getElementById(formId);

  form.addEventListener(
    "submit",
    (event) => {
      event.preventDefault();
      event.stopPropagation();

      if (form.checkValidity()) {
        btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        btn.disabled = true;

        const data = Object.fromEntries(new FormData(form).entries());
        console.log(data);

        setTimeout(() => {
          form.reset();
          form.classList.remove("was-validated");
          btn.innerHTML = "Submit";
          btn.disabled = false;
        }, 2000);
      }

      form.classList.add("was-validated");
    },
    { once: true }
  );
}
/*
function submitForm(btn) {
  const form = document.getElementById("myForm");

  const checkboxes = form.querySelectorAll('input[type="checkbox"]');
  const anyChecked = [...checkboxes].some((cb) => cb.checked);

  checkboxes.forEach((cb) => {
    cb.toggleAttribute("required", !anyChecked);
  });

  form.addEventListener(
    "submit",
    (event) => {
      event.preventDefault();
      event.stopPropagation();

      if (form.checkValidity()) {
        btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        btn.disabled = true;

        const data = Object.fromEntries(new FormData(form).entries());
        console.log(data);

        setTimeout(() => {
          form.reset();
          form.classList.remove("was-validated");

          btn.innerHTML = "Submit";
          btn.disabled = false;
        }, 2000);
      }

      form.classList.add("was-validated");
    },
    { once: true }
  ); // ensure this listener only runs once
}
*/
function submitContactUsForm(btn) {
  const form = document.getElementById("contactUsForm");

  form.addEventListener(
    "submit",
    (event) => {
      event.preventDefault();
      event.stopPropagation();

      if (form.checkValidity()) {
        btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        btn.disabled = true;

        const data = Object.fromEntries(new FormData(form).entries());
        console.log(data);

        setTimeout(() => {
          form.reset();
          form.classList.remove("was-validated");

          btn.innerHTML = "Submit";
          btn.disabled = false;
        }, 2000);
      }

      form.classList.add("was-validated");
    },
    { once: true }
  ); // ensure this listener only runs once
}

function submitReviewsForm(btn) {
  const form = document.getElementById("reviewsForm");

  form.addEventListener(
    "submit",
    (event) => {
      event.preventDefault();
      event.stopPropagation();

      if (form.checkValidity()) {
        btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        btn.disabled = true;

        const data = Object.fromEntries(new FormData(form).entries());
        console.log(data);

        setTimeout(() => {
          form.reset();
          form.classList.remove("was-validated");

          btn.innerHTML = "Submit";
          btn.disabled = false;
        }, 2000);
      }

      form.classList.add("was-validated");
    },
    { once: true }
  ); // ensure this listener only runs once
}

document.querySelectorAll('a[href^="#"]').forEach((link) => {
  link.addEventListener("click", function (e) {
    const targetId = this.getAttribute("href").substring(1);

    const target = document.getElementById(targetId);
    if (target) {
      // target.scrollIntoView({ behavior: "smooth" });
      const offset = 150;
      const elementPosition =
        target.getBoundingClientRect().top + window.pageYOffset;
      window.scrollTo({
        top: elementPosition - offset,
        behavior: "smooth",
      });

      e.preventDefault();
    }
  });
});
