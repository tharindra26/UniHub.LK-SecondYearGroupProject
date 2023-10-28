window.onload = function () {
    var eventCards = document.querySelectorAll('.event-card');

    setTimeout(function () {
        eventCards.forEach(function (card, index) {
            card.classList.add('show');
        });
    }, 100);
};