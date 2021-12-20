@extends('admin')

@section('title', 'Slider')

@section('css')
<link href="/css/Admin/Slider.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Slider.js" type="text/javascript"></script>
@stop

@section('body')
<section class="Slider">
    <h3>Danh sách slider: ({{$count}})</h3>
    <button class="btn btn-danger Deletes" id="Deletes">Xóa nhiều</button>
    <p id="message-success"></p>
    <table>
        <thead>
            <tr>
                <th class="checkbox"><input type="checkbox" id="checkAll" /></th>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slider as $key => $sliders)
            <tr id="sid{{$loop->iteration}}">
                <td class="checkbox"><input type="checkbox" class="checkItem" name="ids" value="{{$sliders->id}}" /></td>
                <td>{{$loop->iteration}}</td>
                <td><img src="https://docs.google.com/uc?id={{$sliders->img}}"></td>
                <td>
                    <a href="{{route('ViewEditSlider', ['id' => $sliders->id])}}">
                        <button class="btn btn-primary">Sửa</button>
                    </a>
                    <a href="{{route('Delete', ['id' => $sliders->id])}}">
                        <button class="btn btn-danger">Xóa</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$slider->links(("pagination::bootstrap-4"))}}
</section>
@stop