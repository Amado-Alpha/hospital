@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-fa-registered"></span>Service Requests</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Request</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Request(s)</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Bed Number</th>
                                <th>Status</th>
                                <th>Requests Per Day</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $index => $request)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$request->bed_number}}</td>

                                    <td>
                                        @if ($request->status == 1)
                                        <span class="badge badge-danger">Emergency...⚠️⚠️⚠️</span>
                                        @else
                                        <span class="badge badge-success"> <span class="fa fa-check"></span> Served!💗💗💗</span>
                                        @endif
                                    </td>
                                    <td>{{$request->click_times}}</td>
                                    <td>{{date('l j'. ' , ' .'h:i A', strtotime($request->updated_at));}}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
