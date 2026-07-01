const priceDowndown = document.getElementById("priceDropdown");
const fourthAccordion = document.getElementById("collapseFour");

if (priceDowndown) {
  priceDowndown.addEventListener("click", (e) => {
    e.preventDefault();
    // fourthAccordion.classList.add("show");
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
  e.preventDefault();

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

function loadComponent(component, placeholderId) {
  fetch(`components/${component}.html`)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById(placeholderId).innerHTML = data;
    })
    .catch((error) => {
      console.error(`Error loading ${component}:`, error);
    });
}
//loadComponent("form", "form-placeholder");
//loadComponent("reviews", "reviews-placeholder");

function loadPopularTourCard() {
  var tourDetails = [
    {
      id: 1,
      headings: "3 Day Golden Triangle Tour",
      tourCode: "GT-322",
      totalNights: 2,
      places: "Delhi → Agra → Jaipur",
      price: "14,411",
      image: "assets/images/3DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 2,
      headings: "4 Day Golden Triangle Tour",
      tourCode: "GT-323",
      totalNights: 3,
      places: "Delhi → Agra → Jaipur",
      price: "25,388",
      image: "assets/images/4DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 3,
      headings: "5 Day Golden Triangle Tour",
      tourCode: "GT-189",
      totalNights: 4,
      places: "Delhi → Jaipur → Agra",
      price: "34,411",
      image: "assets/images/5DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 4,
      headings: "6 Day Golden Triangle Tour ",
      tourCode: "GT-190",
      totalNights: 5,
      places: "Delhi → Agra → Jaipur",
      price: "38,900",
      image: "assets/images/6DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 5,
      headings: "7 Day Golden Triangle Tour",
      tourCode: "GT-193",
      totalNights: 6,
      places: "Delhi → Agra → Jaipur",
      price: "44,411",
      image: "assets/images/7DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 6,
      headings: "8 Day Golden Triangle Tour",
      tourCode: "GT-195",
      totalNights: 7,
      places: "Delhi → Agra → Jaipur → Udaipur",
      price: "48,781",
      image: "assets/images/8DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 7,
      headings: "8 Day Golden Triangle with Ranthambore Wildlife",
      tourCode: "GT-194",
      totalNights: 7,
      places: "Delhi → Agra → Ranthambore → Jaipur",
      price: "50,411",
      image: "assets/images/8WildlifeDayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 8,
      headings: "9 Day Golden Triangle with Varanasi",
      tourCode: "GT-264",
      totalNights: 8,
      places: "Delhi → Varanasi → Agra → Jaipur",
      price: "52,200",
      image: "assets/images/9DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 9,
      headings: "10 Day Golden Triangle with Jodhpur & Udaipur",
      tourCode: "GT-269",
      totalNights: 9,
      places: "Delhi → Agra → Jaipur → Jodhpur → Udaipur",
      price: "54,411",
      image: "assets/images/10DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 10,
      headings: "10 Day Golden Triangle with Ranthambore & Udaipur",
      tourCode: "GT-204",
      totalNights: 9,
      places: "Delhi → Agra → Ranthambore → Jaipur → Udaipur",
      price: "59,519",
      image: "assets/images/10DayTour1.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 11,
      headings: "11 Day Golden Triangle With Varanasi & Ranthambore Wildlife",
      tourCode: "GT-266",
      totalNights: 10,
      places: "Delhi → Varanasi → Agra → Ranthambore → Jaipur",
      price: "64,111",
      image: "assets/images/11DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 12,
      headings: "11 Day Golden Triangle With Varanasi & Udaipur",
      tourCode: "GT-265",
      totalNights: 10,
      places: "Delhi → Varanasi → Agra → Jaipur → Udaipur",
      price: "68,501",
      image: "assets/images/11DayTour1.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 13,
      headings: "12 Day Rajasthan Tour with Ranthambore Wildlife",
      tourCode: "GT-270",
      totalNights: 11,
      places: "Delhi → Agra → Ranthambore → Jaipur → Jodhpur → Udaipur",
      price: "75,611",
      image: "assets/images/12DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 14,
      headings: "13 Day Rajasthan Tour with Varanasi",
      tourCode: "GT-272",
      totalNights: 12,
      places: "Delhi → Varanasi → Agra → Jaipur → Jodhpur → Udaipur",
      price: "78,301",
      image: "assets/images/13DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 15,
      headings: "13 Day Golden Triangle With Varanasi, Ranthambore ...",
      tourCode: "GT-267",
      totalNights: 12,
      places: "Delhi → Varanasi → Agra → Ranthambore → Jaipur → Udaipur",
      price: "82,211",
      image: "assets/images/13DayTour1.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 16,
      headings: "15 Day Rajasthan Tour with Varanasi & Ranthambore Wildlife",
      tourCode: "GT-273",
      totalNights: 14,
      places:
        "Delhi → Varanasi → Agra → Ranthambore → Jaipur → Jodhpur → Udaipur",
      price: "85,411",
      image: "assets/images/15DayTour.jpg",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
  ];

  const dropdownItems = document.querySelectorAll(".dropdown-item");
  var resultShowing = document.getElementById("resultsShowing");
  if (resultShowing) {
    resultShowing.innerHTML = "";
    resultShowing.innerHTML = "Showing " + tourDetails.length + " results";
  }

  dropdownItems.forEach((item) => {
    item.addEventListener("click", function () {
      const selectedValue = this.textContent.trim();

      let filterDetails;

      if (selectedValue === "1 to 3 Days") {
        filterDetails = tourDetails.filter((data) => data.totalNights < 3);
      } else if (selectedValue === "4 to 7 Days") {
        filterDetails = tourDetails.filter(
          (data) => data.totalNights >= 3 && data.totalNights < 7
        );
      } else if (selectedValue === "8 to 15 Days") {
        filterDetails = tourDetails.filter(
          (data) => data.totalNights >= 7 && data.totalNights <= 15
        );
      }

      resultShowing.innerHTML = "Showing " + filterDetails.length + " results";

      displayTour(filterDetails);
    });
  });

  function displayTour(tourDetails) {
    const tourContainer = document.getElementById("tourContainer");
    tourContainer.innerHTML = "";

    if (tourContainer && tourDetails.length > 0) {
      tourDetails.forEach((tour) => {
        const card = document.createElement("div");
        card.className = "col-lg-4 col-md-6 mb-4";
        card.innerHTML = `
          <div class="card">
              <div class="position-relative">
                  <span
                    class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5"
                    >Private Tour</span
                  >
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img
                    src="${tour.image}"
                    class="card-img-top tour-image"
                    alt="${tour.headings}"
                    data-default="${tour.image}"
                    data-map="${tour.mapImage}"
                  />
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      ${tour.headings}
                    </p>
                    <span class="small text-secondary text-end col-3">${tour.totalNights} Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : ${tour.tourCode}</p>
                  <p class="small fw-regular m-0 text-secondary">
                    ${tour.places}
                  </p>
                  <div
                    class="d-flex align-items-center justify-content-between mt-3"
                  >
                    <h4 class="fw-semibold text-teal m-0">
                      ₹${tour.price} <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      `;
        tourContainer.appendChild(card);

        const tourImage = card.querySelector(".tour-image");
        const locationIcon = card.querySelector(".location-icon");

        // Add hover event listeners
        locationIcon.addEventListener("mouseover", () => {
          tourImage.src = tourImage.getAttribute("data-map"); // Change to map image
        });

        locationIcon.addEventListener("mouseout", () => {
          tourImage.src = tourImage.getAttribute("data-default"); // Revert to original image
        });
      });
    } else {
      tourContainer.innerHTML = "<p>No tours found for this selection.</p>";
    }
  }
  displayTour(tourDetails);
}
//loadPopularTourCard();

function loadLuxuryTourCard() {
  var tourDetails = [
    // {
    //   id: 1,
    //   headings: "3 Day Golden Triangle Tour",
    //   tourCode: "GT-322",
    //   totalNights: 2,
    //   places: "Delhi → Agra → Jaipur",
    //   price: "14,411",
    //   image: "assets/images/3DayTour.png",
    //   mapImage: "assets/images/delhi-jaipur.jpg",
    // },
    // {
    //   id: 2,
    //   headings: "4 Day Golden Triangle Tour",
    //   tourCode: "GT-323",
    //   totalNights: 3,
    //   places: "Delhi → Agra → Jaipur",
    //   price: "25,388",
    //   image: "assets/images/4DayTour.png",
    //   mapImage: "assets/images/delhi-jaipur.jpg",
    // },
    // {
    //   id: 3,
    //   headings: "5 Day Golden Triangle Tour",
    //   tourCode: "GT-189",
    //   totalNights: 4,
    //   places: "Delhi → Jaipur → Agra",
    //   price: "34,411",
    //   image: "assets/images/5DayTour.png",
    //   mapImage: "assets/images/delhi-jaipur.jpg",
    // },
    // {
    //   id: 4,
    //   headings: "6 Day Golden Triangle Tour ",
    //   tourCode: "GT-190",
    //   totalNights: 5,
    //   places: "Delhi → Agra → Jaipur",
    //   price: "38,900",
    //   image: "assets/images/6DayTour.png",
    //   mapImage: "assets/images/delhi-jaipur.jpg",
    // },
    {
      id: 5,
      headings: "7 Day Golden Triangle Tour",
      tourCode: "GT-193",
      totalNights: 6,
      places: "Delhi → Agra → Jaipur",
      price: "44,411",
      image: "assets/images/7DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 6,
      headings: "8 Day Golden Triangle Tour",
      tourCode: "GT-195",
      totalNights: 7,
      places: "Delhi → Agra → Jaipur → Udaipur",
      price: "48,781",
      image: "assets/images/8DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 7,
      headings: "8 Day Golden Triangle with Ranthambore Wildlife",
      tourCode: "GT-194",
      totalNights: 7,
      places: "Delhi → Agra → Ranthambore → Jaipur",
      price: "50,411",
      image: "assets/images/8WildlifeDayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 8,
      headings: "9 Day Golden Triangle with Varanasi",
      tourCode: "GT-264",
      totalNights: 8,
      places: "Delhi → Varanasi → Agra → Jaipur",
      price: "52,200",
      image: "assets/images/9DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 9,
      headings: "10 Day Golden Triangle with Jodhpur & Udaipur",
      tourCode: "GT-269",
      totalNights: 9,
      places: "Delhi → Agra → Jaipur → Jodhpur → Udaipur",
      price: "54,411",
      image: "assets/images/10DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 10,
      headings: "10 Day Golden Triangle with Ranthambore & Udaipur",
      tourCode: "GT-204",
      totalNights: 9,
      places: "Delhi → Agra → Ranthambore → Jaipur → Udaipur",
      price: "59,519",
      image: "assets/images/10DayTour1.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 11,
      headings: "11 Day Golden Triangle With Varanasi & Ranthambore Wildlife",
      tourCode: "GT-266",
      totalNights: 10,
      places: "Delhi → Varanasi → Agra → Ranthambore → Jaipur",
      price: "64,111",
      image: "assets/images/11DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 12,
      headings: "11 Day Golden Triangle With Varanasi & Udaipur",
      tourCode: "GT-265",
      totalNights: 10,
      places: "Delhi → Varanasi → Agra → Jaipur → Udaipur",
      price: "68,501",
      image: "assets/images/11DayTour1.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 13,
      headings: "12 Day Rajasthan Tour with Ranthambore Wildlife",
      tourCode: "GT-270",
      totalNights: 11,
      places: "Delhi → Agra → Ranthambore → Jaipur → Jodhpur → Udaipur",
      price: "75,611",
      image: "assets/images/12DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 14,
      headings: "13 Day Rajasthan Tour with Varanasi",
      tourCode: "GT-272",
      totalNights: 12,
      places: "Delhi → Varanasi → Agra → Jaipur → Jodhpur → Udaipur",
      price: "78,301",
      image: "assets/images/13DayTour.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 15,
      headings: "13 Day Golden Triangle With Varanasi, Ranthambore ...",
      tourCode: "GT-267",
      totalNights: 12,
      places: "Delhi → Varanasi → Agra → Ranthambore → Jaipur → Udaipur",
      price: "82,211",
      image: "assets/images/13DayTour1.png",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
    {
      id: 16,
      headings: "15 Day Rajasthan Tour with Varanasi & Ranthambore Wildlife",
      tourCode: "GT-273",
      totalNights: 14,
      places:
        "Delhi → Varanasi → Agra → Ranthambore → Jaipur → Jodhpur → Udaipur",
      price: "85,411",
      image: "assets/images/15DayTour.jpg",
      mapImage: "assets/images/delhi-jaipur.jpg",
    },
  ];

  const dropdownItems = document.querySelectorAll(".dropdown-item");
  var resultShowing = document.getElementById("resultShowing");
  if (resultShowing) {
    resultShowing.innerHTML = "";
    resultShowing.innerHTML = "Showing " + tourDetails.length + " results";
  }

  dropdownItems.forEach((item) => {
    item.addEventListener("click", function () {
      const selectedValue = this.textContent.trim();

      let filterDetails;

      if (selectedValue === "1 to 3 Days") {
        filterDetails = tourDetails.filter((data) => data.totalNights <= 3);
      } else if (selectedValue === "4 to 7 Days") {
        filterDetails = tourDetails.filter(
          (data) => data.totalNights >= 3 && data.totalNights < 7
        );
      } else if (selectedValue === "8 to 15 Days") {
        filterDetails = tourDetails.filter(
          (data) => data.totalNights >= 7 && data.totalNights < 15
        );
      }

      resultShowing.innerHTML = "Showing " + filterDetails.length + " results";

      displayTour(filterDetails);
    });
  });

  function displayTour(tourDetails) {
    const tourContainer = document.getElementById("luxuryTourContainer");
    tourContainer.innerHTML = "";

    if (tourContainer && tourDetails.length > 0) {
      tourDetails.forEach((tour) => {
        const card = document.createElement("div");
        card.className = "col-lg-4 col-md-6 mb-4";
        card.innerHTML = `
          <div class="card">
              <div class="position-relative">
                  <span
                    class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5"
                    >Private Tour</span
                  >
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img
                    src="${tour.image}"
                    class="card-img-top tour-image"
                    alt="${tour.headings}"
                    data-default="${tour.image}"
                    data-map="${tour.mapImage}"
                  />
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      ${tour.headings}
                    </p>
                    <span class="small text-secondary text-end col-3">${tour.totalNights} Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : ${tour.tourCode}</p>
                  <p class="small fw-regular m-0 text-secondary">
                    ${tour.places}
                  </p>
                  <div
                    class="d-flex align-items-center justify-content-between mt-3"
                  >
                    <h4 class="fw-semibold text-teal m-0">
                      ₹${tour.price} <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      `;
        tourContainer.appendChild(card);

        const tourImage = card.querySelector(".tour-image");
        const locationIcon = card.querySelector(".location-icon");

        // Add hover event listeners
        locationIcon.addEventListener("mouseover", () => {
          tourImage.src = tourImage.getAttribute("data-map"); // Change to map image
        });

        locationIcon.addEventListener("mouseout", () => {
          tourImage.src = tourImage.getAttribute("data-default"); // Revert to original image
        });
      });
    } else {
      tourContainer.innerHTML = "<p>No tours found for this selection.</p>";
    }
  }
  displayTour(tourDetails);
}
//loadLuxuryTourCard();

// generalized modal functiopn
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

function handleFormSubmit(formId, btn, onSubmit) {
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
        if (typeof onSubmit === "function") onSubmit(data);

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

function submitForm(btn) {
  const form = document.getElementById("myForm");
  const checkboxes = form.querySelectorAll('input[type="checkbox"]');
  const anyChecked = [...checkboxes].some((cb) => cb.checked);

  checkboxes.forEach((cb) => (cb.required = !anyChecked));

  handleFormSubmit("myForm", btn);
}

function submitContactUsForm(btn) {
  handleFormSubmit("contactUsForm", btn);
}

function submitReviewsForm(btn) {
  handleFormSubmit("reviewsForm", btn);
}

// function submitForm(btn) {
//   const form = document.getElementById("myForm");

//   const checkboxes = form.querySelectorAll('input[type="checkbox"]');
//   const anyChecked = [...checkboxes].some((cb) => cb.checked);

//   checkboxes.forEach((cb) => {
//     cb.toggleAttribute("required", !anyChecked);
//   });

//   form.addEventListener(
//     "submit",
//     (event) => {
//       event.preventDefault();
//       event.stopPropagation();

//       if (form.checkValidity()) {
//         btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
//         btn.disabled = true;

//         const data = Object.fromEntries(new FormData(form).entries());
//         console.log(data);

//         setTimeout(() => {
//           form.reset();
//           form.classList.remove("was-validated");

//           btn.innerHTML = "Submit";
//           btn.disabled = false;
//         }, 2000);
//       }

//       form.classList.add("was-validated");
//     },
//     { once: true }
//   ); // ensure this listener only runs once
// }

// function submitContactUsForm(btn) {
//   const form = document.getElementById("contactUsForm");

//   form.addEventListener(
//     "submit",
//     (event) => {
//       event.preventDefault();
//       event.stopPropagation();

//       if (form.checkValidity()) {
//         btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
//         btn.disabled = true;

//         const data = Object.fromEntries(new FormData(form).entries());
//         console.log(data);

//         setTimeout(() => {
//           form.reset();
//           form.classList.remove("was-validated");

//           btn.innerHTML = "Submit";
//           btn.disabled = false;
//         }, 2000);
//       }

//       form.classList.add("was-validated");
//     },
//     { once: true }
//   ); // ensure this listener only runs once
// }

// function submitReviewsForm(btn) {
//   const form = document.getElementById("reviewsForm");

//   form.addEventListener(
//     "submit",
//     (event) => {
//       event.preventDefault();
//       event.stopPropagation();

//       if (form.checkValidity()) {
//         btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
//         btn.disabled = true;

//         const data = Object.fromEntries(new FormData(form).entries());
//         console.log(data);

//         setTimeout(() => {
//           form.reset();
//           form.classList.remove("was-validated");

//           btn.innerHTML = "Submit";
//           btn.disabled = false;
//         }, 2000);
//       }

//       form.classList.add("was-validated");
//     },
//     { once: true }
//   ); // ensure this listener only runs once
// }

document.addEventListener("DOMContentLoaded", function() {
    const bottomStrip = document.querySelector('.bottom-strip');
    const footerPayment = document.getElementById('footer-payment');

    if (footerPayment) {
        if (bottomStrip) {
            footerPayment.classList.add('mb-75');
        } else {
            footerPayment.classList.remove('mb-75');
        }
    }
});
