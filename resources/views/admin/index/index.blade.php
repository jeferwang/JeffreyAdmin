@extends('layouts.admin')
@section('title','首页 | 后台管理')
@section('content')
    <div class="row">
        <div class="col-md-6">
			<pre>
                {{dump($adminMenu[0]->isActive())}}
			</pre>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <h4 class="panel-heading">运行环境</h4>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered table-striped">
                        <tr>
                            <td class="nowrap">服务器软件</td>
                            <td>{{$_SERVER['SERVER_SOFTWARE']}}</td>
                        </tr>
                        <tr>
                            <td class="nowrap">PHP版本</td>
                            <td>{{PHP_VERSION}}</td>
                        </tr>
                        <tr>
                            <td class="nowrap">数据库软件</td>
                            <td>{{$_SERVER['DB_CONNECTION']}}</td>
                        </tr>
                        <tr>
                            <td class="nowrap">网站根目录</td>
                            <td>{{$_SERVER['DOCUMENT_ROOT']}}</td>
                        </tr>
                        <tr>
                            <td class="nowrap">访问IP</td>
                            <td>{{$_SERVER['REMOTE_ADDR']}}</td>
                        </tr>
                        <tr>
                            <td class="nowrap">脚本文件名</td>
                            <td>{{$_SERVER['SCRIPT_FILENAME']}}</td>
                        </tr>
                        <tr>
                            <td class="nowrap">调试模式</td>
                            <td>{{$_SERVER['APP_DEBUG'] ? '开启' : '关闭'}}</td>
                        </tr>
                        <tr>
                            <td class="nowrap">浏览器信息</td>
                            <td>{{$_SERVER['HTTP_USER_AGENT']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection