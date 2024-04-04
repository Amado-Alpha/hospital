@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-user-md"></span> Nurses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Nurse</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (session('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @elseif (session('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ session('error') }}');
            });
        </script>
    @endif
    @if ($errors->has('f_name'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('f_name') }}');
            });
        </script>
    @endif

    @if ($errors->has('l_name'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('l_name') }}');
            });
        </script>
    @endif
    @if ($errors->has('gender'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('f_name') }}');
            });
        </script>
    @endif

    @if ($errors->has('phone_number'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('phone_number') }}');
            });
        </script>
    @endif


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Nurses</h3>
                    <button type="button" class="btn btn-small btn-primary float-right" data-toggle="modal"
                        data-target="#addnurse"><i class="fa fa-plus"></i> Register new nurse</button>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Nurse Number</th>
                                {{-- <th>Status</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nurses as $nurse)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $nurse->f_name }} {{ $nurse->l_name }}</td>
                                    <td>{{ $nurse->gender }}</td>
                                    <td>{{ $nurse->phone_number }}</td>
                                    <td>{{ $nurse->nurse_number }}</td>
                                    {{-- <td><span class="badge badge-success"> active</span></td> --}}
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{-- <button class="btn btn-sm btn-secondary"><span
                                                    class="fa fa-edit"></span></button> --}}
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#deletemodal"><span class="fa fa-trash"></span></button>
                                        </div>
                                    </td>
                                    {{-- <td>Ansi Space</td> --}}
                                </tr>
                                @php
                                    $no++;
                                @endphp

                                <!-- Modal -->
                                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('deletenurse') }}" method="POST">
                                                    @csrf
                                                    <div>
                                                        <div class="col col-md-12">
                                                            <p>Are you sure you want to delete this bed?</p>
                                                            <input type="hidden" value="{{ $nurse->id }}"
                                                                name="nurse_id">
                                                        </div>

                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Yes! Delete it</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.content -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="addnurse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Nurse Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addnurse') }}" method="POST">
                        @csrf
                        <div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label for="">Enter First Name</label>
                                    <input type="text" name="f_name" placeholder="Enter first name ..."
                                        class="form-control" id="" required>
                                </div>
                                <div class="col col-md-6">
                                    <label for="">Enter last Name</label>
                                    <input type="text" name="l_name" placeholder="Enter first name ..."
                                        class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label for="">Select gender</label>
                                    <select name="gender" class="form-control" id="" required>
                                        <option value="" selected disabled>-Choose gender-</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col col-md-6">
                                    <label for="">Enter Phone Number</label>
                                    <input type="text" name="phone_number" placeholder="255654554455 ..."
                                        class="form-control" id="" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Nurse</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
