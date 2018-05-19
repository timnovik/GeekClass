@extends('layouts.app')

@section('content')
    <br>
    <form method="POST">
        {{ csrf_field() }}
        <div class="row" style = "margin-top: -30px">
            <div class="col">
                <div class="float-left">
                    <h2>События</h2>
                </div>
                <div class="float-right">
                    <a href="{{url('/insider/events/add_event')}}" style = "margin-left: 50px" class = "btn btn-success">Провести событие</a>
                </div>

            </div>
        </div>
        <div class="row" style = "margin-top: 10px">
            <div class="col-md-8">
            @foreach($events as $event)

            @endforeach
            @foreach($events as $event)
                @foreach($event->tags as $tag)
                    @if(in_array($tag->id, $s_tags))
                    <div class="card-group">
                        <div class="card">
                            <div class="card-footer">
                                <div class="text-center">
                                    <b>{{$event->name}}, ({{$event->type}})</b>
                                </div>
                                <div class="float-left">
                                    <img src="https://png.icons8.com/ultraviolet/50/000000/good-quality.png" width="30px">
                                    {{count($event->userLikes)}}
                                </div>
                                <div class="float-right">
                                    {{$event->date}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                            {{$event->short_text}}
                                        <div class="float-right">
                                            <a href="{{url('/insider/events/'.$event->id)}}" style="margin-top: -5px" class = "btn btn-primary">Перейти к событию</a>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @break
                    @endif
                   @endforeach
                @endforeach
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Теги:</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            {{ csrf_field() }}
                            <div class="form-group form-check">
                                @foreach($tags as $tag)
                                <div class="form-check ">
                                    <input type="checkbox" style="margin-left:5px" name="sel_tags[]" class="form-check-input" value="{{$tag->id}}" id="{{$tag->id}}">
                                    <label for="{{$tag->id}}" class="form-check-label" style="margin-left:2px" >{{$tag->name}}</label>
                                </div>
                                @endforeach
                                <br>
                                <div class="float-left">
                                    <input type="submit" value="Применить" class = "btn btn-success">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection