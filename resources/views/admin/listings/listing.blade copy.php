@extends('layouts.app')
@push('css')
<style>
.table-responsive {
    overflow-x: visible;
}

.details-row {
    display: none;
}
</style>
@endpush
@section('content')
<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">

                <h5>All Listings</h5>
                <a href="{{ route('admin.archived.listing')}}" class="btn btn-small btn-info text-white">Archive
                    Listing<a>
                        <a href="{{ route('add.carinventory') }}" class="btn btn-small btn-info float-right text-white">
                            Add Inventory
                        </a>

            </div>
            <div class="card-block">
                @if (session()->has('message'))
                <h3 class="text-success">{{ session()->get('message') }}</h3>
                @endif
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap inventory-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-start">
                                    <div>
                                        <input type="checkbox" id="is_check_all">
                                    </div>
                                </th>
                                <th></th>
                                <th style="font-size:14px;">Sl</th>
                                <th style="font-size:14px;">Stock</th>
                                <th style="font-size:14px;">Title</th>
                                <th style="font-size:14px;">Dealer</th>
                                <th style="font-size:14px;">Category</th>
                                <th style="font-size:14px;">Payment Date</th>
                                <th style="font-size:14px;">Active till</th>
                                <th style="font-size:14px;">Featured till</th>
                                <th style="font-size:14px;">Package/Plan</th>
                                <th style="font-size:14px;">Visibility</th>
                                {{-- <th style="font-size:14px;">Status</th> --}}
                                <th style="font-size:14px;">Action</th>
                            </tr>
                        </thead>

                        <tbody></tbody>
                    </table>
                    {{-- <div class="container">
                        <h2>Collapsible Table</h2>
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>
                                  <button class="btn btn-info btn-sm toggle-details">Show Details</button>
                                </td>
                              </tr>
                              <tr class="details-row">
                                <td></td>
                                <td colspan="2">
                                  <!-- Details content goes here -->
                                  <p>Email: john@example.com</p>
                                  <p>Phone: 123-456-7890</p>
                                </td>
                              </tr>
                              <!-- Add more rows with unique details and buttons -->
                            </tbody>
                          </table>
                        </div>
                      </div> --}}




            </div>
        </div>
    </div>
</div>
@endsection

@push('delear_JS')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {


$(function() {

    var table = $('.inventory-table').DataTable();

    $('.inventory-table tbody').on('click', '.toggle-details', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    function format(data) {
        console.log(data.image_from_url);
        return '<tr class="details-row"><td colspan="11"><div class="row"><div class="col-lg-6"><div class="row"><div class="col-lg-6"><img alt="Local Cars" src="' + data.image_from_url + '" class="card-image rounded" width="100%" height="220px"></div><div class="col-lg-6"><p class="mt-2">Title : <span style="font-weight:500;">' +' data.title' + '</span></p><p class="mt-2">Price : <span style="font-weight:500;">' + 'data.price_formate' + '</span></p><p class="mt-2">Engine : <span style="font-weight:500;">' + 'data.engine_description_formate' + '</span></p><p class="mt-2">Drive Train : <span style="font-weight:500;">' + data.drive_train + '</span></p><p class="mt-2">Exterior Color : <span style="font-weight:500;">' + data.exterior_color + '</span></p></div></div></div></div></td></tr>';
    }
// Destroy the DataTable only if it is already initialized
if ($.fn.DataTable.isDataTable('.inventory-table')) {
    table.destroy();
}
    
     table = $('.inventory-table').DataTable({

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
            "url": "{{ route('admin.listing') }}",
            "data": function(data) {
                //filter options
                // data.hrm_department_id = $('#hrm_department_id').val();
                // data.shift_id = $('#shift_id').val();
                // data.grade_id = $('#grade_id').val();
                // data.designation_id = $('#designation_id').val();
                // data.date_range = $('.submitable_input').val();
                // data.employment_status = $('#employment_status').val();
            }
        },

        "drawCallback": function(data) {
            allRow = data.json.allRow;
            // $('#all_item').text('All (' + allRow + ')');
            $('#is_check_all').prop('checked', false);
            // $('#trashed_item').text('');
            // $('#trash_separator').text('');
            // $("#bulk_action_field option:selected").prop("selected", false);

        },

        columns: [{
                name: 'check',
                data: 'check',
                sWidth: '3%',
                orderable: false,
                targets: 0
            },
            {
                data: 'plus',
                name: 'plus'
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
                data: 'dealer',
                name: 'dealer'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'payment',
                name: 'payment'
            },
            {
                data: 'active',
                name: 'active'
            },
            {
                data: 'feature',
                name: 'feature'
            },
            {
                data: 'membership',
                name: 'membership'
            },
            {
                data: 'status',
                name: 'status'
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

        table.ajax.reload();

    });


});

});


$(document).ready(function() {
    $(".toggle-details").click(function() {
        $(this).closest("tr").next(".details-row").toggle();
    });
});


$(document).ready(function() {

    $('.status-select').on('change', function() {
        var id = $(this).data('id');
        var package = $(this).val();

        $.ajax({
            url: "{{ route('package-add') }}",
            type: 'PATCH',
            data: {
                package: package,
                id: id
            },
            success: function(res) {
                // Update UI based on the response


                if (res.status == 'success') {
                    // toastr.success(response.message);
                    // $('.status-select').append('<i class="fa fa-facebook"></i>');
                    $('.table').load(location.href + ' .table');
                    location.reload();


                }
            },

        });
    });

    //  Active Inactive Working Ajax

    $('.action-select').on('change', function() {
        var id = $(this).data('id');
        var status = $(this).val();


        $.ajax({
            url: "{{ route('status-add') }}",
            type: 'PATCH',
            data: {
                status: status,
                id: id
            },
            success: function(res) {
                // Update UI based on the response


                if (res.status == 'success') {

                    const message = res.current_status === 1 ? 'Active' : 'Inactive';
                    $('.table').load(location.href + ' .table', () => location.reload());
                    toastr.success(`Status ${message} Successfully`);


                }
            },

        });
    });


    // listing display start
    $('.display-select').on('change', function() {
        var id = $(this).data('id');
        var status = $(this).val();
        $.ajax({
            url: "{{ route('display-status') }}",
            type: 'PATCH',
            data: {
                status,
                id
            }, // Shortened object syntax
            success: function(res) {
                console.log(res);
                if (res.status === 'success') {

                    let message = '';
                    if(res.current_display == 1){
                        message = 'Active';
                    }
                    if(res.current_display == 0){
                        message = 'Inactive';
                    }
                    if(res.current_display == 2){
                        message = 'Expired';
                    }
                    if(res.current_display == 3){
                        message = 'Archived';
                    }
                    if(res.current_display == 4){
                        message = 'Invalid';
                    }
                    if(res.current_display == 5){
                        message = 'Blocked';
                    }

                    $('.table').load(location.href + ' .table', () => location.reload());
                    toastr.success(`Visivility ${message} Successfully`);

                }
            },
        });
    });

    // listing display end


    // listing delete

    $('.listing_delete').on('click', function() {
        var id = $(this).data('id');

        if (confirm('Are You Sure Want to Archive it? ')) {

            $.ajax({
                url: "{{ route('listing.delete') }}",
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    // Update UI based on the response
                    if (res.status == 'success') {

                        $('.table').load(location.href + ' .table');
                        location.reload();
                        toastr.success('Inventory Archived Successfully ');


                    }
                },

            });

        }



    });





});
</script>


@endpush

