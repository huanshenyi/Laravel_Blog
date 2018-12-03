@extends("layout.main")
@section("content")
        <div class="col-sm-8 blog-main">
            <form action="/posts" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label>タイトル</label>
                    <input name="title" type="text" class="form-control" placeholder="タイトルを入力してください">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="内容を入力してくださ"></textarea>
                </div>
                @include("layout.error")
                <button type="submit" class="btn btn-default">提出</button>
            </form>
            <br>

        </div><!-- /.blog-main -->
@endsection