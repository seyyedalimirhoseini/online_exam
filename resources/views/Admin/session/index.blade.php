@extends('Admin.layouts.main_layout')
@section('title', 'صفحه لیست فصول درسی')
@section('css')


    <link rel="stylesheet" href={{asset("/admin/plugins/datatables/dataTables.bootstrap4.css")}}>


@endsection
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">لیست فصول درسی</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">فصول درسی</li>
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
                        <h3 class="card-title">لیست فصول درسی</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام فصل</th>
                                <th>نام استاد</th>
                                <th>فایل</th>
                                <th>ویدئو</th>
                                <th>زمان ویدئو</th>
                                <th>نام درس</th>
                                @if(auth()->user()->role == "admin")
                                    <th>وضعیت</th>
                                @endif
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>


                            <tbody>

                            @foreach($sessions as $session)
                                <?php
                                $i = 1;
                                ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$session->name}}</td>
                                    <td>{{$session->user->name}}</td>
                                    @if($session->file)

                                    <td><a href="{{$session->downloadFile()}}"><img src="{{url('/images/down.png')}}"
                                                                             style="width: 20px"></a></td>


                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($session->video))
                                    <td><a href="{{$session->downloadVideo()}}"><img src="{{url('/images/down.png')}}"
                                                                             style="width: 20px"></a></td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{$session->time}}</td>
                                    <td>{{$session->lesson->name}}</td>
                                    @can('changeState', $session)
                                        @if($session->status == 0)
                                            <td><a  href="{{route('active.session',$session->id)}}"  class="btn btn-success btn-mini">فعال</a></td>
                                        @else
                                            <td><a  href="{{route('inactive.session',$session->id)}}"  class="btn btn-danger btn-mini">غیر فعال</a></td>
                                        @endif
                                    @endcan
                                    <td>
                                        <a href="{{route('sessions.edit',$session->id)}}"
                                           class="btn btn-primary btn-sm">ویرایش</a>

                                    </td>
                                    <td>
                                        <form action="{{route('sessions.destroy',$session->id)}}" method="post">
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
