const optionMenu = document.querySelector(".drop-down"),
      slectBtn = optionMenu.querySelector(".selected"),
      options = optionMenu.querySelectorAll(".option"),
      sBtn_text = optionMenu.querySelector(".btn-text");

slectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));

options.forEach(option => {
    option.addEventListener("click", () => {
        let selectedOption = option.querySelector(".option-text").innerText;
        sBtn_text.innerText = selectedOption;
        

        optionMenu.classList.remove("active");
    });
})

