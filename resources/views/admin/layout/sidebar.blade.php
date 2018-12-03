<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            @can("system")
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>システム管理</span>
                    <span class="pull-right-container"></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/permissions"><i class="fa fa-circle-o"></i>権限管理</a></li>
                    <li><a href="/admin/users"><i class="fa fa-circle-o"></i>ユーザー管理</a></li>
                    <li><a href="/admin/roles"><i class="fa fa-circle-o"></i>役割管理</a></li>
                </ul>
            </li>
            @endcan
            @can("post")
            <li class="active treeview">
                <a href="/admin/posts">
                    <i class="fa fa-dashboard"></i> <span>文章管理</span>
                </a>
            </li>
                @endcan
                @can("topic")
            <li class="active treeview">
                <a href="/admin/topics">
                    <i class="fa fa-dashboard"></i> <span>ジャンル管理</span>
                </a>
            </li>
                @endcan
                @can('notice')
            <li class="active treeview">
                <a href="/admin/notices">
                    <i class="fa fa-dashboard"></i> <span>通知管理</span>
                </a>
            </li>
                    @endcan
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>