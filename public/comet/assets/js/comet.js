(function($) {

    $(document).ready(function() {

        $('.reply_btn').click(function(e) {

            e.preventDefault();

            let cid = $(this).attr('c_id');

            $('.reply-box-' + cid).toggle();

        });













    });

})(jQuery)