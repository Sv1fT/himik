<header>
    <div class="container">
        <div class="row"> 

            <div class="col-xs-4 col-md-2 header-div-left">
                <a href="/">
                    <img class="img-fluid" src="/image/logo.png" title="ОПТхимик" alt="ОПТхимик"></a>
            </div>
            <div class="col-md-7 col-lg-8 search-head-div">
                <form action="/search/" class="col-md-12 header-div-middle1" method="GET" enctype="multipart/form-data">
                    <div class="col-md-12 header-div-middle">
                        <div class="h-100 search-button">
                            <button type="submit" class="border btn btn-primary h-100 m-0 pl-3"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <div class="h-100 search-button">
                            <select name="user"
                                    class="border btn btn-primary h-100 m-0">
                                <option value="user">по компаниям</option>
                                <option value="advert">по объявлениям</option>
                                <option value="vacant">по вакансиям</option>
                                <option value="resume">по резюме</option>
                            </select>

                        </div>
                        <div class="search-field">
                            <input type="text" name="quote" class="input-search" placeholder="Введите поисковый запрос">
                        </div>
                    </div>

                </form>

                <!-- Modal -->


            </div>


            <div class="col-md-3 col-lg-2 header-div-right text-right pr-0">
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">


                                @if(!empty(session()->get('regiones')))

                                    <h4 class="modal-title">{{session()->get('regiones')}}</h4>
                                    <p><a href="http://opt-himik.ru"
                                          class="modal-title" id="myModalLabel">Вся
                                            Россия</a></p>



                                @else
                                    <h4 class="modal-title" id="myModalLabel">Вся Россия</h4>
                                @endif
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <region_select-component></region_select-component>

                        </div>
                    </div>
                </div>

                @if(!empty(session()->get('regiones')))

                    <a class="select-region-head" href="#" data-toggle="modal" data-target="#myModal"
                    >{{session()->get('regiones')}}<b class="caret"></b></a>

                @else
                    <a class="select-region-head" href="#" data-toggle="modal" data-target="#myModal"
                    >Вся Россия <img class="img-fluid" width="40px" src="/image/Flag_of_Russia.png" alt=""><b class="caret"></b></a>
                @endif
            </div>

        </div>
    </div>
</header>
