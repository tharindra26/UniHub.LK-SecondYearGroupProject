function showSideBar(){
    const sidebar= document.querySelector('.sidebar');
    sidebar.style.display= 'flex';
}

function hideSideBar(){
    const sidebar= document.querySelector('.sidebar');
    sidebar.style.display= 'none';
}

let subMenuWrap= document.getElementById("sub-menu-wrap");

function toggleMenu(){
    subMenuWrap.classList.toggle("open-menu");
}

let notificationList= document.getElementById("notification-list");

function toggleNotificationList(){
    notificationList.classList.toggle("open-menu");
}