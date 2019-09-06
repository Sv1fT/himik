@extends('himik')

@section('title')

    <title>ОПТхимик - Добавление вакансии </title>

@stop

@section('content')

    <style></style>

    <meta id="csrf" name="csrf-token" content="{{csrf_token()}}">

    <div class="container">

        <div class="content-full">
            <div class="content-left">
                <div class="tsb">


                    <div class="blog" style="width: 563px;    box-shadow: 0 0 10px rgba(0, 0, 0, 1);">
                        <div class="header-b">Добавление новой вакансии</div>
                        <form id="sendForm" method="post" enctype="multipart/form-data" action="{{url('addvacantion')}}">
                            <input class="form-control get_city" type="text" placeholder="Укажите город в России" style="width: 553px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <ul class="search_result p-0">

                            </ul>

                            <select class="category_select form-control" name="razdel" required style="width: 553px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                <option>Выберите раздел</option>
                                @foreach($razdel as $item)

                                    <option id="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                            <input class="form-control" type="text" required name="name" placeholder="Название вакансии" style="width: 553px;max-width:553px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">

                            <input class="form-control" type="text" name="price1" required placeholder="Зарплата от" style="width: 184px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <input class="form-control" type="text" name="price2" required placeholder="Зарплата до" style="width: 184px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <select class="category_select form-control" name="valute" required style="width: 175px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                <option id="1">Руб.</option>
                                <option id="2">USD</option>
                                <option id="3">EUR</option>

                            </select>
                            <textarea class="form-control" type="text" name="opit" required placeholder="Опыт работы" style="width: 553px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;"></textarea>
                            <input class="form-control" type="text" name="education" required placeholder="Образование" style="width: 553px;color: black;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <textarea class="form-control" type="text" name="description" required placeholder="Описание вакансии"
                                      style="width: 553px;color: black;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;"></textarea>

                        {{csrf_field()}}

                        <!-- <input style="width: 20px;box-shadow: none" type="checkbox" class="form-control" required="">
                            <a style="vertical-align: 70%;margin-left: 10px;cursor:pointer;" id="confid">согласие на обработку персональных данных</a> -->


                            <input class="form-control w-75" id="goSend" type="submit" value="Добавить вакансию"/>


                            <div class="col-12 mx-auto" id="modal_form" style="    width: 1050px;
    border-radius: 5px;
    border: 3px solid rgb(0, 0, 0);
    background: rgb(243, 243, 243);
    position: fixed;
    top: 30%;
    left: initial;
    display: none;
    overflow: scroll;
    opacity: 1;
    height: 590px;"><!-- Сaмo oкнo -->
                                <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->


                                <div class="" style="margin-top: 30px;padding: 30px;text-align: left;color: black">


                                    <p style="margin-bottom: 6.75pt; line-height: normal; background: #F3F3F3;"><strong><span style="font-size: 16.0pt; font-family: 'Helvetica','sans-serif'; color: #262626;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Пользовательское соглашение</span></strong>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Настоящее Пользовательское соглашение (далее - Соглашение) регулирует правовые отношения между сайтом http://opt-himik.ru/ (далее -Сайт) в лице его владельца Осетрова В.А., г. Волгоград, Россия (далее - Администрация) и дееспособным физическим лицом, присоединившимся к настоящему Соглашению (далее - Пользователь) в личном интересе или выступающим от имени и в интересах представляемого им юридического лица.</span>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><strong><span style="font-size: 14.0pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">&nbsp;</span></strong>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><strong><span
                                                    style="font-size: 14.0pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">Общие положения</span></strong></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Соглашение считается заключенным без каких либо оговорок и исключений в момент любого взаимодействия Пользователя с Сайтом, при этом Пользователь подтверждает свое согласие со всеми условиями Соглашения. Если Пользователь не согласен с Соглашением полностью или частично, Администрация просит его покинуть Сайт.&nbsp;<br/> <br/> Зарегистрированный Пользователь дополнительно соглашается с Соглашением во время регистрации и во время изменения регистрационных данных, о чем есть соответствующий текст под кнопкой &ldquo;Регистрация&rdquo;.&nbsp;<br/> <br/> Правовые отношения между Пользователем и Администрацией по настоящему Соглашению регулируются законодательством России.</span>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">&nbsp;</span></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><strong><span
                                                    style="font-size: 14.0pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">Услуги Сайта</span></strong></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Сайт предоставляет услуги просмотра и размещения информации, добавленной Пользователями с целью продажи или покупки товаров и услуг.&nbsp;<br/> <br/> Все сделки заключаются между Пользователями напрямую. Администрация не является участником сделок Пользователей, а только предоставляет интернет платформу для размещения информации.&nbsp;<br/> <br/> Администрация не выполняет проверку на достоверность информации, указанной Пользователями, и не несет ответственности перед любыми третьими лицами за точность и достоверность такой информации.</span>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">&nbsp;</span></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><strong><span style="font-size: 14.0pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">Размещение информации на Сайте</span></strong>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Совокупность регистрационных данных Пользователя (далее Учётная запись), Администрация имеет право публиковать полностью или частично на Сайте и сайтах партнерах в любых разделах.&nbsp;<br/> Пользователь соглашается с тем, что Администрация имеет право собирать, обрабатывать и хранить Учётную запись Пользователя на Сайте в целях исполнения настоящего Соглашения.&nbsp;<br/> <br/> Зарегистрированный Пользователь несет персональную ответственность за безопасность своей пары логин-пароль, указанных им при регистрации или при последующем изменении, а также несет полную ответственность за все действия, которые будут совершены Пользователем или любым другим лицом в процессе использования его пары логин-пароль. Пользователь обязан немедленно изменить свой пароль, если у него появились подозрения, что его пара логин-пароль стала раскрыта или может быть использована третьими лицами.&nbsp;<br/> <br/> Регистрационные данные компании публикуются на Сайте в момент завершения регистрация, а проверяются через некоторое время после регистрации. Если содержание Учётной записи нарушает правила регистрации (в т.ч. не указаны требуемые данные или неверно указанный раздел), настоящее Соглашение или содержит информацию, которая противоречит требованиям действующего законодательства, то такая Учётная запись удаляется Администрацией.&nbsp;<br/> <br/> Пользователь обязуется не создавать несколько Учётных записей на Сайте от фактически одного и того же юридического или физического лица, в том числе используя при этом разные названия компаний, фамилий, адресов и других данных.&nbsp;<br/> <br/> Зарегистрированный Пользователь имеет право и возможность самостоятельно удалить свою Учётную запись и свои объявления.&nbsp;<br/> <br/> Размещая свою информацию на Сайте Пользователь соглашается с нижеследующими правилами:</span>
                                    </p>
                                    <ul style="margin-top: 0cm;">
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Запрещено публиковать одинаковые или почти одинаковые по смыслу объявления;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Запрещено публиковать объявления в разделе, не соответствующем тематике раздела;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">В одном объявлении не должно быть более одного товара или услуги;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">В заголовке и описании объявлений запрещено публиковать контактные данные и адреса сайтов;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">При публикации объявления об услуге, которая подлежит лицензированию, Пользователь обязан указать номер лицензии и кем она выдана;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Запрещено публиковать объявления, заголовок или описание которого является логически не связанными и нечитаемыми;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Запрещено публиковать оскорбления и нецензурные выражения;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Запрещено публиковать информацию, которая может относиться к сбору и хранению персональных данных о других пользователях;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Запрещено публиковать объявления о заработке в Интернете, о проведение массовых электронных рассылок, о сетевом маркетинге, о работе, требующей материальных вложений, об эротических и оккультных услугах;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Запрещено публиковать объявления о товарах и услугах запрещенных к публикации действующим законодательством России.</span>
                                        </li>
                                    </ul>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Пользователь соглашается и принимает на себя полную ответственность за соответствие размещаемой им информации требованиям действующего законодательства, в том числе Пользователь соглашается с тем, что он несет полную ответственность за:</span>
                                    </p>
                                    <ul style="margin-top: 0cm;">
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Несоблюдение авторских прав третьих лиц, в т.ч. за использование фотографий третьих лиц;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Несанкционированное использование названий компаний;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Несанкционированное использование логотипов третьих лиц;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Несанкционированное использование знаков, в т.ч. торговых марок третьих лиц.</span>
                                        </li>
                                    </ul>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> В случае поступления претензий от третьих лиц, связанных с информацией, размещенной Пользователем на Сайте, Пользователь обязуется самостоятельно и за свой счет урегулировать такие претензии.&nbsp;<br/> <br/> Объявления публикуются на Сайте в момент размещения, а проверяются через некоторое время после размещения, если содержание объявлений нарушает правила размещения объявлений, то оно удаляется Администрацией. За повторяющие нарушения правил размещения объявлений или за многократное нарушений правил в один день, а также за заведомо ложную информацию в размещенном Пользователем объявлении Учётная запись Пользователя может быть удалена Администрацией.&nbsp;<br/> <br/> Администрация имеет право:</span>
                                    </p>
                                    <ul style="margin-top: 0cm;">
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Редактировать или удалять публикации Пользователя на Сайте, если они нарушают условия настоящего Соглашения, наносят вред Администрации или третьим лицам, а также по своему личному усмотрению без указания причины.</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">Размещать публикации Пользователя, находящиеся в открытом доступе, на сайтах партнерах.</span>
                                        </li>
                                    </ul>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Администрация имеет право по первому требованию соответствующего уполномоченного (правоохранительного) органа, но в соответствии с действующим законодательством, предоставлять такому государственному органу имеющуюся информацию о Пользователе, не исключая персональные данные.</span>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">&nbsp;</span></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><strong><span style="font-size: 14.0pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">Ограничение ответственности</span></strong>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Администрация не несет ответственности:</span>
                                    </p>
                                    <ul style="margin-top: 0cm;">
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">За неполадки в работе Сайта, вызванные перебоями в работе оборудования и программного обеспечения, за сбои, возникающие в телекоммуникационных или энергетических сетях, за сбои, вызванные действиями вредоносных программ или третьих лиц;</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">За содержание, достоверность и законность информации, опубликованной Пользователем на Сайте.</span>
                                        </li>
                                        <li style="color: #262626; margin-bottom: .0001pt; line-height: 125%; tab-stops: list 36.0pt; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif';">За упущенную выгоду или вред/ущерб, причиненный Пользователю, за любые другие убытки, которые могут возникнуть при использовании Сайта и информации, размещенной на нем.</span>
                                        </li>
                                    </ul>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Администрация не участвует в сделках между Пользователями, поэтому не несет никакой ответственности по этим сделкам.&nbsp;<br/> <br/> Все споры между Пользователями решаются ими самостоятельно без привлечения Администрации. Пользователь соглашается решать все споры с другим Пользователем самостоятельно и предъявлять претензии другому Пользователю напрямую без привлечения к таким спорам Администрации.&nbsp;<br/> <br/> Пользователь имеет право сообщить Администрации о нарушениях его прав другим Пользователем. В случае достаточности обоснований жалобы Пользователя и достаточности знаний предмета жалобы Администрацией, Администрация удалит с Сайта часть объявление или все объявление, на которое жалуется Пользователь.</span>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">&nbsp;</span></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><strong><span style="font-size: 14.0pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">Обработка персональных данных</span></strong>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Регистрируясь на Сайте, Пользователь соглашается с тем, что указанные им персональные данные являются общедоступными, а также Пользователь дает согласие на обработку его персональных данных Администрацией. Также Пользователь дает свое согласие на передачу своих персональных данных третьим лицам, в том числе на передачу персональных данных за границу.&nbsp;<br/> <br/> Обработка персональных данных включает в себя любые действия или совокупность действий, связанных со сбором, регистрацией, накапливанием, хранением, адаптированием, изменением, обновлением, использованием, распространением, передачей, удалением персональных данных Пользователя с целью обеспечения работы сервисов Сайта.&nbsp;<br/> <br/> Персональные данные обрабатываются Осетровым В.А., зарегистрированная по адресу г. Волгоград, ул. Шекснинская д. 62. Первичная база персональных данных хранится и обрабатывается на сервере SSD-VPS-2 "Торговая площадка "ОПТхимик", зарегистрированным 13.05.2017 г на сайте REG.RU компании ООО &laquo;Регистратор доменных имён РЕГ.РУ&raquo;.</span>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">&nbsp;</span></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">Обработка Администрацией персональных данных Пользователя осуществляется в целях обеспечения функционирования Сайта и предоставления Пользователю персонализированных сервисов Сайта. Администрация не несет ответственности за использование персональных данных Пользователя другими лицами.</span>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">&nbsp;</span></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><strong><span
                                                    style="font-size: 14.0pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;">Заключительные положения</span></strong></p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%; background: #F3F3F3;"><span style="font-size: 9.5pt; line-height: 125%; font-family: 'Helvetica','sans-serif'; color: #262626;"><br/> Соглашение или любая его часть может быть изменена Администраций без какого-либо специального уведомления Пользователя. Новая редакция Соглашения вступает в действие с момента ее размещения на Сайте. Действующая версия Соглашения всегда доступна по адресу&nbsp;http://opt-himik.ru/register.<br/> <br/> Сообщения для Администрации отправляются через функцию-ссылку &ldquo;Напишите нам&rdquo;, расположенную внизу на всех страницах Сайта.</span>
                                    </p>
                                    <p style="margin-bottom: .0001pt; line-height: 125%;"><span style="color: #262626;">&nbsp;</span></p>


                                </div>

                                </span>
                            </div>
                            <div id="overlay"></div><!-- Пoдлoжкa -->
                        </form>

                        <form class="country_live" type="post" enctype="application/x-www-form-urlencoded">
                            <input type="hidden" name="id_country" class="countryajax" value="" style="
    padding-top: 2px;
    padding-bottom: 1px;
    height: 27px;
    font-size: 13px;
    width: 100%;
