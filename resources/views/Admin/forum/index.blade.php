@extends('Admin.layouts.main_layout')
@section('title', 'صفحه تالار گفتمان')
@section('css')


    <link rel="stylesheet" href={{asset("/admin/plugins/datatables/dataTables.bootstrap4.css")}}>


@endsection
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">تالار گفتمان</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">تالار گفتمان</li>
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
                        <h3 class="card-title">تالار گفتمان</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام درس</th>
                                <th>نام دانشجو</th>
                                <th>تاریخ ارسال</th>
                                <th>فایل پیوست شده</th>
                                <th>مشاهده</th>
                                <th>پاسخ</th>
                                <th>حذف</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($talks as $talk)
                                <?php
                                $i = 1;
                                ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$talk->lesson->name}}</td>
                                    <td>{{$talk->user->name}}</td>
                                    <td>{{jdate($talk->created_at)->format(' %d %B ، %Y')}}</td>
                                    @if($talk->file)
                                    <td><a href="{{$talk->downloadFile()}}"><img src="{{url('/images/down.png')}}"
                                                                                    style="width: 20px"></a></td>
                                    @else
                                        <td></td>
                                        @endif
                                        <td>
                                        <a href="{{route('response_forums.show',$talk->id)}}" class="btn btn-primary btn-sm">مشاهده</a>

                                    </td>
                                    <td>
                                        <a href="{{route('response_forums.create',$talk->id)}}" class="btn btn-success btn-sm">پاسخ</a>

                                    </td>
                                    <td>
                                        <form action="{{route('response_forums.destroy',$talk->id)}}" method="post">
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
