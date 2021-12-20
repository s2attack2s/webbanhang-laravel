@extends('admin')

@section('title', 'Danh mục')

@section('css')
<link href="/css/Admin/Cate.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Cate.js" type="text/javascript"></script>
@stop

@section('body')
<section class="category">
    <h3>Danh mục sản phẩm: ({{$count}})</h3>
    <button class="btn btn-danger Deletes" id="Deletes">Xóa nhiều</button>
    <p id="message-success"></p>
    <table>
        <thead>
            <tr>
                <th class="checkbox"><input type="checkbox" id="checkAll" /></th>
                <th>STT</th>
                <th>Tên</th>
                <th>Ngày tạo</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $key => $categorys)
            <tr id="sid{{$loop->iteration}}">
                <td class="checkbox"><input type="checkbox" class="checkItem" name="ids" value="{{$categorys->id}}" /></td>
                <td>{{$loop->iteration}}</td>
                <td>{{$categorys->name}}</td>
                <td> {!! date('d/m/Y', strtotime($categorys->created_at)) !!}</td>
                <td>
                    <a href="{{route('ViewEditCate', ['id' => $categorys->id])}}">
                        <button class="btn btn-primary">Sửa</button>
                    </a>
              <button class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$key}}">Xóa</button>
                </td>
            </tr>
            </tr>
            <div class="modal fade" id="delete-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xóa danh mục này sẽ xóa các sản phẩm liên quan, bạn chắc chắn chứ??</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <a href="{{route('Delete', ['id' => $categorys->id])}}"> <button type="button" class="btn btn-primary">Xóa</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</section>
@stop