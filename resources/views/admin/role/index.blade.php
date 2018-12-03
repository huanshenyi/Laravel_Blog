@extends("admin.layout.main")
 @section("content")
<!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">役割リスト</h3>
                        </div>
                        <a type="button" class="btn " href="/admin/roles/create" >新規役割</a>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody><tr>
                                    <th style="width: 10px">#</th>
                                    <th>役割名</th>
                                    <th>役割詳細</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}.</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        <a type="button" class="btn" href="/admin/roles/{{$role->id}}/permission" >権限管理</a>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$roles->links()}}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
@endsection