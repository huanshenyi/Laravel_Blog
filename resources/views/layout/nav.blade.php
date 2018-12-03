<div class="blog-masthead">
    <div class="container">
        <form action="/posts/search">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="blog-nav-item " href="/posts">ホームページ</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/posts/create">新規文章</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/notices">お知らせ</a>
            </li>
            <li>
                <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="キーワード">
            </li>
            <li>
                <button class="btn btn-default" style="margin-top:10px" type="submit">Go!</button>
            </li>
        </ul>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <div>
                    <img src="{{\Auth::user()->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 30px">
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/user/{{\Auth::id()}}">プロフィール</a></li>
                        <li><a href="/user/me/setting">詳細設定</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>