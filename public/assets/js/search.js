document.addEventListener('DOMContentLoaded', function() {
    // Get a reference to the "Loop" icon link.
    var searchIconLink = document.getElementById('searchIconLink');
    
    if (searchIconLink) {
        // Add a click event listener to the link.
        searchIconLink.addEventListener('click', function() {
            // Get the search input value.
            var searchInput = document.querySelector('.input-grey');
            var keywords = searchInput.value;

            // Redirect to the search page with the keywords as a query parameter.
            window.location.href = 'dashboard/find-jobs?keywords=' + encodeURIComponent(keywords);
        });
    }
});
