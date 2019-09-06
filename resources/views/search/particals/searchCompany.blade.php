
                    <h2 class="ml-4" id="search_text" style="color:black">{{$q}}</h2>


                    <div class="blog">
                        <h2 class="pl-2" style="color: black;">Каталог компаний</h2>
                        <img src="image/img0005.png" style="border-width: 0;height: 8px;width: 100%;">
                        @foreach($search as $company)
                            @foreach($company->attributes as $item)
                                <div style="text-align: left;padding-top: 10px;">
                                            <span class="blog-company-image mb-3">
                                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($item->filename))
                                                    <img src="/storage/{{$item->filename}}" alt="{{$item->company}}" title="{{$item->company}}" style="width:160px;height: 160px;display: block;margin: 0 auto;">
                                                @else

                                                    <img src="/image/not_found.jpg" alt="{{$item->company}}" title="{{$item->company}}" style="width:160px;height: 160px;display: block;margin: 0 auto;">
                                                @endif
                                            </span>
                                    <span class="blog-company-content">


                                            <a class="region_link" style="color:#00008b;font-weight: bold" href="/blog/company/{{$item->user_id}}">{{$item->company}}</a>

                                        <p style="margin: 0 0 5px;">Город: {{$company->city}}</p>
                                        <p style="margin: 0 0 5px;">Адрес: {{$item->address}}</p>
                                        <p>Телефон: {{$item->number}}</p>
                                        <p>Описание компании: {{$item->description}}</p>





                                    </span>

                                </div>
                            @endforeach
                        @endforeach
                    </div>