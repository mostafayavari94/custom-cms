
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