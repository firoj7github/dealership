@extends('layouts.app')

@push('css')
    <style>

    </style>
@endpush

@section('content')
    <div class="page-content-tab">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            <p style="display: inline">Featured Car List</p>
                            <a href="{{ route('dealer.management')}}" class="btn btn-primary float-right">Back Dealer Management</a>
                        </div>
                    </div>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th> Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ( $inventories as $inventory )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $inventory->id }}</td>
                                    <td>{{ $inventory->title }}</td>
                                    <td>$20</td>
                                    {{-- <td> <a href="{{route('generate.invoice',$inventory->id)}}" class="btn btn-primary btn-small">Download Invoice</a></td> --}}
                                    <td> <a href="#" class="btn btn-primary btn-small">Download Invoice</a></td>
                                </tr>

                                @empty
                                    <tr>
                                        <td colspan="4" align="center"><h3>No Featured Car Here...</h3></td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('delear_JS')
    <script type="text/javascript">

    </script>
@endpush
