@extends('welcome')

@section('title', 'Liên hệ')

@section('css')
<link href="/css/Home/Contact.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Home/Contact.js" type="text/javascript"></script>
@stop

@section('body')
<section class="contact-section">
<div class="alert alert-success alert-dismissible fade show alert-contact-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Thành công</strong> Cảm ơn bạn đã liên hệ.
        </div>
        <div class="alert alert-error alert-dismissible fade show alert-contact-error">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Thất bại</strong> Vui lòng thử lại sau
        </div>
<div class="container">
    <p class="title">Liên hệ với chúng tôi</p>
    <form class="form-contact" id="form-contact" method="post" action="{{route('postContact')}}">
      @csrf
    <div class="text-field">
          <label for="name">Họ tên</label>
          <input autocomplete="off" type="text" name="name" id="name" placeholder="Họ và tên" />
        </div>
        <div class="text-field">
          <label for="email">Email</label>
          <input autocomplete="off" type="email" name="email" id="email" placeholder="Email" />
        </div>
        <div class="text-field">
          <label for="phone">Số điện thoại</label>
          <input autocomplete="off" type="number" name="phone" id="phone" placeholder="Số điện thoại" />
        </div>
        <div class="text-field">
          <label for="title">Tiêu đề</label>
          <input autocomplete="off" type="text" name="title" id="title" placeholder="Tiêu đề" />
        </div>
        <div class="text-field">
          <label for="content">Nội dung</label>
          <textarea autocomplete="off" type="text" name="content" id="content" placeholder="Nội dung" rows="6"></textarea>
        </div>
        <button class="btn btn-primary" type="submit" id="submit-contact">Gửi</button>
    </form>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60535.64163447632!2d105.81008712219705!3d18.507307328556795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31384a76433cf7e5%3A0xddc506d89cc801e0!2zVMOibiBM4buZYywgTOG7mWMgSMOgLCBIw6AgVMSpbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1639322524241!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</section>
@stop