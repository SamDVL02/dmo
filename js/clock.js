function updateClock() {
    // Get the current time
    const now = new Date();
    
    // Add one hour
    const adjustedTime = new Date(now.getTime() + 60 * 60 * 1000); // 60 minutes * 60 seconds * 1000 milliseconds

    // Define options for formatting
    const options = {
        timeZone: 'Africa/Nairobi', // Time Zone for display
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    };
    
    // Format the adjusted time
    const formatter = new Intl.DateTimeFormat('en-US', options);
    const timeString = formatter.format(adjustedTime);

    // Display the adjusted time
    document.getElementById('clock').textContent = timeString;
}

// Update the clock every second
setInterval(updateClock, 1000);

// Initial call to display the time immediately
updateClock();
