<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/30
 * Time: 上午11:22
 */
 ?>
  @extends('layouts.admin.admin')
  @section('page-title')
  <div class="page-title">
      <div class="title-env">
          <h1 class="title">内容管理</h1>
          <p class="description">Dynamic table variants with pagination and other controls</p>
      </div>
      <div class="breadcrumb-env">

          <ol class="breadcrumb bc-1">
              <li>
                  <a href="dashboard-1.html"><i class="fa-home"></i>Dashboard</a>
              </li>
              <li>

                  <a href="tables-basic.html">内容管理</a>
              </li>
              <li class="active">

                  <strong>中奖用户</strong>
              </li>
          </ol>

      </div>
  </div>
  @stop

   @section('flash-message')
   @if (Session::has('flash_notification.message'))
       <div class="alert alert-{{ Session::get('flash_notification.level') }}">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

           {{ Session::get('flash_notification.message') }}
       </div>
   @endif
   @stop


  @section('content')

<!-- Removing search and results count filter -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">中奖用户</h3>

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
                                   $("#example-2").dataTable({
                                     dom: "t" + "<'row'<'col-xs-6'i><'col-xs-6'p>>",
                                     aoColumns: [
                                                 {bSortable: false},
                                                 null,
                                                 null,
                                                 null,
                                                 null,
                                                 ]
                                     });

                                   // Replace checkboxes when they appear
                                   var $state = $("#example-2 thead input[type='checkbox']");

                                   $("#example-2").on('draw.dt', function()
                                                      {
                                                      cbr_replace();

                                                      $state.trigger('change');
                                                      });

                                   // Script to select all checkboxes
                                   $state.on('change', function(ev)
                                             {
                                             var $chcks = $("#example-2 tbody input[type='checkbox']");

                                             if($state.is(':checked'))
                                             {
                                             $chcks.prop('checked', true).trigger('change');
                                             }
                                             else
                                             {
                                             $chcks.prop('checked', false).trigger('change');
                                             }
                                             });
                                   });
                                </script>

        <table class="table table-bordered table-striped" id="example-2">
            <thead>
                <tr>
                    <th class="no-sorting">
                        <input type="checkbox" class="cbr">
                    </th>
                    <th>中奖用户</th>
                    <th>兑奖码</th>
                    <th>活动id</th>
                    <th>中奖时间</th>
                    <th>操作</th>
                </tr>
            </thead>

            <tbody class="middle-align">
                @foreach($winners as $winner)
                <tr>
                    <td>
                        <input type="checkbox" class="cbr">
                    </td>
                    <td>{{ $winner->user_id }}</td>
                    <td>{{ $winner->cdkey }}</td>
                    <td>{{ $winner->event_id }}</td>
                    <td>{{ $winner->created_at }}</td>
                    <td>
                    @if($winner->is_cash==0)
                        <a href="{{ route('admin.event.winnercash',$winner->id) }}" class="btn btn-success">未兑奖</a>
                    @else
                        <button class="btn btn-warning">已兑奖</button>
                    @endif

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>

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