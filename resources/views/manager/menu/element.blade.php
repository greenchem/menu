@extends('init')

@section('css')
<title>菜單 - 新增元素系統</title>
@stop

@section('js')

@stop

@section('content')
    @include('manager.header')

    <div class="container">
        <div class="row text-right">
            <button class="btn btn-primary">新增元素</button>
        </div>
        <table class="table table-striped" id="menuTable">
            <thead>
                <tr>
                    <th>名稱</th>
                    <th>單位</th>
                    <th>數量</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>百事可樂</td>
                    <td>瓶</td>
                    <td>1</td>
                    <td>
                        <button class="btn btn-primary">編輯</button>
                        <button class="btn btn-danger">刪除</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">新增元素</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

