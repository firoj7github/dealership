@extends('layouts.app')

@push('css')
    <style>
        .imgshow{
            display: none;
            width: 40px !important;
            height: 40px !important;
            background: red;
        }




    </style>


@endpush



@section('content')
    <div class="row">

        <div class="col-md-8 pt-5 m-auto rounded">
            <div class="card">
                <div class="card-header">

                    <h5>Add Banner</h5>



                </div>
                <div class="card-block">
                    @if (session()->has('message'))
                        <h3 class="text-success">{{ session()->get('message') }}</h3>
                    @endif


                    <form action="{{ route('banner.add') }}" enctype="multipart/form-data" method="post"
                        style="background-color:#ddd;padding:20px">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 text-center">


                                <table align="center" cellpadding="10">

                                    <tr>
                                        <td>Packages<span style="color:red;font-weight:bold">*</span> </td>
                                        <td>
                                            <select id="banner_price" name="banner_price" class="form-control">
                                                <option value="">~ select packages ~</option>
                                                <option value="100">Header Banner - $100</option>
                                                <option value="">Home Bottom - Free</option>



                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Banner Name<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="name" id="name" placeholder="banner name"
                                                class="form-control">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Banner Position<span style="color:red;font-weight:bold">*</span> </td>
                                        <td>
                                            <select id="position" name="position" class="form-control"
                                                onchange="positionChange(this.value)">
                                                <option value="">~ select position ~</option>
                                                <option value="left_sidebar">Left Sidebar</option>
                                                <option value="Right_sidebar">Right Sidebar</option>
                                                <option value="top">Top</option>
                                                <option value="Bottom">Bottom</option>
                                                <option value="middle">Middle</option>


                                                <option value="header_banner">Header Banner</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>


                                        <td>Banner Image<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <p style=" margin-top:7px;" id="recomanded">
                                            <p></label>
                                                <input type="file" name="image" id="image" class="form-control"
                                                    disabled>
                                                    <img src="" alt="Image Preview" id="imagePreview"
                                                    class="imgshow">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Start Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" name="start_date" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>End Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" name="end_date" class="form-control">
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6 text-center">

                                <table align="center" cellpadding="10">

                                    <tr>
                                        <td>Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="user_id"   name="user_id" class="form-control">
                                                <option value="">~ select ~</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                    </tr>
                                    </tr>




                                    <tr>
                                        <td>Status <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="status" name="status" name="account_type" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="payment" name="payment" name="account_type" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Success</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Renew <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select name="renew" id="renew" class="form-control">
                                                <option value="">~ select State ~</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </td>
                                    </tr>

                                </table>
                                <button style="padding-left:22px; padding-right:22px; margin-left:210px; margin-top:10px"
                                    class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('delear_JS')

    <script type="text/javascript">
        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });

        // image show when image insert
        $(document).ready(function () {
        // When the file input changes
        $(".image").change(function () {
            readURL(this);
        });

        // Function to read the URL and display the image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Display the image preview
                    $("#imagePreview").attr("src", e.target.result).show();
                };

                // Read the file as a data URL
                reader.readAsDataURL(input.files[0]);
            }
        }
    });


        function positionChange(value) {

            // console.log(value);
            if (value == 'left_sidebar') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info">
                                                    </i>Recommended: 50x300 px`;

            }
            if (value == 'Right_sidebar') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 50x300 px`;

            }
            if (value == 'top') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1000x100 px`;

            }
            if (value == 'Bottom') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1000x100 px`;

            }
            if (value == 'middle') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 500x80 px`;

            }
            if (value == 'header_banner') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 800x80 px`;

            }


            if(value == '')
            {
                console.log('hello');
                var element = document.getElementById('image');

                // Remove an attribute, for example, the 'disabled' attribute
                element.setAttribute('disabled','disabled');
            }

        }



    </script>
