// Counter starts
function initializeCount() {
    totalValue = document.querySelectorAll(".tot");
    let timeinterval = 200;

    totalValue.forEach((valueDisplay) => {
        let startValue = 0;
        let endValue = parseInt(valueDisplay.getAttribute("data-val"));
        let duration = Math.floor(timeinterval / endValue);
        let counter = setInterval(() => {
            startValue += 1;
            valueDisplay.textContent = startValue;
            if (startValue === endValue) {
                clearInterval(counter);
            }
        }, duration);
    });
}

initializeCount();


//main event filter
//Main Event filter



