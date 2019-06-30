@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.getElementsByTagName("blade")[0].className += " js";</script>
    <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">
    <title>Schedule Template | CodyHouse</title>
</head>
<body>
{{--<header class="cd-main-header text--center flex flex--column flex--center">--}}
    {{--<p class="margin-top--md margin-bottom--xl">👈 <a class="cd-article-link" href="https://codyhouse.co/gem/schedule-template">Article &amp; Download</a></p>--}}

    {{--<h1 class="text--xl">Schedule Template</h1>--}}
{{--</header>--}}

<div class="cd-schedule cd-schedule--loading margin-top--lg margin-bottom--lg js-cd-schedule">
    <div class="cd-schedule__timeline">
        <ul>
            <li><span>09:00</span></li>
            <li><span>09:30</span></li>
            <li><span>10:00</span></li>
            <li><span>10:30</span></li>
            <li><span>11:00</span></li>
            <li><span>11:30</span></li>
            <li><span>12:00</span></li>
            <li><span>12:30</span></li>
            <li><span>13:00</span></li>
            <li><span>13:30</span></li>
            <li><span>14:00</span></li>
            <li><span>14:30</span></li>
            <li><span>15:00</span></li>
            <li><span>15:30</span></li>
            <li><span>16:00</span></li>
            <li><span>16:30</span></li>
            <li><span>17:00</span></li>
            <li><span>17:30</span></li>
            <li><span>18:00</span></li>
        </ul>
    </div> <!-- .cd-schedule__timeline -->

    <div class="cd-schedule__events">
        <ul>
            <li class="cd-schedule__group">
                <div class="cd-schedule__top-info"><span>Sunday</span></div>

                <ul>
                    @foreach($sections as $section)
                        @if($section->schedule->day == 'Su')
                    <li class="cd-schedule__event">
                        <a data-start="{!! $section->schedule->start_time !!}" data-end="{{$section->schedule->end_time}}" data-content="{!! $section->course->title !!}" data-event="event-3" href="#0">
                            <em class="cd-schedule__name">{!! $section->course->title !!}</em>
                           <em class="cd-schedule__name">{!!  $section->Room  !!}</em>
                        </a>
                        @endif
                    @endforeach

                </ul>
            </li>

            <li class="cd-schedule__group">
                <div class="cd-schedule__top-info"><span>Monday</span></div>

                <ul>

                    @foreach($sections as $section)
                        @if($section->schedule->day == 'Mo')
                            <li class="cd-schedule__event">
                                <a data-start="{!! $section->schedule->start_time !!}" data-end="{{$section->schedule->end_time}}" data-content="{!! $section->course->title !!}" data-event="event-2" href="#0">
                                    <em class="cd-schedule__name">{!! $section->course->title !!}</em>
                                </a>
                        @endif
                    @endforeach

                </ul>
            </li>

            <li class="cd-schedule__group">
                <div class="cd-schedule__top-info"><span>Tuesday</span></div>

                <ul>
                    @foreach($sections as $section)
                        @if($section->schedule->day == 'Tu')
                            <li class="cd-schedule__event">
                                <a data-start="{!! $section->schedule->start_time !!}" data-end="{{$section->schedule->end_time}}" data-content="{!! $section->course->title !!}" data-event="event-2" href="#0">
                                    <em class="cd-schedule__name">{!! $section->course->title !!}</em>
                                </a>
                        @endif
                    @endforeach
                </ul>
            </li>

            <li class="cd-schedule__group">
                <div class="cd-schedule__top-info"><span>Wednesday</span></div>

                <ul>
                    @foreach($sections as $section )
                        @if($section->schedule->day == 'We')
                            <li class="cd-schedule__event">
                                <a data-start="{!! $section->schedule->start_time !!}" data-end="{{$section->schedule->end_time}}" data-content="{!! $section->course->title !!}" data-event="event-{{$i++}}" href="#0">
                                    <em class="cd-schedule__name">{!! $section->course->title !!}</em>
                                </a>
                        @endif
                    @endforeach
                </ul>
            </li>

            <li class="cd-schedule__group">
                <div class="cd-schedule__top-info"><span>Thursday</span></div>

                <ul>
                    @foreach($sections as $section)
                        @if($section->schedule->day == 'Th')
                            <li class="cd-schedule__event">
                                <a data-start="{!! $section->schedule->start_time !!}" data-end="{{$section->schedule->end_time}}" data-content="{!! $section->course->title !!}" data-event="event-2" href="#0">
                                    <em class="cd-schedule__name">{!! $section->course->title !!}</em>
                                </a>
                        @endif
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>

    <div class="cd-schedule-modal">
        <header class="cd-schedule-modal__header">
            <div class="cd-schedule-modal__content">
                <span class="cd-schedule-modal__date"></span>
                <h3 class="cd-schedule-modal__name"></h3>
            </div>

            <div class="cd-schedule-modal__header-bg"></div>
        </header>

        <div class="cd-schedule-modal__body">
            <div class="cd-schedule-modal__event-info"></div>
            <div class="cd-schedule-modal__body-bg"></div>
        </div>

        <a href="#0" class="cd-schedule-modal__close text--replace">Close</a>
    </div>

    <div class="cd-schedule__cover-layer"></div>
</div> <!-- .cd-schedule -->

<script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script> <!-- util functions included in the CodyHouse framework -->
<script type="text/javascript" src="{{asset('assets/js/util.js')}}"></script>
</body>
</html>
@endsection