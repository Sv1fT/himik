@extends('himik')

@section('content')

    <div class="container">
        <div class="content-full">
            <div class="content-left">
                <div class="tsb">
                    <b class="header-b"><?php echo $subcategory[0]->category_title ?></b>
                    @foreach($subcategory as $subcategorys)
                        <a href="<?print_r($_SERVER['REQUEST_URI'])?>/<?= str_slug($subcategorys->title, "-")?>">{{$subcategorys->title}}[{{$subcategorys->count_adv}}]</a>
                    @endforeach
                </div>
            </div>
            <div class="content-right" style="background-color: rgb(192,192,192);border: none">
                <b style="font-weight: normal;font-size: 15pt;color: #080808">
                    Буровая промышленность - промышленность, занимающаяся выпуском бурового оборудования и химреагентов.
                </b>
            </div>
        </div>
    </div>

@endsection