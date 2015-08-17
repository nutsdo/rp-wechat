@extends('layouts.ucenter.ucenter')
@section('flash-message')
 @if (Session::has('flash_notification.message'))
     <div class="alert alert-{{ Session::get('flash_notification.level') }}">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

         {{ Session::get('flash_notification.message') }}
     </div>
 @endif
 @stop
 @section('right')
 <div class="col-md-9 mailbox-right">
    @include('ucenter.public.vote.nav')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">投票列表</h3>

            <div class="panel-options">
                <a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span>
                </a>
                <a href="#" data-toggle="remove">
                    &times;
                </a>
            </div>
        </div>
        <div class="panel-body">

            <script type="text/javascript">
            jQuery(document).ready(function($)
            {
                $("#vote-table").dataTable({
                    aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                    ]
                });
            });
            </script>

            <table id="vote-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>名称</th>
                        <th>报名人数</th>
                        <th>投票人数</th>
                        <th>浏览量</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>操作</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>名称</th>
                        <th>报名人数</th>
                        <th>投票人数</th>
                        <th>浏览量</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>操作</th>
                    </tr>
                </tfoot>

                <tbody>
                @foreach($votes  as $vote)
                    <tr>
                        <td>{{$vote->id}}</td>
                        <td>{{$vote->name}}</td>
                        <td>{{$vote->join_count}}</td>
                        <td>{{$vote->vote_count}}</td>
                        <td>{{$vote->view_count}}</td>
                        <td>{{$vote->start_at}}</td>
                        <td>{{$vote->end_at}}</td>
                        <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                                操作 <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-black" role="menu">
                                <li>
                                    <a href="{{route('ucenter.wechat.vote.edit',[$wechatId,$vote->id])}}">编辑</a>
                                </li>
                                <li>
                                    {!! Form::open(['route'=>['ucenter.wechat.vote.destroy',$wechatId,$vote->id],'method'=>'DELETE']) !!}
                                    {!! Form::submit('删除',['class'=>'btn btn-black btn-sm']) !!}
                                    {!! Form::close() !!}
                                </li>
                                <li>
                                    <a href="{{route('ucenter.wechat.vote.show',[$wechatId,$vote->id])}}">预览</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">其他</a>
                                </li>
                            </ul>
                        </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
 </div>
 @stop

 @section('left')
    @include('ucenter.left')
 @stop

@section('style')
    {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
@stop
@section('script')
    {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
    {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
    {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
@stop