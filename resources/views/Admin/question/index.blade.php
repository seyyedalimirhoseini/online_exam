@extends('Admin.layouts.main_layout')
@section('title', 'صفحه لیست سوالات')
@section('css')


    <link rel="stylesheet" href={{asset("/admin/plugins/datatables/dataTables.bootstrap4.css")}}>


@endsection
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">لیست سوالات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">لیست سوالات</li>
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
                        <h3 class="card-title">لیست سوالات</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>سوال</th>
                                <th>گزینه 1</th>
                                <th>گزینه 2</th>
                                <th>گزینه 3</th>
                                <th>گزینه 4</th>
                                <th>پاسخ صحیح</th>
                                <th>بارم سوال</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($questions as $question)
                                <?php
                                $i = 1;
                                ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{Str::limit($question->question,30)}}</td>
                                    <td>{{Str::limit($question->option1,30)}}</td>
                                    <td>{{Str::limit($question->option2,30)}}</td>
                                    <td>{{Str::limit($question->option3,30)}}</td>
                                    <td>{{Str::limit($question->option4,30)}}</td>
                                    <td>{{Str::limit($question->answer,30)}}</td>
                                    <td>{{$question->grade}}</td>

                                    <td>
                                        <a href="{{route('questions.edit',$question->id)}}" class="btn btn-primary btn-sm">ویرایش</a>

                                    </td>
                                    <td>

                                        <form action="{{route('questions.destroy',$question->id)}}" method="post">
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
