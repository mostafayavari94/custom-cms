@extends('admin/layouts/app')

@section('title')
لیست مطالب
@endsection
@section('content')
<div class="row">
    
@if(session('success'))

<div class="alert alert-success">

  {{ session('success') }}

</div> 

@endif
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <a href="/admin/posts/add" class="btn btn-info waves-effect waves-light" >افزودن مطلب</a>
            </div>
        </div>        
    </div>
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="m-t-0 header-title"><b>لیست مطالب</b></h4>
                    <p class="text-muted font-13">
                    </p>


                    <div class="table-responsive ">
                        <table class="table m-0 table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" >
                                        #
                                    </th>
                                    <th class="text-center" >
                                        کد مطلب
                                    </th>
                                    <th class="text-center" >
                                        عنوان
                                    </th>
                                    <th class="text-center" >
                                        تاریخ افزودن
                                    </th>
                                    <th class="text-center" >
                                        وضعیت
                                    </th>
                                    <th class="text-center" >
                                        تصویر اصلی
                                    </th>
                                    <th class="text-center" >
                                        نام نویسنده
                                    </th>
                                    <th class="text-center" >عملیات</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $a=1; ?>
                                
                                
                                @foreach ($list as $item)
                                    <tr>

                                        <th scope="row" class="text-center" >
                                            {{$a}}
                                            <?php $a = $a + 1; ?>
                                        </th>
                                        <td class="text-center" >
                                            {{$item->id}}
                                        </td>
                                        <td class="text-center" >
                                           {{$item->title}}
                                        </td>
                                        <td class="text-center" >
                                           {{$item->create_date}}
                                        </td>
                                        
                                        <td class="text-center" >
                                            @if($item->status)
                                                فعال
                                            @else
                                                غیر فعال
                                            @endif

                                        </td>
                                        <td class="text-center" >
                                            <img style="width: 200px;height:200px" src="/image/user.png" alt="user-img" class="img-circle">
                                            
                                        </td>
                                         <td class="text-center" >
                                            <a href="{{$item->user_id}}">{{$item->user['name']}}</a>
                                            
                                            
                                        </td>
                                        
                                        <td class="text-center" >
                                            <a href="/admin/posts/detail/{{$item->id}}" class="btn btn-info">جزئیات</a>
                                            <a onclick="return confirm('آیا مطمید هستید؟');" href="/admin/posts/delete/{{$item->id}}"  class="btn btn-danger">حذف</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{ $list->links() }}
        </div>
    </div>
</div>
@endsection
