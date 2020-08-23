@extends('Admin.layouts.main_layout')
@section('title', 'صفحه نقش ها ')
@section('css')


    <link rel="stylesheet" href={{asset("/admin/plugins/datatables/dataTables.bootstrap4.css")}}>


@endsection
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> نقش ها</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active"> نقش ها</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @include('message')
    <section class="content">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> نقش ها</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام کاربر</th>
                                <th>ایمیل</th>
                                <th>نقش</th>
                                <th>سطح دسترسی</th>
                                <th>بروزرسانی</th>
                                <th>حذف</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($users as $user)
                                <?php
                                $i = 1;
                                ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <form  method="post" action="{{route('roles.update',$user->id)}}">
                                        @csrf
                                        {{method_field('PATCH')}}
                                    <td>
                                        <div class="form-group">

                                            <div class="controls">
                                                <select name="role" id="type" class="form-control" >
                                                    <option value="admin">مدیر</option>
                                                    <option value="teacher">استاد</option>
                                                    <option value="user">کاربر</option>


                                                </select>

                                            </div>

                                        </div>

                                    </td>
                                        <td >
                                            <input type="submit" value="بروزرسانی" class="btn btn-success"></td>


                                    </form>
                                    <td>
                                        <form action="{{route('roles.destroy',$user->id)}}" method="post">
                                            {{method_field('delete')}}
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">حدف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('script')

    <script src={{asset("/admin/plugins/datatables/jquery.dataTables.js")}}></script>
    <script src={{asset("/admin/plugins/datatables/dataTables.bootstrap4.js")}}></script>

    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "language": {
                    "paginate": {
                        "next": "بعدی",
                        "previous": "قبلی"
                    }
                },
                "info": false,
            });
            $('#example2').DataTable({
                "language": {
                    "paginate": {
                        "next": "بعدی",
                        "previous": "قبلی"
                    }
                },
                "info": false,
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "autoWidth": false
            });
        });
    </script>
@endsection
