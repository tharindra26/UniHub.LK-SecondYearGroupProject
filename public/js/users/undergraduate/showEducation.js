const overlay = document.querySelector(".overlay");
const modalBox = document.querySelector(".modal-box");

function openPopup(edu_id) {
  let element = document.getElementById(edu_id);
  if (element) {
    element.classList.add("active");
    overlay.classList.add("active");
  }
}

function closePopup(edu_id) {
  let element = document.getElementById(edu_id);
  if (element) {
    element.classList.remove("active");
    overlay.classList.remove("active");
  }
}
overlay.addEventListener("click", () => {
  modalBox.classList.remove("active");
  overlay.classList.remove("active");
});