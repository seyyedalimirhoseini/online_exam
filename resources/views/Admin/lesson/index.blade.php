@extends('Admin.layouts.main_layout')
@section('title', 'صفحه لیست دروس ')
@section('css')


    <link rel="stylesheet" href={{asset("/admin/plugins/datatables/dataTables.bootstrap4.css")}}>


@endsection
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">لیست دروس</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">لیست دروس</li>
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
                        <h3 class="card-title">لیست دروس</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام درس</th>
                                <th>واحد درس</th>
                                <th>نام استاد</th>
                                @if(auth()->user()->role == "admin")
                                <th>وضعیت</th>
                                @endif
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($lessons as $lesson)
                                <?php
                                $i = 1;
                                ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$lesson->name}}</td>
                                    <td>{{$lesson->value}}</td>
                                    <td>{{$lesson->user->name}}</td>
                                    @can('changeState', $lesson)
                                        @if($lesson->status == 0)
                                            <td><a  href="{{route('active.lesson',$lesson->id)}}"  class="btn btn-success btn-mini">فعال</a></td>
                                        @else
                                            <td><a  href="{{route('inactive.lesson',$lesson->id)}}"  class="btn btn-danger btn-mini">غیر فعال</a></td>
                                        @endif
                                    @endcan
                                    <td>
                                        <a href="{{route('lessons.edit',$lesson->id)}}" class="btn btn-primary btn-sm">ویرایش</a>

                                    </td>
                                    <td>
                                        <form action="{{route('lessons.destroy',$lesson->id)}}" method="post">
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
