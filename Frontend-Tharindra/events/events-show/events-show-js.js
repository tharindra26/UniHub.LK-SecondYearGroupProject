const description= document.querySelector('.description');
description.addEventListener('click', event=>{
    const current = event.target;

    const isReadMoreBtn= current.className.includes('read-more-btn');

    if(!isReadMoreBtn) return;

    const currentText = event.target.parentNode.querySelector('.read-more-text');

    currentText.classList.toggle('read-more-text--show');
    console.log(currentText.textContent.includes("Read More"));
    current.textContent = currentText.classList.contains('read-more-text--show') ? "Read Less" : "Read More";
})