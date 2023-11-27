//Start About Section See more option
const parentContainer = document.querySelector('.about');

parentContainer.addEventListener('click', event => {
    const current = event.target;

    const isSeeMoreBtn = current.className.includes('see-more-btn');

    if(!isSeeMoreBtn) return;

    const currentText = event.target.parentNode.querySelector('.see-more-text');

    currentText.classList.toggle('see-more-text--show');

    current.textContent = current.textContent.includes('See more') ?
    "See less..." : "See more...";
})

// End About Section See more option