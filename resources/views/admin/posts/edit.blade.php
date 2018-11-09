@extends('admin/layouts/app')

@section('title')
تغییر مطلب
@endsection

@section('content')
<div class="col-sm-12">
        <div class="card-box">
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
                <div class="col-lg-12">
                    <h4 class="m-t-0 header-title"><b>افزودن مطلب</b></h4>
                    <p class="text-muted font-13">
                    </p> 
                    <form id="addform" action="/admin/posts/edit" enctype="multipart/form-data" method="post" ><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="id" value="{{ $variables['entity']->id }}">
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="title" class="control-label">عنوان</label> 
                                    <input name="title" type="text" class="form-control" id="title" value="{{ $variables['entity']->title }}" placeholder="عنوان">
                                </div> 
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                  <div class="col-sm-5">
                                    <input type="hidden" id="image_status" name="image_status" value="0">
                                    <label class="btn " for="input20"><img style="width: 200px; height: 200px" id="img20" src="/image/posts/{{ $variables['entity']->image }}" alt="" title="" data-placeholder=""></label><input onchange="readUrl(20)" type="file" name="main_image" id="input20" value="" accept="image/*" class="form-control hidden"><button style="display: block;position: absolute;top: 0px;" type="button" onclick="deleteImage(20)" data-toggle="tooltip" id="button20" title="" class="btn btn-danger" data-original-title="حذف"><i class="fa fa-close"></i></button>
                                </div>  
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="status" class="control-label">وضعیت</label>
                                    <select class="form-control" id="status" name="status">
                                        @if($variables['entity']->status)
                                            <option value="1" selected >فعال</option>
                                            <option value="0" >غیر فعال</option>
                                        @else
                                            <option value="1" >فعال</option>
                                            <option value="0" selected >غیر فعال</option>
                                        @endif
                                    </select> 
                                </div> 
                            </div> 
                        </div>

                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    <label for="abstract" class="control-label">چکیده</label> 
                                    <textarea class="form-control autogrow" id="abstract" name="abstract" placeholder="چکیده" style="">{{ $variables['entity']->abstract }}</textarea>
                                </div> 
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    <label for="text" class="control-label">متن اصلی</label> 
                                    <textarea class="form-control autogrow" id="text" name="text" placeholder="متن اصلی" style="">{{ $variables['entity']->text }}</textarea>
                                </div> 
                            </div> 
                        </div> 

                         <div class="pic-upload row"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    
                                    <div style="margin-bottom: 12px;" class="input-group hdtuto control-group lst increment" >

                                      

                                      <div class="input-group-btn"> 

                                        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i></button>

                                      </div>


                                      <div class="custom"> 
                                       
                                      </div>    

                                    </div>

                                     <?php $picNumber=1; ?>
                                        @foreach ($variables['entity']->images as $item)
                                            <div class=" hdtuto col-md-3"><label for="input{{$picNumber}}" class="btn " ><img id="img{{$picNumber}}" style="width: 100px; height: 100px"  src="/image/posts/{{$item->link}}" alt="" title="" data-placeholder=""></label><input  type="hidden" name="old_images[]" value="{{$item->id}}" ><button custom-btn style="display: block;position: absolute;top: 0px;" type="button" data-toggle="tooltip" id="button{{$picNumber}}" title="" class="btn btn-danger custom-btn" data-original-title="حذف"><i class="fa fa-close"></i></button></div>
                                            
                                            <?php $picNumber = $picNumber + 1; ?>
                                        @endforeach

                                </div> 
                            </div> 
                        </div> 
                        

                    </form>
                    <a class="btn btn-default waves-effect" href="/admin/posts">بازگشت</a>
                    <button type="button" onclick="$('#addform').submit()" class="btn btn-info waves-effect waves-light">ذخیره اطلاعات</button> 
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')
<script type="text/javascript">
    var picNumber={{$picNumber}};
    function readUrl(id) {
        var input=document.getElementById('input'+id);
        
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $("#img"+id)
            .attr('src', e.target.result)
            .width(100)
            .height(100);
          };
          reader.readAsDataURL(input.files[0]);
        }
        $("#button"+id).removeAttr("disabled");
    }

    function deleteImage(id){
        var src = "{{$variables['placeholder']}}";
        $("#img" + id).attr("src", src);
        $("image_status").val(1);

        var control = $("#input" + id);
        control.replaceWith( control.val('').clone(true));
        $("#button" + id).attr("disabled", 'disabled');
    }

    $(".btn-success").click(function(){ 

        html='<div class=" hdtuto col-md-3"><label for="input' + picNumber + '" class="btn " ><img id="img' + picNumber + '" style="width: 100px; height: 100px"  src="/image/no_photo.png" alt="" title="" data-placeholder=""></label><input onchange="readUrl(' + picNumber + ')" type="file" name="pics[]"  id="input' + picNumber + '" value="" accept="image/*" class="form-control hidden"><button custom-btn style="display: block;position: absolute;top: 0px;" type="button" data-toggle="tooltip" id="button' + picNumber + '" title="" class="btn btn-danger custom-btn" data-original-title="حذف"><i class="fa fa-close"></i></button></div>';
        // var lsthmtl = $(".clone").html();

        $(".increment").after(html);
        picNumber=picNumber+1;

      });

</script>

<script type="text/javascript">

      $("body").on("click",".custom-btn",function(){ 

          $(this).parents(".hdtuto").remove();

      });


</script>
@endsection


