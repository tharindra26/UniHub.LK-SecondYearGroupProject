function startTypewriterAnimation() {
    const captionElement = document.getElementById('typewriter-caption');
    const lines = [
        "Unlocking Opportunities, Fostering Connections,",
        "and Elevating Education for a Brighter Future"
    ];

    let lineIndex = 0;

    function typeLine() {
        let i = 0;
        function typeCharacter() {
            if (i < lines[lineIndex].length) {
                captionElement.innerHTML += lines[lineIndex].charAt(i);
                i++;
                setTimeout(typeCharacter, 50); // Adjust the speed of the typewriter effect here (in milliseconds)
            } else {
                // Line typed, move to the next line or restart if the last line
                lineIndex = (lineIndex + 1) % lines.length;
                setTimeout(erase, 1000); // Adjust the time before erasing (in milliseconds)
            }
        }

        function erase() {
            let textLength = captionElement.innerText.length;
            if (textLength > 0) {
                captionElement.innerText = lines[lineIndex].substring(0, textLength - 1);
                setTimeout(erase, 30); // Adjust the speed of erasing (in milliseconds)
            } else {
                // Start typing the next line
                setTimeout(typeLine, 500); // Adjust the delay before typing the next line (in milliseconds)
            }
        }

        // Start typing the line
        typeCharacter();
    }

    // Start the typewriter animation when the page loads
    setTimeout(startTypewriterAnimation, 1000); // Adjust the initial delay before starting (in milliseconds)
}

// Start the typewriter animation when the page loads
document.addEventListener('DOMContentLoaded', startTypewriterAnimation);

let subMenuWrap= document.getElementById("sub-menu-wrap");

function toggleMenu(){
    subMenuWrap.classList.toggle("open-menu");
}
