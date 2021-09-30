(function($) {

    $(document).ready(function() {

        //Ckeditor

        CKEDITOR.replace('post_text')


        //select2

        $('.post_select').select2();

        //logout features

        $(document).on('click', '#logout_btn', function(e) {

            e.preventDefault(); 

            $('#logout_form').submit();
        });


        //category status

        $(document).on('click', '.cat_status', function() {

            let checked = $(this).attr('checked');
            let id = $(this).attr('status_id');

            if (checked == 'checked') {

                $.ajax({

                    url: 'category/status-inactive/' + id,
                    success: function(data) {

                        swal('status inactive successfully');

                    }
                });

            } else {

                $.ajax({

                    url: 'category/status-active/' + id,
                    success: function(data) {

                        swal('status active successfully');

                    }
                });



            }

        });


        //delete massage


        $(document).on('click', '#delete_btn', function(e) {

            let conf = confirm('Are you sure ?');

            if (conf == true) {

                return true;

            } else {

                return false;

            }
        });

        //Edit category

        $(document).on('click', '#edit_id', function(e) {
            e.preventDefault();

            // $('#edit_category_modal').modal('show');

            let edit_id = $(this).attr('edit_id');

            $.ajax({

                url: 'category/' + edit_id + '/edit',
                success: function(data) {

                    $('#edit_category_modal').modal('show');

                    $('#edit_category_modal form input[name="name"]').val(data.name);
                    $('#edit_category_modal form input[name="cat_edit_id"]').val(data.id);
                }
            });




        });

        //tag massage

        $(document).on('click', '.tag_status', function() {

            let checked = $(this).attr('checked');
            let status_id = $(this).attr('tag_staus');

            if (checked == 'checked') {

                $.ajax({

                    url: 'tag/status-inactive/' + status_id,
                    success: function(data) {

                        swal('Tag inactive successfully');
                    }
                });

            } else {

                $.ajax({

                    url: 'tag/status-active/' + status_id,
                    success: function(data) {

                        swal('Tag active successfully');
                    }
                });

            }
        });

        //Tag delete

        $(document).on('click', '#tag_btn', function(e) {


            let conf = confirm('Are you sure ?');

            if (conf == true) {

                return true;

            } else {

                return false;
            }


        });


        //tag modal show & update


        $(document).on('click', '#edit_id', function(e) {

            e.preventDefault();


            let tag_edit = $(this).attr('edit_tag');

            $.ajax({

                url: 'tag/' + tag_edit + '/edit',
                success: function(data) {

                    $('#edit_tag_modal').modal('show');

                    $('#edit_tag_modal form input[name="name"]').val(data.name);
                    $('#edit_tag_modal form input[name="tag_edit_id"]').val(data.id);

                }
            });

        });


        //post image load

        $('#post_image_select').change(function(e) {

            let url = URL.createObjectURL(e.target.files[0])

            $('.post_image_load').attr('src', url);


        });

        //post image gallery

        $('#post_image_select_g').change(function(e) {

            let img_gall = '';

            for (let i = 0; i < e.target.files.length; i++) {

                let gall_url = URL.createObjectURL(e.target.files[i]);
                img_gall += '<img style="width:150px" class="shadow" src="' + gall_url + '">';

            }

            $('.post_img_gall').html(img_gall);

        })


        //show post formate

        $('#post_format').change(function() {

            let format = $(this).val();

            if (format == 'Image') {

                $('.post_image').show();

            } else {

                $('.post_image').hide();

            }
            if (format == 'Gallery') {

                $('.gall_image').show();

            } else {

                $('.gall_image').hide();

            }

            if (format == 'Audio') {

                $('.post_audio').show();

            } else {

                $('.post_audio').hide();

            }

            if (format == 'Video') {

                $('.post_video').show();

            } else {

                $('.post_video').hide();

            }
        });

        //post status update

        $(document).on('click', '.post_status', function(e) {

            // e.preventDefault();

            let checked = $(this).attr('checked');
            let status_id = $(this).attr('status_id');

            if (checked == 'checked') {
                $.ajax({

                    url: 'post/status-inactive/' + status_id,
                    success: function(data) {

                        swal('Post staus inactive successful');
                    }
                });

            } else {

                $.ajax({

                    url: 'post/status-active/' + status_id,
                    success: function(data) {

                        swal('Post staus active successful');
                    }
                });


            }

        });

        //post delete

        $(document).on('click', '#post_del_btn', function(e) {


            let conf = confirm('Are You sure ?');

            if (conf == true) {

                return true;

            } else {

                return false;

            }


        });


        //dashboard menu customization

        $('#sidebar-menu ul li ul li.ok').parent('ul').slideDown();
        $('#sidebar-menu ul li ul li.ok a').css('color', '#5AE6EA');
        $('#sidebar-menu ul li ul li.ok').parent('ul').parent('li').children('a').css('background-color', '#19C1DC');
        $('#sidebar-menu ul li ul li.ok').parent('ul').parent('li').children('a').addClass('subdrop');




    });

})(jQuery)