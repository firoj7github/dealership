<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $(function() {

            var table = $('.lead-table').DataTable({

                dom: "lBfrtip",
                buttons: [{
                    extend: 'pdf',
                    text: '<i class="fa-thin fa-file-pdf fa-2x"></i><br>PDF',
                    className: 'pdf btn text-white btn-sm px-1',
                    exportOptions: {
                        columns: [2, 4, 5, 6, 7, 8]
                    }
                }, {
                    extend: 'excel',
                    text: '<i class="fa-thin fa-file-excel fa-2x"></i><br>Excel',
                    className: 'pdf btn text-white btn-sm px-1',
                    exportOptions: {
                        columns: [2, 4, 5, 6, 7, 8]
                    }
                }, {
                    extend: 'print',
                    text: '<i class="fa-thin fa-print fa-2x"></i><br>Print',
                    className: 'pdf btn text-white btn-sm px-1',
                    exportOptions: {
                        columns: [2, 4, 5, 6, 7, 8]
                    }
                }, ],

                "pageLength": 50,
                "lengthMenu": [
                    [10, 25, 50, 100, 500, 1000, -1],
                    [10, 25, 50, 100, 500, 1000, "All"]
                ],
                processing: true,
                serverSide: true,
                searchable: true,
                "ajax": {
                    "url": "{{ route('dealer.lead') }}",
                    "data": function(data) {
                        //filter options
                        data.is_read = $('#is_read').val();
                        // //send types of request for colums
                        // data.date_range = $('.submitable_input').val();
                    }
                },

                    "drawCallback": function(settings) {
                        // Get DataTables API instance
                        var api = new $.fn.dataTable.Api(settings);

                        // Iterate through each row and add class based on 'status'
                        api.rows().every(function(index, element) {
                            var status = this.data().sta;
                            if (status == 1) {
                                $(this.node()).addClass('bg-warning');
                            }
                        });

                        // Additional code as needed
                        $('#is_check_all').prop('checked', false);

                    // // $('#all_item').text('All (' + allRow + ')');
                    // $('#is_check_all').prop('checked', false);
                    // // $('#trashed_item').text('');
                    // // $('#trash_separator').text('');
                    // // $("#bulk_action_field option:selected").prop("selected", false);
                    },

                columns: [{
                        name: 'check',
                        data: 'check',
                        sWidth: '3%',
                        orderable: false,
                        targets: 0
                    },
                    {
                        name: 'DT_RowIndex',
                        data: 'DT_RowIndex',
                        sWidth: '3%'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'package',
                        name: 'package'
                    },
                    {
                        data: 'listing',
                        name: 'listing'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'cus_name',
                        name: 'cus_name'
                    },
                    {
                        data: 'cus_phone',
                        name: 'cus_phone'
                    },
                    {
                        data: 'cus_email',
                        name: 'cus_email'
                    },
                    {
                        data: 'stage',
                        name: 'stage'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ],
                "lengthMenu": [
                    [10, 25, 50, 100, 500, 1000, -1],
                    [10, 25, 50, 100, 500, 1000, "All"]
                ],
            });
            table.buttons().container().appendTo('#exportButtonsContainer');

            $(document.body).on('click', '#is_check_all', function(event) {
                alert('Checkbox clicked!');
                var checked = event.target.checked;
                if (true == checked) {
                    $('.check1').prop('checked', true);
                }
                if (false == checked) {
                    $('.check1').prop('checked', false);
                }
            });

            $('#is_check_all').parent().addClass('text-center');

            $(document.body).on('click', '.check1', function(event) {

                var allItem = $('.check1');

                var array = $.map(allItem, function(el, index) {
                    return [el]
                })

                var allChecked = array.every(isSameAnswer);

                function isSameAnswer(el, index, arr) {
                    if (index === 0) {
                        return true;
                    } else {
                        return (el.checked === arr[index - 1].checked);
                    }
                }

                if (allChecked && array[0].checked) {
                    $('#is_check_all').prop('checked', true);
                } else {
                    $('#is_check_all').prop('checked', false);
                }
            });

            //Submit filter form by select input changing
            $(document).on('change', '.submitable', function() {
                console.log('ajax reloaded');
                table.ajax.reload();
            });


        });

    });


    $(document).on('click', '.delete', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.confirm({
        title: 'Delete Confirmation',
        content: 'Are you sure?',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-primary',
                action: function () {
                    // Do nothing on cancel
                }
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-danger',
                action: function () {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function (data) {
                            // Show Toastr success message
                            toastr.success(data.status);
                            // Reload or redraw your data table if needed
                            $('.lead-table').DataTable().draw(false);
                        },
                        error: function (error) {
                            // Show Toastr error message
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
            },

        }
    });
});
</script>
<script type="text/javascript">
    $.ajaxSetup({
        beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },
    });
    $(document).ready(function() {
        $(document).on('click', '#editLead', function() {
            var lead_id = $(this).attr('data-id');

            $.ajax({
                url: "{{ route('edit-lead') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(result) {

                    var newDate = new Date(result.date).toLocaleDateString('en-CA');
                    $('#vichele_name').val(result.vichele_name);
                    $('#customer').val(result.customer_name);
                    $('#date').val(newDate);
                    $('#lead_id').val(result.id);
                    $('#lead_type').val(result.lead_type);
                    $("#EditModal").modal("show");
                }
            }); //  console.log(id);


        });


    });

    $(function() {
        //data : 'c_id='+23+'&_token={{ csrf_token() }}',


        $("#UpdateLead").on("submit", function(e) {
            e.preventDefault();
            var vichele_name = $('#vichele_name').val();
            var customer = $('#customer').val();
            var date = $('#date').val();
            var lead_type = $('#lead_type').val();
            var lead_id = $('#lead_id').val();
            // var token = '&_token={{ csrf_token() }}';
            $.ajax({
                url: "{{ route('update.lead') }}",
                type: 'post',
                data: {
                    vichele_name: vichele_name,
                    customer: customer,
                    date: date,
                    lead_type: lead_type,
                    lead_id: lead_id
                },
                success: function(data) {
                    if (data.status == true) {
                        new swal({
                            position: 'top-right',
                            icon: 'success',
                            title: 'Email Lead Update Successfully',
                            showConfirmButton: false,
                            timer: 3000,
                        });

                        $("#editLead").modal("hide");
                        window.location.reload();

                    } else {
                        console.log("hi");
                        // $.each(data.error, function (prefix, val) {
                        //     $("span." + prefix ).text(val[0]);
                        // });
                    }
                },

                error: function(err) {
                    let error = err.responseJSON;
                    console.log(error);
                },
            });

        });


    });



    function confirm(ev, id) {
        console.log(id);
        new swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result);
            if (result == true) {
                $.ajax({
                    url: "{{ route('email.lead.delete') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(result) {
                        if (result.status == true) {
                            new swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            window.location.reload();


                        }

                    }
                });


            }
        });

    }

    // function EditLead()
    // {
    //     var lead_id = $('#editLead').val();
    //     console.log(lead_id);
    // }

    function modalShow(id) {
        console.log(id);
        $.ajax({

            url: "{{ route('get.lead.details') }}",
            type: 'get',
            data: {
                id:id
            },
            success: function(result) {
                var Lead_details = result.lead_details;
                var car_details = result.lead_details.inventories_car;
                var date = Lead_details.date;
                $('.lead-table').DataTable().draw(false);
                // Convert the fetched date string into a JavaScript Date object
            //     var originalDate = new Date(date);

            // // Format the date in the desired format: "DD-MM-YYYY"
            //     var formattedDate = ("0" + originalDate.getDate()).slice(-2) + "-" +
            //        ("0" + (originalDate.getMonth() + 1)).slice(-2) + "-" +
            //        originalDate.getFullYear();

            var originalDate = new Date(date);

            // Format the date in the desired format: "MM-DD-YYYY" (American style)
            var formattedDate = ("0" + (originalDate.getMonth() + 1)).slice(-2) + "-" +
                            ("0" + originalDate.getDate()).slice(-2) + "-" +
                            originalDate.getFullYear();

                if (result.status == true) {

                    $('#vehicle_name').html(result.vehicle_name);
                    $('.name_customer').html(Lead_details.user.username);
                    $('#customer_phone').html(Lead_details.user.phone);
                    $('#customer_email').html(Lead_details.user.email);
                    $('#total_lead').html(7);
                    $('#days_listed').html(formattedDate);
                    $('#stock').html(car_details.stock);
                    $('#milleage').html(car_details.miles);
                    $('#average_price').html(2300);
                    $('#price').html(car_details.price);
                    // $('#address').html(car_details.dealer_address);
                    $('#salesPerson').html("");
                    $('#lead_description').html(Lead_details.description);
                    $('#lead_id_send_message').val(result.lead_details.id);
                    $('#email_image_car').attr('src', result.final_car);
                    $('.T_year').html(Lead_details.year);
                    $('.T_make').html(Lead_details.make);
                    $('.T_model').html(Lead_details.model);
                    $('.T_mileage').html(Lead_details.mileage);
                    $('.T_color').html(Lead_details.color);
                    $('.T_vin').html(Lead_details.vin);





                    if (result.data.length > 0) {


                    $('#messageAll').empty();

                    result.data.forEach(function(message) {

                    var formattedTime = new Intl.DateTimeFormat('en-US', { day: 'numeric', month: 'short', hour: 'numeric', minute: 'numeric', hour12: true }).format(new Date(message.created_at));







                    console.log(message);
                    if (message.receiver_id == <?php echo Auth::id(); ?>) {
                        $('#messageAll').append('<p class="mt-3 w-50  text-left" style="background-color:rgb(2, 41, 88); padding:22px;border-radius:7px; color:white;">' + message.message + '<span style=" float:right; padding-top:0px;padding-bottom:10px " class="text-warning">' + formattedTime + '</span></p>');






                    }
                    else{
                        $('#messageAll').append('<p class="w-50" style="background-color:rgb(88, 87, 87); padding:22px;  border-radius:7px; color:white;  margin-left:315px">' + message.message + '<span style=" float:right; padding-top:0px" class="text-warning">' + formattedTime + '</span></p>');


        }
    });
   }else{
                //    $('.sender_message').css('display', 'none');
                //    $('.receiver_message').css('display', 'none');
}

                    $('#LeadDetailsModal').modal('show');




                }





                else {
                    console.log('hi some thing wrong! ');
                }





            }
        });
    }

        // Get references to the button and file input elements
        const openFileButton = document.getElementById("openFileButton");
        const fileInput = document.getElementById("fileInput");

        // Add a click event listener to the button
        openFileButton.addEventListener("click", function () {
            // Trigger a click event on the file input element
            fileInput.click();
        });

        // Add an event listener to the file input element to handle file selection
        fileInput.addEventListener("change", function () {
            // Get the selected file
            const selectedFile = fileInput.files[0];

            // You can now work with the selected file, for example, display its name
            if (selectedFile) {
                alert("Selected file: " + selectedFile.name);
            }
        });


        // add new customer js
        $(document).ready(function(){
            $('#create_new_customer').on('click',function(){

            var isChecked = this.checked;
            if(isChecked == true)
            {
                $('#create_hidden_button').css({"display":"block"});
            }else
            {
                $('#create_hidden_button').css('display','none');
            }


            });
        })

        // choose vevhile modal open
        $(document).ready(function(){
            $('#choose_vechile').on('click',function(){
                $('#chose_vechile_modal').modal('show');
            });


            $('.search_query').on('keyup',function(){

               var search_type = $(this).val();
               $.ajax({
                url:"{{ route('dealer.lead')}}",
                type:"get",
                data:{search:search_type},
                success: function(data){
                    var cars = data.cars;
                    if(cars.length > 0)
                    {
                        $('#carShow').html("");
                        $.each(cars, function(key,car){
                            var car_image = car.image_from_url.split(',');
                            $('#carShow').append('<div class="row">\
                                                            <div class="col-md-2 mb-3 p-0">\
                                                                <img src="'+ car_image[0]+'"\
                                                                    alt="" style="width: 100%">\
                                                            </div>\
                                                            <div class="col-md-8 mb-3 text-left">\
                                                                <span class="text-left " style="font-weight:bold">'+ car.year + ' ' + car.make  + ' ' +  car.model +' <span style="color: #bdbaba"> # '+ car.stock +'</span></span><br/>\
                                                                <span class="text-left" style="font-weight:bold;color:red">$ '+ car.price+'</span>\
                                                            </div>\
                                                            <div class="col-md-2 mb-3 p-0 text-right">\
                                                                <button type="button" class="btn text-white select_car" style="background-color: #103a6a" value="'+car.id+'">select</button>\
                                                            </div>\
                                                        </div>');
                        });

                    }else
                    {
                        $('#carShow').append('<div class="row"><h3>No Car Found! </h3></div>');
                    }




                }
               });
            });


        });


        $(document).on('click','.select_car',function(e){
            e.preventDefault();
            var id = $(this).val();
           $.ajax({
            url:"{{ route('select.car')}}",
            type:"post",
            data:{car_id:id},
            success:function(res){
                var select_car = res.car;
               if(select_car)
               {
                $('.selected_car').html("");
                $('.selected_car').append('<div class="col-md-12 mb-3 p-0">\
                                                                            <img src="'+select_car.image+'"\
                                                                                alt="" style="width: 30%">\
                                                                                <span class="text-left" style="font-weight:bold">'+select_car.title+'</span><br/>\
                                                                                <a href="javascript:void(0)" type="button" class="remove_car" style="color: rgb(92, 55, 55);text-decoration:underline">Remove Vechile Selection</a>\
                                                                                <input type="hidden" value ="'+select_car.id+'" name="vechile_id" />\
                                                                        </div>');

               }

               $('#chose_vechile_modal').modal('hide');

            }

           });
        });

        $(document).on('click','.remove_car',function(e){
            e.preventDefault();

            $('.selected_car').html("");
            $('.selected_car').append('<span style="font-size: 10px">No Vechile chosen</span>');


        });



        $(document).ready(function(){

            $('#Lead_submit').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    method: $(this).attr("method"),
                    data: new FormData(this),
                    processData: false,
                    datatype: JSON,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        if (response.error) {
                            $(document).find("div.create_hidden_button").css('display','block');
                            if(response.error.first_name)
                            {
                                $('.invalid-feedback1').text(response.error.first_name);
                            }
                            if(response.error.last_name)
                            {
                                $('.invalid-feedback2').text(response.error.last_name);
                            }
                            if(response.error.email)
                            {
                                $('.invalid-feedback3').text(response.error.email);
                            }
                            if(response.error.phone)
                            {
                                $('.invalid-feedback4').text(response.error.phone);
                            }
                            if(response.error.lead_type)
                            {
                                $('.invalid-feedback8').text(response.error.lead_type);
                            }
                            if(response.error.source)
                            {
                                $('.invalid-feedback9').text(response.error.source);
                            }
                        }

                        if(response.message)
                        {
                            toastr.success(response.message);
                            $('#staticBackdrop').modal('hide');
                            $('#Lead_submit')[0].reset();
                            $('.lead-table').DataTable().draw(false);


                        }



                    }
                });


            });

        });


   $(document).ready(function() {
    // Initialize Inputmask
    $('.telephoneInput').inputmask('(999) 999-9999');
  });
</script>
