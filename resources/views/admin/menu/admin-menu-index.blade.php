@extends('layouts.admin')
@section('title','后台菜单管理 | 后台管理')
@section('content')
    <div class="row">
        <div class="col-md-12 panel">
            <h4 class="panel-heading">
                添加新菜单
            </h4>
            <form class="panel-body" method="post" action="{{route('admin.menu.add-admin-menu')}}" id="add-form">
                {{csrf_field()}}
                <div class="form-group col-md-2">
                    <label for="text" class="control-label">菜单名称</label>
                    <input class="form-control" name="text" id="text" placeholder="输入名称">
                </div>
                <div class="form-group col-md-2">
                    <label for="pid" class="control-label">上级菜单</label>
                    <select class="form-control" name="pid" id="pid">
                        <option value="0">( NULL )</option>
                        @foreach($menus as $menu)
                            <option value="{{$menu->id}}">{{$menu->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="route_name" class="control-label">路由Name</label>
                    <input class="form-control" name="route_name" id="route_name" placeholder="路由名称">
                </div>
                <div class="form-group col-md-2">
                    <label for="url" class="control-label">非路由链接</label>
                    <input class="form-control" name="url" id="url" placeholder="http://">
                </div>
                <div class="form-group col-md-2">
                    <label for="icon" class="control-label">ICON图标样式</label>
                    <input class="form-control" name="icon" id="icon" placeholder="Linearicons/FontAwesome">
                </div>
                <div class="form-group col-md-2">
                    <a href="javascript:void(0)" class="btn btn-success" id="add-menu-button">
                        <span class="fa fa-plus"></span>
                        <br>
                        添加菜单
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 panel">
            <h4 class="panel-heading">后台菜单列表</h4>
            <div class="panel-body">
                <table class="table table-responsive table-bordered table-hover">
                    <tr>
                        <th>菜单名</th>
                        <th>路由名称</th>
                        <th>链接地址</th>
                        <th colspan="2">操作</th>
                    </tr>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{$menu->text}}</td>
                            <td>{{$menu->route_name}}</td>
                            <td>
                                <a href="{{$menu->route_name!=null?call_user_func_array('route',[$menu->route_name]):$menu->url}}">
                                    {{$menu->route_name!=null?call_user_func_array('route',[$menu->route_name]):$menu->url}}
                                </a>
                            </td>
                            <td>修改</td>
                            <td>删除</td>
                        </tr>
                        @if(!$menu->submenus->isEmpty())
                            @foreach($menu->submenus as $submenu)
                                <tr>
                                    <td>----{{$submenu->text}}</td>
                                    <td>{{$submenu->route_name}}</td>
                                    <td>
                                        <a href="{{$submenu->route_name!=null?call_user_func_array('route',[$submenu->route_name]):$submenu->url}}">
                                            {{$submenu->route_name!=null?call_user_func_array('route',[$submenu->route_name]):$submenu->url}}
                                        </a>
                                    </td>
                                    <td>修改</td>
                                    <td>删除</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
@section('foot')
    <script>
        $().ready(function () {
            $('#add-form').ajaxForm();
        });
        $('#add-menu-button').on('click', function (eve) {
            $('#add-form').ajaxSubmit({
                beforeSubmit: function () {
                    layer.load(1);
                }
                , complete: function () {
                    layer.closeAll('loading');
                }
                , success: function (data) {
                    if (data.status === 'success') {
                        layer.alert(data.msg, {
                            icon: 6
                            ,closeBtn:false
                            , btn: ['刷新']
                            , yes: function () {
                                location.reload(true);
                            }
                        });
                    } else {
                        layer.alert(data.msg, {icon: 5});
                    }
                }
                , error: function () {
                    layer.alert('网络服务器错误,请刷新重试 ! ', {icon: 2});
                }
            });
        });
    </script>
@endsection