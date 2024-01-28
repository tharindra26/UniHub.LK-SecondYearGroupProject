// Option menu active class
const optionMenuItems = document.querySelectorAll('.option-menu a');

optionMenuItems.forEach(item => {
    item.addEventListener("click", function(event) {
        console.log("Click");
        // Prevent the default behavior of the link (e.g., preventing page reload)
        event.preventDefault();

        // Remove "active" class from all items
        optionMenuItems.forEach(menuItem => {
            menuItem.classList.remove('active');
        });

        // Add "active" class to the clicked item
        this.classList.add('active');
    });
});
