@extends('layouts.master')
@section('title','E-library | Book || Edit')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Book</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Edit Book</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Book</h5>

                            <form action="{{route('updateBook')}}" method="POST" enctype="multipart/form-data">
                                @include('layouts.message')
                                @csrf
                                <input type="hidden" name="id" value="{{$book['id']}}">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="form-floating mb-3">
                                            <p>Current image: </p>
                                            <img style="width: 250px;height: 250px" src="data:image/png;base64, {{$book['image']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{$book['seriaId']}}" placeholder="Enter SeriaId" name="seriaId">
                                            <label for="floatingnameInput">SeriaId</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" value="{{$book['title']}}" class="form-control" placeholder="Enter title" name="title">
                                            <label for="floatingnameInput">Title</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Description</label>
                                            <textarea  name="description" class="form-control" cols="15" rows="3">{{$book['description']}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Penaly Amount (AZN)</label>
                                            <input data-toggle="touchspin" value="{{$book['penaltyAmount']}}" type="text" data-step="0.1"
                                                   data-decimals="2" name="penaltyAmount">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Count</label>
                                            <input data-toggle="touchspin" value="{{$book['count']}}" type="text" data-step="1" name="count">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Publishing Year</label>
                                            <div class="position-relative" id="datepicker5">
                                                <input value="{{$book['yearPublishing']}}" type="text" class="form-control" data-provide="datepicker" data-date-container='#datepicker5'
                                                       data-date-format="yyyy" data-date-min-view-mode="2" name="yearPublishing">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Shelf</label>
                                        <div class="form-floating mb-3">
                                            <select class="form-control select2" name="shelfId">
                                                <option disabled="disabled" selected="selected">Select</option>
                                                @foreach($shelves as $shelf)
                                                    <option value="{{$shelf['id']}}" @if($shelf['id'] == $book['shelf']['id']) selected @endif>{{$shelf['shelfNo']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Categories</label>
                                        <div class="form-floating mb-3">
                                            <select class="select2 form-control select2-multiple"
                                                    multiple="multiple" data-placeholder="Choose ..." name="categoriesId[]">
                                                @foreach($categories as $category)
                                                    <?php
                                                        $selectedCategory = "";
                                                        foreach ($book['categories'] as $bookCategory){
                                                            if($bookCategory['id'] == $category['id']){
                                                                $selectedCategory = "selected";
                                                            }
                                                        }
                                                        ?>
                                                    <option value="{{$category['id']}}" {{$selectedCategory}}>{{$category['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Authors</label>
                                        <div class="form-floating mb-3">
                                            <select class="select2 form-control select2-multiple"
                                                    multiple="multiple" data-placeholder="Choose ..." name="authorsId[]">
                                                @foreach($authors as $author)
                                                        <?php
                                                        $selectedAuthor = "";
                                                        foreach ($book['authors'] as $bookAuthor){
                                                            if($bookAuthor['id'] == $author['id']){
                                                                $selectedAuthor = "selected";
                                                            }
                                                        }
                                                        ?>
                                                    <option value="{{$author['id']}}" {{$selectedAuthor}}>{{$author['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Publishers</label>
                                        <div class="form-floating mb-3">
                                            <select class="select2 form-control select2-multiple"
                                                    multiple="multiple" data-placeholder="Choose ..." name="publishersId[]">
                                                @foreach($publishers as $publisher)
                                                        <?php
                                                        $selectedPublisher = "";
                                                        foreach ($book['publishers'] as $bookPublisher){
                                                            if($bookPublisher['id'] == $publisher['id']){
                                                                $selectedPublisher = "selected";
                                                            }
                                                        }
                                                        ?>
                                                    <option value="{{$publisher['id']}}" {{$selectedPublisher}}>{{$publisher['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Image</label>
                                            <input class="form-control" type="file" name="image" id="formFile">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection

@section('customStyle')
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/libs/%40chenfengyuan/datepicker/datepicker.min.css')}}">
@endsection
@section('customScript')
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/libs/%40chenfengyuan/datepicker/datepicker.min.js')}}"></script>
    <!-- form advanced init -->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
    <script src="{{asset('assets/js/pages/book.js')}}"></script>
@endsection

