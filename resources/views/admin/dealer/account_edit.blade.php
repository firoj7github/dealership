@extends('layouts.app')

@push('css')
<style>
    .divide
    {
        height: 2px;
        width: 100%;
        background-color: #ddd;
        margin: 30px 0px;
    }
    .map-container{
  overflow:hidden;
  padding-bottom:56.25%;
  position:relative;
  height:0;
}
.map-container iframe{
  left:0;
  top:0;
  height:100%;
  width:100%;
  position:absolute;
}
.line_height
    {
        position: relative;
        line-height: 63px;
    }
    .heading_content h3::before {
    background-color: #242424;
    bottom: 6px;
    content: "";
    height: 1px;
    left: 0;
    margin: 0 auto;
    right: 0;
    position: absolute;
    width: 99px;
}
.heading_content h3::after {
    background-color: #242424;
    bottom: 0;
    content: "";
    height: 1px;
    left: 0;
    margin: 0 auto;
    position: absolute;
    right: 0;
    width: 59px;
}
</style>
@endpush

@section('content')
<div class="page-content-tab">

    <div class="container-fluid" id="contentToConvert">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3>'{{$user->username}}' Account Details</h3>

                            </div>
                            <div class="col-md-8 text-right">
                                <a href="{{ route('admin.dealer.account-edit',$user->id)}}" class=" btn btn-primary"><i class="fa fa-edit"></i> Edit Account</a>
                                <a href="#"  class=" btn btn-danger"> <i class="fa fa-delete-left"></i> Remove Account</a>
                                <a href="{{ route('dealer.management')}}"  class=" btn btn-info"><i class="fa fa-list"></i> All Account</a>
                            </div>
                            <div class="col-md-12 mt-4">
                                <a href="{{ route('admin.user.information', $user->id) }}"
                                 class="btn btn-small btn-primary text-white">Account Information<a>
                              <a href="{{ route('admin.dealer.listing', $user->id) }}"
                                  class="btn btn-small btn-primary text-white">Listing<a>
                              <a href="#" class="btn btn-small btn-info text-white">Leads<a>
                              <a href="#" class="btn btn-small btn-success text-white">Banners<a>
                              <a href="#" class="btn btn-small btn-success text-white">Sliders<a>
                              <a href="#" class="btn btn-small btn-primary text-white">Archived<a>
                              <a href="{{ route('admin.dealer.invoice', $user->id) }}"
                                  class="btn btn-small btn-secondary text-white">Invoice<a>
                                  </div>
                        </div>
                    </div>

                    <div class="card-body">

                                <div  style="background-color:#ddd;padding:40px">
                                    @if (session()->has('message'))
                                <h3 class="text-success">{{ session()->get('message')}}</h3>
                                 @endif
                                    <a href="#" class="float-right" style="font-weight:bold;text-decoration: underline;color:blue" data-bs-toggle="modal" data-bs-target="#changePassword">Change Password</a>

                            {{-- change password modal --}}

                            <!-- Modal -->
                            <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('admin.dealer.change.password')}}" id="changePasswordForm" method="POST">
                                        @csrf
                                    <div class="modal-body">

                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Current Password</label>
                                              <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Old Password" name="current_password">
                                              <input type="hidden" value="{{ $user->id}}" name="user_id">

                                              <span class="text-danger invalid-feedback1"></span>

                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputPassword1">New Password</label>
                                              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New Password" name="new_password">
                                              <span class="text-danger invalid-feedback2"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Confirm Password</label>
                                                <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
                                                <span class="text-danger invalid-feedback3"></span>
                                              </div>
                                              <a href="#" style="text-decoration: underline">forgot password</a>

                                    </div>
                                    <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>
                            {{-- End change password modal --}}

                                <form action="{{ route('admin.user.update.account',$user->id)}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <div class="heading_content">
                                                <h3 class="text-center fw-bold line_height">Account Setting</h3>
                                            </div>
                                            <table align="center" cellpadding="10">
                                                <tr>
                                                    <td>Company Name </td>
                                                    <td>
                                                        <input type="text" name="company_name" class="form-control" value="{{($user->company_name) ? $user->company_name : old('company_name') }}">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>First Name <span style="color:red;font-weight:bold">*</span></td>
                                                    <td>
                                                        <input type="text" name="fname" class="form-control" value="{{($user->fname) ? $user->fname : old('fname') }}">
                                                        @error('fname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                </tr>
                                                <tr>
                                                    <td>Last Name <span style="color:red;font-weight:bold">*</span></td>
                                                    <td>
                                                        <input type="text" name="lname" class="form-control" value="{{($user->lname) ? $user->lname : old('lname') }}">
                                                        @error('lname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                         @enderror
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Cell <span style="color:red;font-weight:bold">*</span></td>
                                                    <td>
                                                        <input type="tel" name="phone" class="form-control us_telephone" value="{{($user->phone) ? $user->phone : old('phone') }}" data-mask="(999) 999-9999">
                                                        @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Website </td>
                                                    <td>
                                                        <input type="url" name="website" class="form-control" value="{{($user->website) ? $user->website : old('website')}}">
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td>Country</td>
                                                    <td>
                                                        <select id="" name="country" class="form-control">
                                                            <option value="">~ select country ~</option>
                                                            <option value="">country one</option>
                                                            <option value="">country two</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>State/Region/Province </td>
                                                    <td>
                                                        <select  name="city" class="form-control">
                                                            <option value="">~ select State ~</option>
                                                            <option value="">State one</option>
                                                            <option value="">State two</option>
                                                        </select>
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td>Address </td>
                                                    <td>
                                                        <textarea name="address"  cols="30" rows="2" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Zip Code </td>
                                                    <td>
                                                        <input type="text" name="zip_code" class="form-control" value="{{ ($user->zip_code) ? $user->zip_code : old('zip_code')}}">
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                <div class="col-md-6 text-center">
                                    <div class="heading_content">
                                        <h3 class="text-center fw-bold line_height">Profile Setting</h3>
                                    </div>

                                    <table align="center" cellpadding="10">
                                        <tr>
                                            <td>Account Type <span style="color:red;font-weight:bold">*</span></td>
                                            <td>
                                                <select  name="account_type" class="form-control" value="{{ old('account_type') }}">
                                                    <option value="">~ select type ~</option>
                                                    <option value="2" {{ ($user->role == 2)? 'selected': ''}}>Dealer</option>
                                                    <option value="0" {{ ($user->role == 0)? 'selected': ''}}>Individual</option>
                                                </select>
                                                @error('account_type')
                                                <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>E-mail<span style="color:red;font-weight:bold">*</span></td>
                                            <td>
                                                <input type="email" name="email" class="form-control" value="{{ ($user->email) ? $user->email : old('email') }}">
                                               @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ADF email<span style="color:red;font-weight:bold"></span></td>
                                            <td>
                                                <input type="email" name="adf_email" class="form-control" value="{{ ($user->adf_email) ? $user->adf_email : old('adf_email') }}">
                                               @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>New Password<span style="color:red;font-weight:bold">*</span></td>
                                            <td>
                                                <input type="password" name="password" class="form-control" value="{{ ($user->password) ? $user->password : old('password') }}">
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Confirm Password<span style="color:red;font-weight:bold">*</span></td>
                                            <td>
                                                <input type="password" name="confirm_password" class="form-control" value="{{ old('confirm_password') }}">
                                                @error('confirm_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td>Preview Image</td>
                                            <td>
                                                <input type="file" name="img" class="form-control" id="imageInput" accept="image/*">
                                                <img src="{{$user->img}}" alt="">
                                                <img src="" alt="Image Preview" id="imagePreview" style="display:none; max-width: 300px; max-height: 300px;margin-top:10px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status <span style="color:red;font-weight:bold">*</span></td>
                                            <td>
                                                <select name="status" class="form-control" >
                                                    <option value="">~ select ~</option>
                                                    <option value="1" {{ ($user->status == 1)? 'selected': ''}}>Active</option>
                                                    <option value="0" {{ ($user->status == 0)? 'selected': ''}}>Inactive</option>
                                                </select>
                                                @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                    </table>

                                </div>


                            </div>
                            <button class="btn btn-success float-right " type="submit">Save</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('delear_JS')
 <script>
       $.ajaxSetup({
        beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },
    });


$(document).ready(function(){

$('#changePasswordForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        datatype: JSON,
        contentType: false,
        success: function (response) {


            var errors = response.errors;
            if(response.old_password)
                {
                    $('.invalid-feedback1').text(response.old_password);
                }

            if(errors)
            {
                if(errors.confirm_password)
                {
                    $('.invalid-feedback3').text(errors.confirm_password);
                }
                if(errors.current_password)
                {
                    $('.invalid-feedback1').text(errors.current_password);
                }
                if(errors.new_password)
                {
                    $('.invalid-feedback2').text(errors.new_password);
                }

            }




            if(response.message)
            {
                toastr.success(response.message);
                $('#changePassword').modal('hide');
                $('#changePasswordForm')[0].reset();

            }



        }
    });


});

});


     $(document).ready(function () {
        // When the file input changes
        $("#imageInput").change(function () {
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
 </script>
  @endpush

