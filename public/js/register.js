const optionMenu = document.querySelector(".drop-down"),
      slectBtn = optionMenu.querySelector(".selected"),
      options = optionMenu.querySelectorAll(".option"),
      sBtn_text = optionMenu.querySelector(".btn-text"),
      universityInput = document.getElementById("universityInput");

slectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));

options.forEach(option => {
    option.addEventListener("click", () => {
        let selectedOption = option.querySelector(".option-text").innerText;
        sBtn_text.innerText = selectedOption;
        universityInput.value = selectedOption; // Set the value of the hidden input field
        

        optionMenu.classList.remove("active");
    });
})

