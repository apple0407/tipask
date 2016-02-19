@extends('admin/public/layout')
@section('title')站点设置@endsection
@section('content')
<section class="content-header">
    <h1>
        站点设置
        <small>站点信息设置</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.setting.website') }}"><i class="fa fa-mail-reply"></i> 返回</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.website') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">

                        <div class="form-group @if ($errors->has('website_name')) has-error @endif">
                            <label for="website_name">站点名称</label>
                            <span class="text-muted">(网站名称，将显示在页面Title处)</span>
                            <input type="text" name="website_name" class="form-control " placeholder="网站名称，将显示在页面Title处" value="{{ old('website_name',Setting()->get('website_name')) }}">
                            @if ($errors->has('website_name')) <p class="help-block">{{ $errors->first('website_name') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_url')) has-error @endif">
                            <label for="website_url">站点地址</label>
                            <span class="text-muted">(您站点的完整域名。例如: http://www.tipask.com，不要以斜杠 (“/”) 结尾)</span>
                            <input type="text" name="website_url" class="form-control " placeholder="填写您站点的完整域名" value="{{ old('website_url',Setting()->get('website_url')) }}">
                            @if ($errors->has('website_url')) <p class="help-block">{{ $errors->first('website_url') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_admin_email')) has-error @endif">
                            <label for="website_admin_email">管理员电子邮箱</label>
                            <span class="text-muted">(站点管理员的邮箱地址)</span>
                            <input type="text" name="website_admin_email" class="form-control " placeholder="填写您站点的管理员邮箱地址" value="{{ old('website_admin_email',Setting()->get('website_admin_email')) }}">
                            @if ($errors->has('website_admin_email')) <p class="help-block">{{ $errors->first('website_admin_email') }}</p> @endif
                        </div>


                        <div class="form-group @if ($errors->has('website_icp')) has-error @endif">
                            <label for="website_icp">网站备案号</label>
                            <span class="text-muted">(格式类似“京ICP证030173号”，它将显示在页面底部，没有请留空)</span>
                            <input type="text" name="website_icp" class="form-control " placeholder="格式类似“京ICP证030173号”，它将显示在页面底部，没有请留空" value="{{ old('website_icp',Setting()->get('website_icp')) }}">
                            @if ($errors->has('website_icp')) <p class="help-block">{{ $errors->first('website_icp') }}</p> @endif
                        </div>


                        <div class="form-group @if ($errors->has('website_header')) has-error @endif">
                            <label for="website_footer">页面头部扩展</label>
                            <span class="text-muted">(扩展头部信息，例如meta标签等)</span>
                            <textarea class="form-control" style="height: 100px;" name="website_header">{{ old('website_header',Setting()->get('website_header')) }}</textarea>
                            @if ($errors->has('website_header')) <p class="help-block">{{ $errors->first('website_header') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_footer')) has-error @endif">
                            <label for="website_footer">页面底部扩展</label>
                            <span class="text-muted">(扩展body前的底部信息,例如第三方统计代码等)</span>
                            <textarea class="form-control" style="height: 100px;" name="website_footer">{{ old('website_footer',Setting()->get('website_footer')) }}</textarea>
                            @if ($errors->has('website_footer')) <p class="help-block">{{ $errors->first('website_footer') }}</p> @endif
                        </div>


                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <button type="reset" class="btn btn-success">重置</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    set_active_menu('global',"{{ route('admin.setting.website') }}");
</script>
@endsection