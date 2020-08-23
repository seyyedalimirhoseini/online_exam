@extends('Admin.layouts.main_layout')
@section('title', 'صفحه اطلاعات آزمون')
@section('css')


    <link rel="stylesheet" href={{asset("/admin/plugins/datatables/dataTables.bootstrap4.css")}}>


@endsection
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">لیست اطلاعات آزمون</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">اطلاعات آزمون</li>
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
                        <h3 class="card-title">لیست اطلاعات آزمون</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>تعداد سوالات</th>
                                <th>زمان ویدئو</th>
                                <th>نام استاد</th>
                                <th>نام فصل</th>
{{--                                <th>وضعیت امتحان</th>--}}
{{--                                @if(auth()->user()->role == "admin")--}}
{{--                                    <th>وضعیت</th>--}}
{{--                                @endif--}}
                                <th>ویرایش</th>
                                <th>حذف</th>
                                <th>ایجاد سوال</th>
                                <th>لیست سوالات</th>
                            </tr>
                            </thead>


                            <tbody>

                            @foreach($exam_infos as $exam_info)
                                <?php
                                $i = 1;
                                ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$exam_info->question_number}}</td>
                                    <td>{{$exam_info->time}}دقیقه</td>
                                    <td>{{$exam_info->user->name}}</td>
                                    <td>{{$exam_info->session->name}}</td>
{{--                                    <td>{{$exam_info->final_exam == 1 ? 'امتحان نهایی' :''}}</td>--}}
{{--                                    @can('changeState', $exam_info)--}}
{{--                                        @if($exam_info->status == 0)--}}
{{--                                            <td><a  href="{{route('active.exam_info',$exam_info->id)}}"  class="btn btn-success btn-mini">فعال</a></td>--}}
{{--                                        @else--}}
{{--                                            <td><a  href="{{route('inactive.exam_info',$exam_info->id)}}"  class="btn btn-danger btn-mini">غیر فعال</a></td>--}}
{{--                                        @endif--}}
{{--                                    @endcan--}}
                                    <td>
                                        <a href="{{route('exam_infos.edit',$exam_info->id)}}"
                                           class="btn btn-primary btn-sm">ویرایش</a>

                                    </td>
                                    <td>
                                        <form action="{{route('exam_infos.destroy',$exam_info->id)}}" method="post">
                                            {{method_field('delete')}}
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">حدف</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{route('questions.createQuestion',$exam_info->id)}}"
                                           class="btn btn-outline-primary btn-sm">ایجاد سوال</a>

                                    </td>
                                    <td>
                                        <a href="{{route('questions.showQuestion',$exam_info->id)}}"
                                           class="btn btn-outline-primary btn-sm">لیست سوالات</a>

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
