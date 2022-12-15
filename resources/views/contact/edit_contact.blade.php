
@extends('dashboard')
@section('content')
<form action="{{route('contact.editContact',['idContact' => $contact->id_contact])}}" method="POST"> 
    @csrf 
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <label for="exampleFormControlInput1">Thông tin liên hệ</label>
        <textarea class="form-control" id="ckeditor" name="info_contact" id="exampleFormControlInput1" placeholder="Nhập thông tin">
        {{$contact->info_contact}}
        </textarea>
        @error('info_contact')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Địa chỉ trên Google Maps</label>
        <textarea class="form-control" id="ckeditor1" name="map_contact" id="exampleFormControlInput1" placeholder="Nhập thông tin">
        {{$contact->map_contact}}
        </textarea>
        @error('map_contact')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Sửa thông tin" style="display: block; margin:auto; padding:auto;">
</form>
@endsection