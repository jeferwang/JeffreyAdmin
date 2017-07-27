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
                    <label for="icon_class" class="control-label">ICON图标样式</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span>图标 : </span>
                            <span id="preview-icon"></span>
                        </span>
                        <input class="form-control" name="icon_class" id="icon_class" placeholder="Linearicons/FontAwesome" oninput="$('#preview-icon').attr('class',this.value)">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <a href="javascript:void(0)" class="btn btn-success btn-block" id="add-menu-button">
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
                        <th>图标</th>
                        <th>菜单名</th>
                        <th>路由名称</th>
                        <th>链接地址</th>
                        <th colspan="2">操作</th>
                    </tr>
                    @foreach($menus as $menu)
                        <tr>
                            <td>
                                @if($menu->icon_class!=null)
                                    <span class="{{$menu->icon_class}}"></span>
                                @endif
                            </td>
                            <td>{{$menu->text}}</td>
                            <td>{{$menu->route_name}}</td>
                            <td>
                                <a href="{{$menu->route_name!=null?call_user_func_array('route',[$menu->route_name]):$menu->url}}">
                                    {{$menu->route_name!=null?call_user_func_array('route',[$menu->route_name]):$menu->url}}
                                </a>
                            </td>
                            <td>
                                <a href="{{route('admin.menu.alter-admin-menu',['mid'=>$menu->id])}}" class="btn btn-warning btn-xs">
                                    <span class="fa fa-pencil-square-o"></span>
                                    修改
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="deleteMenu({{$menu->id}})">
                                    <span class="fa fa-close"></span>
                                    删除
                                </a>
                            </td>
                        </tr>
                        @if(!$menu->submenus->isEmpty())
                            @foreach($menu->submenus as $submenu)
                                <tr>
                                    <td>
                                        @if($submenu->icon_class!=null)
                                            <span class="{{$submenu->icon_class}}"></span>
                                        @endif
                                    </td>
                                    <td>----{{$submenu->text}}</td>
                                    <td>{{$submenu->route_name}}</td>
                                    <td>
                                        <a href="{{$submenu->route_name!=null?call_user_func_array('route',[$submenu->route_name]):$submenu->url}}">
                                            {{$submenu->route_name!=null?call_user_func_array('route',[$submenu->route_name]):$submenu->url}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.menu.alter-admin-menu',['mid'=>$submenu->id])}}" class="btn btn-warning btn-xs">
                                            <span class="fa fa-pencil-square-o"></span>
                                            修改
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="deleteMenu({{$submenu->id}})">
                                            <span class="fa fa-close"></span>
                                            删除
                                        </a>
                                    </td>
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
        // 初始化AjaxForm
        $().ready(function () {
            $('#add-form').ajaxForm();
        });
        // 添加新菜单
        $('#add-menu-button').on('click', function (eve) {
            // 自定义成功之后的操作
            ajaxFormOptions.success = function (data) {
                if (data.status === 'success') {
                    layer.alert(data.msg, {
                        icon: 6
                        , closeBtn: false
                        , btn: ['刷新']
                        , yes: function () {
                            location.reload(true);
                        }
                    });
                } else {
                    layer.alert(data.msg, {icon: 5});
                }
            };
            // 带上配置进行提交
            $('#add-form').ajaxSubmit(ajaxFormOptions);
        });

        // 删除菜单
        function deleteMenu(mid) {
            layer.alert('确认删除此菜单以及所包含的子菜单吗 ? ', {
                icon: 3
                , btn: ['删除', '取消']
                , yes: function () {
                    ajaxOption.method = 'POST';
                    ajaxOption.url = '{{route('admin.menu.del-admin-menu')}}';
                    ajaxOption.data = {'_token': csrfToken, 'mid': mid};
                    ajaxOption.success = function (data) {
                        if (data.status === 'success') {
                            layer.alert(data.msg, {
                                icon: 6
                                , closeBtn: false
                                , btn: ['刷新']
                                , yes: function () {
                                    location.reload(true);
                                }
                            });
                        } else {
                            layer.alert(data.msg, {icon: 5});
                        }
                    };
                    $.ajax(ajaxOption);
                }
            })
        }
    </script>
@endsection