@extends('admin')

@section('title', 'Liên hệ')

@section('css')
<link href="/css/Admin/Contact.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Contact.js" type="text/javascript"></script>
@stop

@section('body')
<section class="Contact">
    <h3>Thông tin</h3>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Tiêu đề</th>
                <th>Ngày gửi</th>
                <td>Xem</td>
            </tr>
        </thead>
        <tbody>
            @foreach($contact as $key => $contacts)

            <tr id="sid{{$loop->iteration}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$contacts->name}}</td>
                <td>{{$contacts->email}}</td>
                <td>
                    @if($contacts->status == 0)
                    <strong> {{$contacts->title}}</strong>
                    @else
                    {{$contacts->title}}
                    @endif
                </td>
                <td>{!! date('d/m/Y', strtotime($contacts->created_at)) !!}</td>
                <td>
                    <a href="{{route('ReadContact', ['id' => $contacts->id])}}">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</section>
@stop