@extends('admin/layouts/app')

@section('title')
لیست دسته بندی ها
@endsection
@section('content')
<div class="row" >
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <button class="btn btn-info waves-effect waves-light" data-toggle="modal" id="btn_add" data-target="#con-close-modal">افزودن</button>
                
            </div>
        </div>
        <!-- modal -->
       
        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title">افزودن دسته بندی</h4> 
                    </div> 
                    <div class="modal-body"> 
                        <form id="addform" aria-label="{{ __('Upload') }}" action="/admin/categories/add" method="post" enctype="multipart/form-data" ><input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="name" class="control-label">نام دسته بندی</label> 
                                    <input name="name" type="name" class="form-control" id="name" placeholder="نام"> 
                                </div> 
                            </div> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="status" class="control-label">وضعیت</label> 
                                    <select id="status" name="status" class="form-control">
                                        <option value="1" >فعال</option>
                                        <option value="0" >غیر فعال</option>
                                    </select>
                                </div> 
                            </div> 
                        </div> 
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                  <div class="col-sm-5">
                                    <label class="btn " for="input20"><img style="width: 200px; height: 200px" id="img20" src="/image/no_photo.png" alt="" title="" data-placeholder=""></label><input onchange="readUrl(20)" type="file" name="image" id="input20" value="" accept="image/*" class="form-control hidden"><button style="display: block;position: absolute;top: 0px;" type="button" onclick="deleteImage(20)" data-toggle="tooltip" id="button20" title="" class="btn btn-danger" disabled="disabled" data-original-title="حذف"><i class="fa fa-close"></i></button>
                                </div>  
                                </div>
                            </div>
                             
                        </div>
                        
                        
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    <label for="description" class="control-label">توضیحات</label> 
                                    <textarea name="description" class="form-control autogrow" id="description" placeholder="توضیحات" style=""></textarea>
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


        <div id="factor-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <form id="editform" aria-label="{{ __('Upload') }}" action="/admin/categories/edit" method="post" enctype="multipart/form-data" ><input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">جزئیات دسته بندی</h4> 
                        </div> 
                        <div class="modal-body"> 
                            <div class="row"> 
                                <div class="col-md-6"> 
                                  <div class="form-group"> 
                                        <label for="e_code" class="control-label">کد</label> 
                                        <input  disabled="disabled" type="text" class="form-control" id="e_code" value="" placeholder="کد"> 
                                        <input name="id"  type="hidden"  id="e_code_hidden" > 
                                    </div>    
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <label for="e_name" class="control-label">نام</label> 
                                        <input type="text" class="form-control" id="e_name" value="" name="name" placeholder="نام"> 
                                    </div> 
                                </div> 
                            </div> 
                            <div class="row"> 
                                <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <label for="e_status" class="control-label">وضعیت</label> 
                                        <select id="e_status" name="status" class="form-control">
                                            <option value="1" >فعال</option>
                                            <option value="0" >غیر فعال</option>
                                        </select>
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group no-margin">
                                      <div class="col-sm-5">
                                        <label class="btn " for="input30"><img style="width: 200px; height: 200px" id="img30" src="/image/no_photo.png" alt="" title="" data-placeholder=""></label><input onchange="readUrl(30)" type="file" name="image" id="input30" value="" accept="image/*" class="form-control hidden"><button style="display: block;position: absolute;top: 0px;"  type="button" onclick="deleteImage(30)" data-toggle="tooltip" id="button30" title="" class="btn btn-danger"  data-original-title="حذف"><i class="fa fa-close"></i></button>
                                        <input type="hidden" id="input_hidden30" value="0" name="image_sts" > 

                                    </div>  
                                    </div>
                                </div>
                                 
                            </div>
                            <div class="row">
                            <div class="col-md-12"> 
                                    <div class="form-group "> 
                                        <label for="e_description" class="control-label">توضیحات</label> 
                                        <textarea name="description" class="form-control autogrow" id="e_description" placeholder="توضیحات" style=""></textarea>
                                    </div> 
                                </div> 
                                </div>
                        
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button> 
                            <button type="button" onclick="$('#editform').submit()" class="btn btn-info waves-effect waves-light">تغییر اطلاعات</button>  
                        </div> 
                    </form>
                </div> 
            </div>
        </div>


    </div>

    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="m-t-0 header-title"><b>دسته بندی ها</b></h4>
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
                                        شماره دسته بندی 
                                    </th>
                                    <th class="text-center" >
                                        نام دسته بندی 
                                    </th>
                                    <th class="text-center" >
                                        وضعیت
                                    </th>
                                    <th class="text-center" >عملیات</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $a=1; ?>
                                
                                
                                @foreach ($data['list'] as $item)
                                    <tr>

                                        <th scope="row" class="text-center" >
                                            {{$a}}
                                            <?php $a = $a + 1; ?>
                                        </th>
                                        <td class="text-center" >
                                            {{$item->id}}
                                        </td>
                                        <td class="text-center" >
                                           {{$item->name}}
                                        </td>
                                        <td class="text-center" >
                                           @if($item->status)
                                                فعال
                                            @else
                                                غیر فعال
                                            @endif
                                        </td>
                                        
                                        
                                        
                                        <td class="text-center" >
                                            <a  onclick="detail({{$item->id}})" class="btn btn-info">جزئیات/تغییر</a>
                                            <a onclick="return confirm('آیا مطمید هستید؟');" href="/admin/categories/delete/{{$item->id}}"  class="btn btn-danger">حذف</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

             {{  $data['list']->links() }}
        </div>
    </div>
</div>
@endsection


@section('javascript')
<script type="text/javascript">

  function readUrl(id) {
    var input=document.getElementById('input'+id);
    
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#img"+id)
        .attr('src', e.target.result)
        .width(200)
        .height(200);
      };
      reader.readAsDataURL(input.files[0]);
    }
    $("#button"+id).removeAttr("disabled");
  }

  function deleteImage(id){
    var src = "{{$data['placeholder']}}";
    $("#img" + id).attr("src", src);
    $("#input_hidden" + id).val("1");

    var control = $("#input" + id);
    control.replaceWith( control.val('').clone(true));
    $("#button" + id).attr("disabled", 'disabled');
  }
</script>

<script type="text/javascript">
    function detail(aid){
        
        var url="{{ url('/admin/categories/detail') }}";
        
        $.ajax({
            url: url+'/'+aid,
            method: 'GET',
            data: { _token:"{{ csrf_token() }}",in_time: $('input[type="time"][value="now"]').val()
            },
            success: function(result){
                $("#e_name").val(result.name);
                $("#img30").attr('src', '/image/categories/'+result.image);
                $("#e_code").val(result.id);
                $("#e_code_hidden").val(result.id);
                $("#e_description").val(result.description);
                $("#e_status option[value="+result.status+"]").attr('selected','selected');
                $("#factor-modal").modal('show');
            },
            error: function(result){
             alert('متاسفانه مشکلی در سیستم رخ داده است.');  
            }
        });
    }
</script>
@endsection