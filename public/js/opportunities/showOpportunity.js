// Event listener for the calendar icon
document.getElementById("add-to-calendar").addEventListener("click", function() {
    // Constructing Google Calendar URL
    var eventTitle = encodeURIComponent("GitHub Innovation Pitch"); // Encode event title
    var eventStartTime = "20240312T053000"; // Format: YYYYMMDDTHHMMSS
    var eventEndTime = "20240312T063000"; // Format: YYYYMMDDTHHMMSS

    // Google Calendar URL with pre-filled event details
    var googleCalendarUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE&text=" + eventTitle + "&dates=" + eventStartTime + "/" + eventEndTime;

    // Open the Google Calendar URL in a new tab
    window.open(googleCalendarUrl, "_blank");
});