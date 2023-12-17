@extends('layouts.master')
@section('title','E-library | Lease')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Lease</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Lease</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-start my-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="fas fa-user-plus font-size-16 align-middle me-2"></i> Add Lease
                                </button>
                            </div>
                            <h4 class="card-title">Lease List</h4>
                            @include('layouts.message')
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>User</th>
                                    <th>Book</th>
                                    <th>Status</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Create Date</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody id="tableBody">
                                @if(count($leases) == 0)
                                    <tr>
                                        <td colspan="12" class="text-center">Lease not found!</td>
                                    </tr>
                                @else
                                    @foreach($leases as $key=>$lease)
                                        <tr data-id="{{$lease['id']}}" class="leases">
                                            <td>{{$key+1}}</td>
                                            <td><a href="{{route('getAllUser')}}?name={{$lease['user']['firstName']}}&surname={{$lease['user']['lastName']}}">{{$lease['user']['lastName']." ".$lease['user']['firstName']}}</a></td>
                                            <td><a href="{{route('editBook',$lease['book']['id'])}}">{{$lease['book']['title']}}</a></td>
                                            <td>{{end($lease['statuses'])['name']}}</td>
                                            <td>{{ \Carbon\Carbon::parse($lease['fromDate'])->format('d.m.Y H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($lease['toDate'])->format('d.m.Y H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($lease['createdAt'])->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning waves-effect waves-light editBtn" data-id="{{$lease['id']}}" ><i class="fas fa-pencil-alt"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Lease</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">User</label>
                            <select class="form-control" id="userId">
                                <option selected disabled>Choose user...</option>
                                @foreach($users as $user)
                                    <option value="{{$user['id']}}">{{$user['lastName']." ".$user['firstName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Book</label>
                            <select class="form-control" id="bookId">
                                <option selected disabled>Choose book...</option>
                                @foreach($books as $book)
                                    <option value="{{$book['id']}}">{{$book['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Status</label>
                            <select class="form-control" id="statusId">
                                <option selected disabled>Choose status...</option>
                                @foreach($statuses as $status)
                                    <option value="{{$status['id']}}">{{$status['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">FromDate</label>
                            <input class="form-control" type="datetime-local" id="fromDate">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">ToDate</label>
                            <input class="form-control" type="datetime-local" id="toDate">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addSubmitBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Lease</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">User</label>
                            <select class="form-control" id="editUserId">
                                <option selected disabled>Choose user...</option>
                                @foreach($users as $user)
                                    <option value="{{$user['id']}}">{{$user['lastName']." ".$user['firstName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Book</label>
                            <select class="form-control" id="editBookId">
                                <option selected disabled>Choose book...</option>
                                @foreach($books as $book)
                                    <option value="{{$book['id']}}">{{$book['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Status</label>
                            <select class="form-control" id="editStatusId">
                                <option selected disabled>Choose status...</option>
                                @foreach($statuses as $status)
                                    <option value="{{$status['id']}}">{{$status['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">FromDate</label>
                            <input class="form-control" type="datetime-local" id="editFromDate">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">ToDate</label>
                            <input class="form-control" type="datetime-local" id="editToDate">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customStyle')
    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('customScript')
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Sweet alert init js-->
    <script src="{{asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('assets/js/pages/lease.js')}}"></script>
@endsection
