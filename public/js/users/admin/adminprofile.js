// Option menu active class
const body = document.querySelector("body"),
    optionMenuItems = body.querySelectorAll('.option-menu a');
    sidebar = body.querySelector("menu");
    sidebarToggle = body.querySelector(".sidebar-toggle");
    sidebarClose = body.querySelector(".sidebar-close");

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

//side bar toggle
sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
})

sidebarClose.addEventListener("click", () => {
    sidebar.classList.toggle("close");
})