">
                            {{csrf_field()}}
                        </form>
                        <form class="subcategory_live" type="post" enctype="application/x-www-form-urlencoded">
                            <input type="hidden" name="id_category" class="regionajax" value="" style="
    padding-top: 2px;
    padding-bottom: 1px;
    height: 27px;
    font-size: 13px;
    width: 100%;
">
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-right" style="width:400px">

                <div class="header-b2" style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;">Мои вакансии <a class="float-right">{{$vacant->total()}}</a></div>

                <input type="hidden" id="user" value="{{Auth::user()->id}}">
                @foreach($vacant as $advertnew)
                    <div class="advert-content-home">

                        <span class="span-right" style="width:100%">
                                <a style="color:#00008b;font-weight: bold" href="/vacant/{{$advertnew->slug}}"><?=mb_substr($advertnew->name, 0, 40)?>...</a>

                                <form class="delete-form" style="display: inline;">
                                    {{ csrf_field() }}
                                    <a class="delete" onclick="advertDelete({{$advertnew->id}}); return false;">
                                    <input class="delete-advert" name="id" type="hidden" value="{{$advertnew->id}}">
                                    <i class="fa fa-times fa-lg" aria-hidden="true" style="padding-left:10px;float: right;color:red;"></i></a></form>
                                <a href="/vacant/edit/{{$advertnew->id}}/{{$advertnew->slug}}">
                                    <i class="fa fa-pencil fa-lg" aria-hidden="true" style="float: right;color:blue;"></i></a>


                                <p style="margin:0;word-wrap: break-word">Описание: {{mb_substr($advertnew->description,0,60)}}...</p>
                                <p style="margin:0;word-wrap: break-word">Зарплата: {{$advertnew->price}} - {{$advertnew->price1}} {{$advertnew->valute}}</p>
                                <p style="margin:0">Добалено: {{ \Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($advertnew->created_at)->formatLocalized('%d %f %Y') }}</p>

                            @if(isset($advertnew->types->price))
                                <b>Цена: {{$advertnew->types[0]->price}}</b>
                            @else

                            @endif

                            @if(($advertnew->status) == 0)
                                <p>Статус:

                                        <b style="color: green;">На модерации</b>
                                    @endif
                                    </p>
                            </span>
                    </div>
                @endforeach
                {{$vacant->render()}}
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>

        function clearImg() {
            $('#image').attr('src', '');
            $('#image').css('height', '234px');
            $('#loadfile').css('display', 'block');
        }


        $(document).ready(function () { // вся мaгия пoсле зaгрузки стрaницы
            $('#go').click(function (event) { // лoвим клик пo ссылки с id="go"
                event.preventDefault(); // выключaем стaндaртную рoль элементa
                $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
                    function () { // пoсле выпoлнения предъидущей aнимaции
                        $('#modal_form')
                            .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                            .animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
                    });
            });
            /* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
            $('#modal_close, #overlay').click(function () { // лoвим клик пo крестику или пoдлoжке
                $('#modal_form')
                    .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                        function () { // пoсле aнимaции
                            $(this).css('display', 'none'); // делaем ему display: none;
                            $('#overlay').fadeOut(400); // скрывaем пoдлoжку
                        }
                    );
            });
        });

        function refresh() {
            var user_id = $('#user').attr('value');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/advert/refresh/" + user_id,
                response: 'text',
                data: {user_id: user_id},
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        }

        function advertDelete(e) {

            if (confirm("Вы уверены, что хотите удалить?\nЭта операция не восстановима."))

                var id = e;
            var _data = $('.delete-form').serialize();

            $.ajax({
                type: "POST",
                url: "/vacant/delete/" + id,
                response: 'text',
                data: _data,
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })


        }
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').css('height', 'auto');
                    $('#loadfile').css('display', 'none');

                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function loadImage() {
            $("#uploadbtn").click();
        }

        $("#uploadbtn").change(function () {
            readURL(this);
            $('#loadfile').css('display', 'none');

        });

        $(".category_select").change(function () {

            $('#subcat').fadeIn();
            $('#subcat').empty();

            var id = $('.category_select :selected').attr('id');

            $('.category_selected').attr('value', $('.category_select :selected').attr('id'));

            $('.regionajax').attr('value', id);


            var _data = $('.subcategory_live').serialize();


            $.ajax({
                type: "POST",
                url: "/test/" + id,
                response: 'text',
                data: _data,
                success: function (data) {

                    $("#subcat").append("<option>Выберите подрубрику</option>").fadeIn();

                    $.each(data, function (i, star) {

                        console.log(star);


                        $("#subcat").append('<option id="' + star.id + '">' + star.title + '</option>').fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });

        $('#subcat').change(function () {

            $('.subcategory_selected').attr('value', $('#subcat :selected').attr('id'));

        });

        $("#country").change(function () {

            $('#region').fadeIn();
            $('#region').empty();

            var id = $('#country :selected').attr('id');

            console.log(id);

            $('.countryajax').attr('value', id);


            var _data = $('.country_live').serialize();


            $.ajax({
                type: "POST",
                url: "/test/country/" + id,
                response: 'text',
                data: _data,
                success: function (data) {
                    console.log(data);
                    $("#region").append("<option>Выберите Регион</option>").fadeIn();

                    $.each(data, function (i, star) {

                        console.log(star);


                        $("#region").append('<option id="' + star.id + '"value="' + star.id + '">' + star.name + '</option>').fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });


    </script>
    <script>
        $(document).ready(function () { // вся мaгия пoсле зaгрузки стрaницы
            $('#confid').click(function (event) { // лoвим клик пo ссылки с id="go"
                event.preventDefault(); // выключaем стaндaртную рoль элементa
                $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
                    function () { // пoсле выпoлнения предъидущей aнимaции
                        $('#modal_form')
                            .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                            .animate({opacity: 1, top: '30%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
                    });
            });
            /* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
            $('#modal_close, #overlay').click(function () { // лoвим клик пo крестику или пoдлoжке
                $('#modal_form')
                    .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                        function () { // пoсле aнимaции
                            $(this).css('display', 'none'); // делaем ему display: none;
                            $('#overlay').fadeOut(400); // скрывaем пoдлoжку
                        }
                    );
            });
        });

        $('.get_city').bind("keyup", function () {


            var _token = $('.search_live').serialize();
            var data_id = this.value;
            if (this.value.length >= 3) {
                $.ajax({
                    type: "POST",
                    url: "/test/city/" + data_id,
                    response: 'text',
                    data: _token,
                    success: function (data) {
                        console.log(data);

                        $('.search_result').empty();
                        var parser = document.createElement('a');
                        parser.href = window.location.href;


                        $.each(data, function (i, star) {


                            $(".search_result").append("<a class='search_load w-100 m-0'  id='"+star.id+"' style='display: inline-block;  '>" + star.name + "</a>").fadeIn();


                        });

                        //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                    },
                    error: function (xhr, str) {
                        console.log(_token);
                        alert('Возникла ошибка: ' + xhr.responseCode);
                    }


                });
            }
        });
        $( "body" ).click(function( event ) {
            $('.search_load').on('click', function (e) {
                e.preventDefault();
                $('.get_city').val($(this).text());
                $('.search_result').empty();
                $('.search_result').css('display','none');
                $('#sendForm').append('<input type="hidden" value="'+$(this).attr('id')+'" name="city">')
            })
        });

    </script>
@endsection
