@extends("admin.layout.main")

@section("content")
<!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">新規管理者</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="/admin/users/store" method="POST">
                               {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">管理者名</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">パスワード</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">提出</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    @endsection