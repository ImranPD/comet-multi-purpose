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
                        $('#cat-table').DataTable().ajax.reload();

                    }
                });

            } else {

                $.ajax({

                    url: 'category/status-active/' + id,
                    success: function(data) {

                        swal('status active successfully');
                        $('#cat-table').DataTable().ajax.reload();

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
                        $('#tag_table').DataTable().ajax.reload();
                    }
                });

            } else {

                $.ajax({

                    url: 'tag/status-active/' + status_id,
                    success: function(data) {

                        swal('Tag active successfully');
                        $('#tag_table').DataTable().ajax.reload();
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

        //datatables in post

        $('#dataTabs').DataTable();



        //datatables in category

        $('#cat-table').DataTable({

            processing: true,
            serverSide: true,

            ajax: {

                url: 'category',

            },

            columns: [

                {
                    data: 'id',
                    name: 'id'

                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'created_at',
                    name: 'created_at'

                },
                {
                    data: 'stat',
                    name: 'stat'
                        // render: function(data, type, full, meta) {

                    //     return `<div class="status-toggle">
                    //                     <input type="checkbox" status_id="${full.id}" ${data==1 ? 'checked=="checked"' : ''}  id="cat_status" class="check cat_status">
                    //                     <label for="cat_status" class="checktoggle">checkbox</label>
                    //                 </div>`;
                    // }
                },
                {
                    data: 'action',
                    name: 'action'
                }


            ]
        });


        //tag data tables

        $('#tag_table').DataTable({

            processing: true,
            serverSide: true,

            ajax: {
                url: 'tag',
            },
            columns: [

                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'created_at',
                    name: 'created_at'

                },
                {
                    data: 'stat',
                    name: 'stat'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });


        //brand status update

        $(document).on('click', '.brand_status', function() {

            let checked = $(this).attr('checked');
            let status_id = $(this).attr('status_id');

            if (checked == 'checked') {

                $.ajax({

                    url: 'brand/status-inactive/' + status_id,

                    success: function(data) {

                        swal('Status inctive successful');

                        $('#brand-table').DataTable().ajax.reload();

                    }
                });

            } else {

                $.ajax({

                    url: 'brand/status-active/' + status_id,

                    success: function(data) {

                        swal('Status Active successful');
                        $('#brand-table').DataTable().ajax.reload();

                    }
                });


            }

        });


        //brand with datatables

        $('#brand-table').DataTable({

            processing: true,
            serverSide: true,

            ajax: {

                url: 'brand',
            },

            columns: [

                {
                    data: 'id',
                    name: 'id'
                },

                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'slug',
                    name: 'slug'
                },

                {
                    data: 'logo',
                    name: 'logo',

                    render: function(data, type, full, meta) {

                        return `<img style="width:60px;" src="media/product/brand/${data}" alt="">`;

                    }
                },

                {
                    data: 'stat',
                    name: 'stat'

                    // render: function(data, type, full, meta) {

                    //     return `<div class="status-toggle">
                    //               <input type="checkbox" status_id="${full.id}"  ${full.status == 1 ? 'checked="checked"' : ''}  id="brand_status_${full.id}" class="check brand_status">
                    //               <label for="brand_status_${full.id}" class="checktoggle">checkbox</label>
                    //             </div>`;

                    // }
                },

                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        //add brand

        $(document).on('submit', '#add_form', function(e) {

            e.preventDefault();

            $.ajax({

                url: 'brand',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    $('#add_form')[0].reset();
                    $('#add_brand_modal').modal('hide');
                    $('#brand-table').DataTable().ajax.reload();
                    swal(data);
                }
            });
        });



        //brand delete

        $(document).on('click', '.del_btn', function(e) {
            e.preventDefault();

            let delete_id = $(this).attr('del_id');


            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((brandDelete) => {

                if (brandDelete) {

                    $.ajax({

                        url: 'brand-delete/' + delete_id,
                        success: function(data) {

                            if (data) {

                                $('#brand-table').DataTable().ajax.reload();

                                swal({

                                    title: "Deleted",
                                    text: data,
                                    icon: "success",
                                });

                            }
                        }
                    });

                } else {

                    swal("Your Data is safe!");
                    $('#brand-table').DataTable().ajax.reload();
                }

            });

        });

        //brand edit
        $(document).on('click', '.edit_btn', function(e) {

                e.preventDefault();

                let id = $(this).attr('edit_id');

                $.ajax({

                    url: 'brand-edit/' + id,
                    success: function(data) {

                        $('#edit_forrm input[name="name"]').val(data.name);
                        $('#edit_forrm input[name="edit_id"]').val(data.id);
                        $('#edit_forrm input[name="old_photo"]').val(data.logo);
                        $('#brand_photo').attr('src', 'media/product/brand/' + data.logo);
                        $('#edit_forrm').attr('form_no', data.id);

                        $('#edit_brand_modal').modal('show');
                    }
                })
            })
            //update brand

        $(document).on('submit', '#edit_forrm', function(e) {

            e.preventDefault();

            let id = $(this).attr('form_no');


            $.ajax({

                url: 'brand/' + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {


                    swal({

                        title: "Updated",
                        text: "Brand Updated Successful",
                        icon: "success",
                    });
                    $('#brand-table').DataTable().ajax.reload();

                    $('#edit_brand_modal').modal('hide');


                }
            });


        });



        //edit modal

        $(document).on('click', '#pcat_edit', function(e) {

            e.preventDefault();

            $('#edit_pcat_modal').modal('show');
        });



    });

})(jQuery)