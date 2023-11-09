document.addEventListener('DOMContentLoaded', function() {
    const bellIcon = document.getElementById('bellIcon');
    const notificationContainer = document.getElementById('notificationContainer');
    const closeNotificationBtn = document.getElementById('closeNotification');

    // Function to show or hide the notification container
    function toggleNotificationContainer() {
        notificationContainer.style.display = notificationContainer.style.display === 'none' ? 'block' : 'none';
    }

    // Event listener to toggle the notification container on bell icon click
    bellIcon.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevents the click event from propagating
        toggleNotificationContainer();
    });

    // Event listener to close the notification container on close button click
    closeNotificationBtn.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevents the click event from propagating
        notificationContainer.style.display = 'none';
    });

    // Close the notification container when clicking outside the container
    window.addEventListener('click', function(event) {
        if (event.target !== bellIcon && event.target !== closeNotificationBtn) {
            notificationContainer.style.display = 'none';
        }
    });
});
