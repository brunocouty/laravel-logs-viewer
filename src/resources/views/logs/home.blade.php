<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Logs</title>
    <link rel="stylesheet" href="{{ asset('vendor/laravel-logs-viewer/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/laravel-logs-viewer/css/style.css') }}"/>
</head>
<body>
<div class="container">
    <div class="row bg-info">
        <div class="col-md-12">
            <h1 class="text-danger">
                Laravel Logs
                <small>[ {{$fileActive}} ]</small>
            </h1>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-2">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        Log Files
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($logFiles as $file)
                    <tr>
                        @if($fileActive == $file)
                            <td class="bg-danger">
                        @else
                            <td>
                                @endif
                                @if($fileActive == $file)
                                    @if(strlen($file) > 19)
                                        <span
                                                data-toggle="tooltip"
                                                data-placement="bottom"
                                                title="{{$file}}"
                                        >
                                        [...] {{substr($file, 8, 13)}}...
                                    </span>
                                    @else
                                        {{$file}}
                                    @endif
                                @else
                                    <a href="{{ route('logs.index') }}/?file={{$file}}">
                                        @if(strlen($file) > 19)
                                            <span
                                                    data-toggle="tooltip"
                                                    data-placement="bottom"
                                                    title="{{$file}}"
                                            >
                                        {{substr($file, 0, 18)}}...
                                    </span>
                                        @else
                                            {{$file}}
                                        @endif
                                    </a>
                                @endif
                                <a href="{{route('logs.download', ['file' => $file])}}"
                                   class="pull-right btn-link btn-download"
                                   data-toggle="tooltip"
                                   data-placement="right"
                                   title="Click to download this log.">
                                    <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                                </a>
                            </td>
                    </tr>
                @endforeach
                </tbody>
                <thead>
                <th>
                    Log Configuration
                    <span class="glyphicon glyphicon-info-sign pull-right text-warning" aria-hidden="true"
                          title='<p>Available Settings: "single", "daily", "syslog", "errorlog"</p>'
                          data-toggle="tooltip"
                          data-placement="right"></span>
                </th>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ config('app.log') }}
                        <small class="pull-right">
                            <i>
                                (config/app.php)
                            </i>
                        </small>
                    </td>
                </tr>
                </tbody>
                <thead>
                <th>
                    Log Level
                    <span class="glyphicon glyphicon-info-sign pull-right text-warning" aria-hidden="true"
                          title='<p>Available settings - from least severe to most severe:
                          <br/>debug, info, notice, warning, error, critical, alert, emergency</p>'
                          data-toggle="tooltip"
                          data-placement="right"></span>
                </th>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ config('app.log_level') }}
                        <small class="pull-right">
                            <i>
                                (config/app.php)
                            </i>
                        </small>
                    </td>
                </tr>
                </tbody>
                <thead>
                <th>
                    App Timezone
                    <span class="glyphicon glyphicon-info-sign pull-right text-warning" aria-hidden="true"
                          title='<p>The timezone set in your application.</p>'
                          data-toggle="tooltip"
                          data-placement="right"></span>
                </th>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ config('app.timezone') }}
                        <small class="pull-right">
                            <i>
                                (config/app.php)
                            </i>
                        </small>
                    </td>
                </tr>
                </tbody>
                <thead>
                <th>
                    App Locale
                    <span class="glyphicon glyphicon-info-sign pull-right text-warning" aria-hidden="true"
                          title='<p>Your application locale default.</p>'
                          data-toggle="tooltip"
                          data-placement="right"></span>
                </th>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ config('app.locale') }}
                        <small class="pull-right">
                            <i>
                                (config/app.php)
                            </i>
                        </small>
                    </td>
                </tr>
                </tbody>
                <thead>
                <th>
                    App Name
                    <span class="glyphicon glyphicon-info-sign pull-right text-warning" aria-hidden="true"
                          title='<p>Your application name.</p>'
                          data-toggle="tooltip"
                          data-placement="right"></span>
                </th>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ config('app.name') }}
                        <small class="pull-right">
                            <i>
                                (config/app.php)
                            </i>
                        </small>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12 text-right text-danger">
                    <i>
                        page {{$logs->currentPage()}} of {{$logs->lastPage()}} ({{$logs->total()}} results –
                        {{$logs->perPage()}} per page)
                    </i>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row title-bar">
                    <div class="col-md-2">
                        Date / Time
                    </div>
                    <div class="col-md-1">
                        Env.
                    </div>
                    <div class="col-md-1">
                        Type
                    </div>
                    <div class="col-md-8">
                        Content
                    </div>
                </div>
                @foreach($logs as $key => $log)
                    <div class="row log-line">
                        <div class="col-md-2">
                            @if(array_key_exists('date', $log))
                                {{ $log['date'] }}
                            @else
                                -
                            @endif
                            <br/>
                            @if(array_key_exists('time', $log))
                                {{ $log['time'] }}
                            @endif
                        </div>
                        <div class="col-md-1">
                            @if(array_key_exists('env', $log))
                                {{ $log['env'] }}
                            @else
                                -
                            @endif
                        </div>
                        <div class="col-md-1 text-lowercase">
                            @if(array_key_exists('type', $log))
                                {{ $log['type'] }}
                            @else
                                -
                            @endif
                        </div>
                        <a class="col-md-8 word-wrap btn-link"
                           href="#"
                           data-toggle="modal" data-target="#modal_{{$key}}">
                            @if(array_key_exists('content', $log))
                                {{ $log['content'] }}
                            @else
                                @if(array_key_exists('stack_trace', $log))
                                    {{ $log['stack_trace'][1] }}
                                @endif
                            @endif
                        </a>
                    </div>
                    @if(array_key_exists('stack_trace', $log))
                        <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-danger" id="myModalLabel">
                                            Stack Trace
                                        </h4>
                                    </div>
                                    <div class="modal-body word-wrap">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <span class="glyphicon glyphicon-calendar text-danger" aria-hidden="true"></span>
                                                @if(array_key_exists('date', $log))
                                                    {{ $log['date'] }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <span class="glyphicon glyphicon-time text-danger" aria-hidden="true"></span>
                                                @if(array_key_exists('time', $log))
                                                    {{ $log['time'] }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <span class="glyphicon glyphicon-cloud text-danger" aria-hidden="true"></span>
                                                @if(array_key_exists('env', $log))
                                                    {{ $log['env'] }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="col-md-3 text-lowercase">
                                                <span class="glyphicon glyphicon-flash text-danger" aria-hidden="true"></span>
                                                @if(array_key_exists('type', $log))
                                                    {{ $log['type'] }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                        @if(array_key_exists('content', $log))
                                            <br/>
                                            <hr/>
                                            {{ $log['content'] }}
                                            <br/>
                                            <hr/>
                                        @endif
                                        @foreach($log['stack_trace'] as $key => $line)
                                            {{ $line }}<br/>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="text-right">
                    {!! $logs->links() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row footer bg-info">
        <div class="col-md-12 text-center">
            <a href="https://github.com/brunocouty/laravel-logs-viewer"
               class="btn-link"
               target="_blank">
                Laravel Logs Viewer
            </a>- by Bruno Couty &lt;brunocouty@gmail.com&gt; |
            <a href="https://github.com/brunocouty/"
               class="btn-link"
               target="_blank">
                Github
            </a>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/laravel-logs-viewer/js/jquery.js') }}"></script>
<script src="{{ asset('vendor/laravel-logs-viewer/js/bootstrap.js') }}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body',
            html: true
        });
    });
</script>
</body>
</html>