// Counter starts
    let value = document.querySelectorAll(".num");
    let timeinterval = 1000;
    
    value.forEach((valueDisplay) => {
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
