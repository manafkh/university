@extends('layouts.app')

@section('content')
<input id="lectureId" value="{!! $lecture->id !!}" type="hidden" />
<input id="nextScanId" value="{!! $next_scan_id !!}" type="hidden" />
<div id="app"></div>
<div id="qrcode"></div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('js/libs.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('js/qr.js')}}"></script>--}}
@endsection