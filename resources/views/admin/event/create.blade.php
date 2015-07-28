<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/30
 * Time: 上午10:24
 */
 ?>
 @extends('layouts.admin.admin')
 @section('page-title')
 <div class="page-title">
     <div class="title-env">
         <h1 class="title">新活动</h1>
         <p class="description">Dynamic table variants with pagination and other controls</p>
     </div>

     <div class="breadcrumb-env">

         <ol class="breadcrumb bc-1">
             <li>
                 <a href="dashboard-1.html"><i class="fa-home"></i>Dashboard</a>
             </li>
             <li>

                 <a href="tables-basic.html">微信功能</a>
             </li>
             <li class="active">
                 <strong>活动管理</strong>
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
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">封面上传</h3>
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

                {!! Form::open(['route'=>'admin.event.store','role'=>'form','class'=>'form-horizontal',]) !!}

                    <div class="form-group @if($errors->first('title')) has-error @endif">
                        <label class="col-sm-1 control-label" for="title">标题</label>

                        <div class="col-sm-11">
                            <input type="text" name="title" class="form-control" id="title" placeholder="@if($errors->first('title')) {{$errors->first('title')}} @else 标题 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('planner')) has-error @endif">
                        <label class="col-sm-1 control-label" for="planner">策划人</label>

                        <div class="col-sm-11">
                            <input type="text" name="planner" class="form-control" id="planner" placeholder="@if($errors->first('planner')) {{$errors->first('planner')}} @else 策划人 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('description')) has-error @endif">
                        <label class="col-sm-1 control-label" for="description">描述</label>

                        <div class="col-sm-11">
                            <input type="text" name="description" class="form-control" id="description" placeholder="@if($errors->first('description')) {{$errors->first('description')}} @else 描述 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>


                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="event_time">活动时间</label>

                        <div class="col-sm-11">

                            <input type="text" name="event_time" id="event_time" class="form-control daterange" data-time-picker="true" data-time-picker-increment="5" data-format="MM/DD/YYYY h:mm A" />

                        </div>
                    </div>

                    <div class="form-group-separator"></div>


                    <div class="form-group">
                        <label class="col-sm-1 control-label"></label>

                        <div class="col-sm-11">

                            <button class="btn btn-danger">创建</button>

                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>

 @stop

 @section('style')
     {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
     {!! Html::style('style/assets/js/daterangepicker/daterangepicker-bs3.css') !!}
     {!! Html::style('style/assets/js/dropzone/css/dropzone.css') !!}
 @stop
 @section('script')

    {!! Html::script('style/assets/js/moment.min.js') !!}
    {!! Html::script('style/assets/js/daterangepicker/daterangepicker.js') !!}
    {!! Html::script('style/assets/js/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('style/assets/js/timepicker/bootstrap-timepicker.min.js') !!}

    {!! Html::script('style/assets/js/colorpicker/bootstrap-colorpicker.min.js') !!}
    {!! Html::script('style/assets/js/select2/select2.min.js') !!}
    {!! Html::script('style/assets/js/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('style/assets/js/selectboxit/jquery.selectBoxIt.min.js') !!}
    {!! Html::script('style/assets/js/tagsinput/bootstrap-tagsinput.min.js') !!}
    {!! Html::script('style/assets/js/typeahead.bundle.js') !!}
    {!! Html::script('style/assets/js/multiselect/js/jquery.multi-select.js') !!}

 @stop
