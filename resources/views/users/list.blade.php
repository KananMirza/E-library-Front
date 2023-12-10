@extends('layouts.master')
@section('title','E-library | Users')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Users</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Users</li>
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

                            <h4 class="card-title">User List</h4>
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Create Date</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody id="tableBody">
                                @if(count($users) == 0)
                                    <tr>
                                        <td colspan="12" class="text-center">Users not found!</td>
                                    </tr>
                                @else
                                    @foreach($users as $key=>$user)
                                        <tr data-id="{{$user['id']}}" class="categories">
                                            <td>{{$key+1}}</td>
                                            <td>{{$user['firstName']}}</td>
                                            <td>{{$user['lastName']}}</td>
                                            <td>{{$user['email']}}</td>
                                            <td>
                                                <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                    <input class="form-check-input status" data-id="{{$user['id']}}" data-status="@if($user['status'] == 1) 0 @else 1 @endif" type="checkbox" id="SwitchCheckSizelg" @if($user['status'] == 1) checked @endif>
                                                    <label class="form-check-label" for="SwitchCheckSizelg">@if($user['status'] == 1) Active @else Deactive @endif</label>
                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($user['createdAt'])->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-dark waves-effect waves-light viewBtn" data-id="{{$user['id']}}"><i class="fas fa-eye"></i></button>
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

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="firstName" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Surname:</label>
                            <input type="text" class="form-control" id="lastName" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Patryonomic:</label>
                            <input type="text" class="form-control" id="patryonomic" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="email" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">SeriaCode:</label>
                            <input type="text" class="form-control" id="seriaCode" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">SeriaNumber:</label>
                            <input type="text" class="form-control" id="seriaNumber" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">PinCode:</label>
                            <input type="text" class="form-control" id="fin" readonly>
                        </div>
                        <div id="phones">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    <script src="{{asset('assets/js/pages/user.js')}}"></script>
@endsection
