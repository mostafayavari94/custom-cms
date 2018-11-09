@extends('admin/layouts/app')

@section('title')
نظرات
@endsection
@section('content')
<div class="row">

    <div id="factor-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <input id="c_id" type="hidden" name="c_id" value="">
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title">جزئیات نظر</h4> 
                    </div> 
                    <div class=" row modal-body">
                        <div class="col-md-6">
                            <dl>
                                <dt id="c_name">
                                </dt>
                                <br />
                                <dt id="c_email">
                                </dt>
                                <br />
                                <dt id="c_create_date">
                                </dt>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl>
                                <dt id="c_text">
                                </dt>
                                <br />
                                <dt id="c_status">
                                </dt>
                            </dl>
                        </div>
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button> 
                        <button type="button" onclick="confirm()" class="btn btn-info waves-effect waves-light">تایید نظر</button>  
                    </div> 
                </div> 
            </div>
        </div>

@if(session('success'))

<div class="alert alert-success">

  {{ session('success') }}

</div> 

@endif
    <div id="table" class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="m-t-0 header-title"><b>لیست نظرات</b></h4>
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
                                        پست مربوط
                                    </th>
                                    <th class="text-center" >
                                        تاریخ افزودن
                                    </th>
                                    <th class="text-center" >
                                        وضعیت
                                    </th>
                                    <th class="text-center" >
                                    در پاسخ
                                    </th>
                                     <th class="text-center" >
                                     عملیات
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a=1; ?>                              
                                @foreach ($variable as $item)
                                    <tr>

                                        <th scope="row" class="text-center" >
                                            {{$a}}
                                            <?php $a = $a + 1; ?>
                                        </th>
                                        <td class="text-center" >
                                            {{$item->post_id}}
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
                                           {{$item->reply_for}}
                                        </td>
                                        <td class="text-center" >
                                            <a  onclick="detail({{$item->id}})" class="btn btn-info">جزئیات</a>
                                            <a onclick="return confirm('آیا مطمید هستید؟');" href="/admin/comments/delete/{{$item->id}}"  class="btn btn-danger">حذف</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $variable->links() }}
        </div>
    </div>
</div>
@endsection



@section('javascript')
<script type="text/javascript">
    function detail(aid){
        
        var url="{{ url('/admin/comments/detail') }}";
        
        $.ajax({
            url: url+'/'+aid,
            method: 'GET',
            success: function(result){
                $("#c_name").text(result.name);
                $("#c_text").text(result.text);
                $("#c_id").val(result.id);
                $("#c_email").text(result.email);
                $("#c_create_date").text(result.create_date);
                if (result.status) {
                    $("#c_status").text("فعال");
                }else{
                    $("#c_status").text("غیر فعال");
                }
                $("#factor-modal").modal('show');
            },
            error: function(result){
             alert('متاسفانه مشکلی در سیستم رخ داده است.');  
            }
        });
    }

    function confirm(){
        
        $.ajax({
            url: "{{ url('/admin/comments/confirm') }}",
            method: 'POST',
            data: { _token:"{{ csrf_token() }}",id: $("#c_id").val()},
            success: function(result){
                alert(result); 

                var url="{{ url('/admin/comments/page') }}";
        
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data){
                    $('#table').empty().html(data);
                    notifications();
                    },
                    error: function(result){
                        alert('متاسفانه مشکلی در سیستم رخ داده است..');  
                    }
                });

                $("#factor-modal").modal('hide');
            },
            error: function(result){
                alert('متاسفانه مشکلی در سیستم رخ داده است.');  
            }
        });
    }
</script>
@endsection