<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/11/15
 * Time: 10:55 AM
 */
 ?>
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
            <div class="panel-title">
                新建投票
            </div>
        </div>

        <div class="panel-body">

        {!! Form::open(['route'=>['ucenter.wechat.vote.store',$wechatId],'role'=>'form','class'=>'validate']) !!}

            <div class="form-group">
                <label class="control-label">名称</label>

                <input type="text" class="form-control" name="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="名称" />
            </div>

            <div class="form-group @if($errors->first('cover_url')) has-error @endif">
                <label class="control-label" for="pic_url">封面</label><br>
                <div class="col-sm-10">
                    <input  type="text" name="pic_url" class="col-sm-11 form-control"  id="pic_url" placeholder="@if($errors->first('pic_url')) {{$errors->first('pic_url')}} @else 封面图片地址 @endif">
                </div>
                <div class="col-sm-1">
                    <a href="javascript:;" onclick="jQuery('#modal-upload').modal('show');" class="btn btn-primary btn-single btn-sm">上传图片</a>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label class="control-label" for="photo">预览</label>
                <img id="preview" src=""/>
            </div>

            <div class="form-group">
                <label class="control-label">描述</label>

                <input type="text" class="form-control" name="description" data-validate="required" placeholder="描述" />
            </div>

            <div class="form-group">
                <label class="control-label">规则</label>

                <textarea type="text" class="form-control" name="rule_body" placeholder="规则" ></textarea>
            </div>

            <div class="form-group">
                <label class="control-label">每天投票次数</label>

                <input type="text" class="form-control" name="vote_times" data-validate="required" placeholder="每天投票次数" />
            </div>

            <div class="form-group">
                <label class="control-label" for="vote_time">活动时间</label>

                <input type="text" name="vote_time" id="vote_time" class="form-control daterange" data-time-picker="true" data-time-picker-increment="5" data-format="YYYY-MM-DD HH:mm:ss" placeholder="活动时间"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">保存</button>
                <button type="reset" class="btn btn-white">重置</button>
            </div>

        {!! Form::close() !!}

        </div>

    </div>
  </div>
  @stop

 @section('other')
      <script>
        jQuery(document).ready(function($)
        {
            Dropzone.options.dropZone={
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                autoProcessQueue: false,//关闭自动上传
                uploadMultiple:1,
                addRemoveLinks: true,
                parallelUploads:1,//单次上传文件个数，最大为2
                init:function(){
                    var submitButton = document.querySelector("#upload");
                    myDropzone = this; // closure

                    submitButton.addEventListener("click", function () {
                      //手动上传所有图片
                      myDropzone.processQueue();
                    });

                    //当上传完成后的事件，接受的数据为JSON格式
                    this.on("complete", function (file) {
                      if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

                        var res = eval('(' + file.xhr.responseText + ')');

                        if (res.state=='success') {
                          alert('upload success!');
                          $('#preview').attr('src',"{{url()}}" + "/" + res.url);
                          $('#pic_url').val(res.url);
                        }
                        else {
                          alert('upload failed!');
                        }

                      }
                    });

                    //删除图片的事件，当上传的图片为空时，使上传按钮不可用状态
                    this.on("removedfile", function () {
                      if (this.getAcceptedFiles().length === 0) {
                        $("#upload").attr("disabled", true);
                      }
                    });
                }
            };
        });

        </script>
        <!-- Modal 2 (Custom Width)-->
        <div class="modal fade custom-width" id="modal-upload">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">封面图片上传</h4>
                    </div>

                    <div class="modal-body">
                        <!-- Auto initialization -->
                        {!! Form::open(['route'=>['upload'],'role'=>'form','id'=>'dropZone','class'=>'dropzone','enctype'=>'multipart/form-data']) !!}
                            {!! Form::hidden('type','vote') !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <button type="button" id="upload" class="btn btn-info">上传</button>
                    </div>
                </div>
            </div>
        </div>
 @stop
@section('left')
 @include('ucenter.left')
@stop

 @section('style')
     {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
     {!! Html::style('style/assets/js/daterangepicker/daterangepicker-bs3.css') !!}
     {!! Html::style('style/assets/js/dropzone/css/dropzone.css') !!}
 @stop
 @section('script')
     {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
     {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
     {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
     {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
     {!! Html::script('style/assets/js/jquery-validate/jquery.validate.min.js') !!}

     {!! Html::script('style/assets/js/moment.min.js') !!}
     {!! Html::script('style/assets/js/daterangepicker/daterangepicker.js') !!}
     {!! Html::script('style/assets/js/datepicker/bootstrap-datepicker.js') !!}
     {!! Html::script('style/assets/js/timepicker/bootstrap-timepicker.min.js') !!}

     {!! Html::script('style/assets/js/dropzone/dropzone.min.js') !!}

 @stop