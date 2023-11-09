$(document).ready(function () {

    $('.bookmark').click(function(){
        var bookmark = $(this);
        var jobId = $(this).data('jobid');
        console.log(jobId);
        var tradesId = bookmark.data('tradesid');
        console.log(tradesId)
        var bookmarkTypes = bookmark.data('bookmarktypes');
        console.log("Testt")

        // var isBookmarked = bookmark.data('bookmarked') == '1';
        
        var isCreate=bookmark.data('create');

        var isMark = bookmark.data('marked');

        // var isAvailable = bookmark.data('available') == '1' && bookmark.data('bookmarked') == '0';

        var wishlistId = bookmark.data('wishlistid');
    
        var contractorId = bookmark.data('contractorid');
        console.log(contractorId)

        // var isEdit = bookmark.

        $.ajax({
            url: 'process/bookmark.php',
            type: 'POST',
            data: {
                job_id: jobId,
                trades_id: tradesId,
                contractor_id: contractorId,
                wishlist_types: bookmarkTypes,
                id :  wishlistId ,
                mark:isMark,
                process: 'process', 
                process: isCreate == true? 'add' : isMark==true?'unmark' : 'edit'
                
                // process: 
            },
            success: function (response) {
                if (response.response === 'success') {

                    document.location.reload();
                    // Update the bookmark icon to indicate it's stored
                    // var iconImage = 'bookmark-filled.svg';
                    // $('img', bookmark).attr('src', 'assets/images/' + iconImage);

                    // Remove the click event listener so it can't be clicked again
                    bookmark.off('click', handleBookmarkClick);

                    console.log("Bookmark Added Successfully" );
                } else {
                    console.log("Bookmark Error");
                }
            },
            error: function () {
                console.log("AJAX Error");
            }
        });
    });
});
