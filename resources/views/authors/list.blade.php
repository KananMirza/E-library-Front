@extends('layouts.master')
@section('title','E-library | Authors')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Authors</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Authors</li>
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

                            <h4 class="card-title">Author List</h4>
                            <div class="d-flex justify-content-start my-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="fas fa-user-plus font-size-16 align-middle me-2"></i> Add Author
                                </button>
                            </div>
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Create Date</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody id="tableBody">
                                @if(count($authors) == 0)
                                    <tr>
                                        <td colspan="12" class="text-center">Authors not found!</td>
                                    </tr>
                                @else
                                    @foreach($authors as $key=>$author)
                                        <tr data-id="{{$author['id']}}" class="authors">
                                            <td>{{$key+1}}</td>
                                            <td>{{$author['name']}}</td>
                                            <td>{{$author['surname']}}</td>
                                            <td>{{$author['description']}}</td>
                                            <td>
                                                <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                    <input class="form-check-input status" data-id="{{$author['id']}}" data-status="@if($author['status'] == 1) 0 @else 1 @endif" type="checkbox" id="SwitchCheckSizelg" @if($author['status'] == 1) checked @endif>
                                                    <label class="form-check-label" for="SwitchCheckSizelg">@if($author['status'] == 1) Active @else Deactive @endif</label>
                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($author['createdAt'])->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning waves-effect waves-light editBtn" data-id="{{$author['id']}}"><i class="fas fa-pencil-alt"></i></button>
                                                <button type="button" class="btn btn-danger waves-effect waves-light deleteBtn" data-id="{{$author['id']}}"><i class="fas fa-trash-alt"></i></button>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="id">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="col-form-label">Surname:</label>
                            <input type="text" class="form-control" id="surname">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="id">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="addName">
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="col-form-label">Surname:</label>
                            <input type="text" class="form-control" id="addSurname">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="addDescription"></textarea>
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
    <script>
        $(document).on('click','.editBtn',async function (){
            showLoader();
            try {
                let id = $(this).data('id');
                let response = await ajaxRequest("GET","/author/get/"+id,{})
                let data = checkData(response);
                viewEditModal(data);
            }catch (e) {
                Swal.fire({
                    title: "Error!",
                    text: e.message,
                    icon: "warning",
                    showCancelButton: !1,
                    confirmButtonColor: "#556ee6"
                })
            }finally {
                hideLoader();
            }
        })
        $(document).on('click','#submitBtn',async function (){
            showLoader();
            try {
                let id = $("#id").val();
                let name = $("#name").val();
                let surname = $("#surname").val();
                let description = $("#description").val();
                let requestData = {id,name,surname,description};
                let response = await ajaxRequest("POST","/author/update",requestData)
                let message = checkDataCreateOrUpdate(response);
                successAlert(message);
                setTimeout(function (){
                    location.reload();
                },2000)
            }catch (e){
              errorAlert(e.message);
            }finally {
                hideLoader();
            }
        })
        $(document).on('click','#addSubmitBtn',async function () {
            showLoader();
            try {
                let name = $("#addName").val();
                let surname = $("#addSurname").val();
                let description = $("#addDescription").val();
                let requestData = {name,surname,description};
                let response = await ajaxRequest("POST","/author/create",requestData)
                let message = checkDataCreateOrUpdate(response);
                successAlert(message);
                setTimeout(function (){
                    location.reload();
                },2000)
            }catch (e){
                errorAlert(e.message);
            }finally {
                hideLoader();
            }
        })
        $(document).on('change','.status',async function (){
            showLoader();
            try {
                let id = $(this).data('id');
                let status = $(this).data('status');
                let requestData = {id,status};
                let response = await ajaxRequest("POST","/author/change-status",requestData);
                let message = checkDataCreateOrUpdate(response);
                successAlert(message);
                $(this).data('status',status === 1 ? 0 : 1);
            }catch (e) {
                errorAlert(e.message);
            }finally {
                hideLoader();
            }
        })
        $(document).on('click','.deleteBtn',async function () {
            showLoader();
            try {
                let id = $(this).data('id');
                let row = $(this).closest('tr');
                let response = await ajaxRequest("POST","/author/delete",{id});
                let message = checkDataCreateOrUpdate(response);
                row.remove();
                let authorCount = $(".authors").length;
                if(authorCount === 0){
                  tableZeroData("Authors")
                }
                hideLoader()
                successAlert(message)
            }catch (e){
                errorAlert(e.message);
            }finally {
                hideLoader()
            }
        })
        //helper
        function viewEditModal(data){
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#surname').val(data.surname);
            $('#description').text(data.description);
            $("#editModal").modal('show')
        }
    </script>
@endsection
