@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-fa-bed "></span>Registered Beds</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Beds</li>
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

    @if ($errors->has('bed_number'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('bed_number') }}');
            });
        </script>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Beds</h3>
                    <button type="button" class="btn btn-small btn-primary float-right" data-toggle="modal"
                        data-target="#addbed"><i class="fa fa-plus"></i> Register new beds</button>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Bed Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bed as $beds)
                                <tr>
                                    <td>{{ $beds->bed_number }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#deletemodal{{$beds->id}}"><span class="fa fa-trash"></span></button>
                                        </div>
                                    </td>
                                    {{-- <td>Ansi Space</td> --}}
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="deletemodal{{$beds->id}}" tabindex="-1" role="dialog"
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
                                                <form action="{{route('deletebed')}}" method="POST">
                                                    @csrf
                                                    <div>
                                                        <div class="col col-md-12">
                                                            <p>Are you sure you want to delete this bed?</p>
                                                            <input type="hidden" value="{{ $beds->id }}"
                                                                name="bed_id">
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
    <div class="modal fade" id="addbed" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Register Bed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addbed') }}" method="POST">
                        @csrf
                        <div>
                            <div class="col col-md-12">
                                <label for="">Enter Bed Number</label>
                                <input type="number" min="1" max="100000000" name="bed_number"
                                    placeholder="Enter bed number here ..." class="form-control" id="" required>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Register Bed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
