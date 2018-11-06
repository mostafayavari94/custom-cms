@extends('admin/layouts/app')

@section('title')
posts list
@endsection
@section('content')
<div class="row" id="orders">
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <button class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">افزودن</button>
            </div>
        </div>
        <!-- modal -->
        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title">افزودن کار</h4> 
                    </div> 
                    <div class="modal-body"> 
                        <form id="addform" action="/personal/work/add" method="post"><input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="title" class="control-label">نام شرکت</label> 
                                    <input name="title" type="text" class="form-control" id="title" placeholder="نام شرکت">
                                </div> 
                            </div> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="post" class="control-label">Post</label> 
                                    <input name="post" type="text" class="form-control" id="post" placeholder="Post"> 
                                </div> 
                            </div> 
                        </div> 
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="degree" class="control-label">درجه</label> 
                                    <input type="text" class="form-control" id="degree" name="degree" placeholder="درجه"> 
                                </div> 
                            </div> 
                            <!-- <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="status" class="control-label">نوع همکاری</label> 
                                    <input type="text" class="form-control" id="status" name="status" placeholder="نوع همکاری"> 
                                </div> 
                            </div>  -->
                        </div>
                        
                        
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    <label for="description" class="control-label">توضیحات</label> 
                                    <textarea class="form-control autogrow" id="description" name="description" placeholder="توضیحات" style=""></textarea>
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                    </form>
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button> 
                        <button type="button" onclick="$('#addform').submit()" class="btn btn-info waves-effect waves-light">ذخیره اطلاعات</button> 
                    </div> 
                </div> 
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
                                    <th class="text-center" >Action</th>
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
                                            {{$item->image}}
                                        </td>
                                         <td class="text-center" >
                                            {{$item->user_id}}
                                        </td>
                                        
                                        <td class="text-center" >
                                            <a href="/personal/works/detail/{{$item->id}}" class="btn btn-info">Detail</a>
                                            <a href="/personal/works/delete/{{$item->id}}" class="btn btn-danger">Delete</a>
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
