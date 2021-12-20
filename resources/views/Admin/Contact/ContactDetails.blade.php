@extends('admin')

@section('title', 'Chi tiết liên hệ')

@section('css')
<link href="/css/Admin/Contact.css" rel="stylesheet" />
@stop

@section('scripts')
@stop

@section('body')
<section class="contact-details">
<h2>{{$contact->name}}</h2>
    <div class="title">
        <h4>{{$contact->title}}</h4>
        <h4>{!! date('d/m/Y', strtotime($contact->created_at)) !!}</h4>
    </div>
    <div class="content">
        {{$contact->content}}
    </div>
</section>
@stop