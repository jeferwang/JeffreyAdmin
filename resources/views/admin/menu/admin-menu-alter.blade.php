@extends('layouts.admin')
@section('title','修改菜单属性')
@section('content')
    <div class="row panel">
        <h4 class="panel-heading">修改菜单 : {{$menu->text}}</h4>
        <form action="" method="post" class="panel-body" id="alter-form">
            {{csrf_field()}}
            <div class="form-group">
                <label for="text" class="control-label">菜单名称</label>
                <input class="form-control" name="text" id="text" placeholder="输入名称" value="{{$menu->text}}">
            </div>
            <div class="form-group">
                <label for="pid" class="control-label">上级菜单</label>
                <select class="form-control" name="pid" id="pid">
                    <option value="0">( NULL )</option>
                    @foreach($menus as $m)
                        @if($menu->id != $m->id)
                            <option value="{{$m->id}}" @if($menu->pid == $m->id) selected @endif>{{$m->text}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="route_name" class="control-label">路由Name</label>
                <input class="form-control" name="route_name" id="route_name" placeholder="路由名称" value="{{$menu->route_name}}">
            </div>
            <div class="form-group">
                <label for="url" class="control-label">非路由链接</label>
                <input class="form-control" name="url" id="url" placeholder="http://" value="{{$menu->url}}">
            </div>
            <div class="form-group">
                <label for="icon_class" class="control-label">ICON图标样式</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <span>图标预览区 : </span>
                        <span id="preview-icon" class="{{$menu->icon_class}}"></span>
                    </span>
                    <input class="form-control" name="icon_class" id="icon_class" placeholder="Linearicons/FontAwesome" value="{{$menu->icon_class}}" oninput="$('#preview-icon').attr('class',this.value)">
                </div>
            </div>
            <div class="form-group">
                <a href="javascript:void(0)" class="btn btn-success" id="alter-menu-button">
                    <span class="fa fa-pencil-square-o"></span>
                    完成修改
                </a>
            </div>
        </form>
    </div>
@endsection
@section('foot')
    <script>
        $().ready(function () {
            $('#alter-form').ajaxForm();
        });
        $('#alter-menu-button').on('click', function () {
            ajaxFormOptions.success = function (data) {
                if (data.status === 'success') {
                    layer.alert(data.msg, {
                        icon: 6
                        , btn: ['返回', '留下']
                        , yes: function () {
                            location.href = '{{route('admin.menu.admin-menu-index')}}'
                        }
                    });
                } else {
                    layer.alert(data.msg, {icon: 5});
                }
            };
            $('#alter-form').ajaxSubmit(ajaxFormOptions);
        });
    </script>
@endsection