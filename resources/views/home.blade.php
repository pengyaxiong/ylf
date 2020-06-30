@extends('layouts.app')
<style>
    .index-mission-con>p{
        height: 130px;
    }
    .index-content-desc{
        height: 99px;
    }
</style>
@section('content')
    <div class="index-body">
        <div class="index-swiper d-minWidth swiper-container">
            <div id="banner" class="swiper-wrapper">
                @foreach($banners as $banner)
                    <div class="swiper-slide"><img class="index-swiper-img"
                                                   src="{{\Storage::disk(config('admin.upload.disk'))->url($banner->image)}}"
                                                   alt=""/>
                    </div>
                @endforeach
            </div>
            <div class="index-ban-pagination">
                @foreach($banners as $banner)
                    <p class="@if($loop->first) on @endif">0{{$loop->index+1}}</p>
                @endforeach
            </div>
        </div>
        <div class="index-mix">
            <div class="index-mix-con index-sec1400 d-content">
                <div class="index-mission">
                    <p class="newTitle">{{$lan==1?'我们的使命':'OUR MISSION'}}</p>
                    <div class="index-mission-con">
                        <p>{{$mission->description}}</p>
                        <section class="chartView">
                            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($mission->image)}}"/>
                            {{--<div class="chartLi chartLi-top">--}}
                            {{--<div>Multi-GenerationAsset Perseveration</div>--}}
                            {{--<div>(Mean)</div>--}}
                            {{--</div>--}}
                            {{--<div class="chartLi chartLi-bottomLeft">--}}
                            {{--<div>People-to-People Bridge</div>--}}
                            {{--<div>(Path)</div>--}}
                            {{--</div>--}}
                            {{--<div class="chartLi chartLi-bottomRight">--}}
                            {{--<div>Multi-generation World-wide Impact</div>--}}
                            {{--<div>(Ends)</div>--}}
                            {{--</div>--}}
                        </section>
                    </div>
                </div>
                <div class="index-values">
                    <p class="newTitle">{{$lan==1?'核心价值观':'PRINCIPLE VALUES'}}</p>
                    <div class="index-mission-con">
                        <p>{{$principle->description}}</p>
                        <div class="index-values-swiper swiper-container">
                            <div id="mission" class="swiper-wrapper">
                                @foreach($principle->images as $image)
                                    <div class="swiper-slide">
                                        <img class="d-img"
                                             src="{{\Storage::disk(config('admin.upload.disk'))->url($image)}}" alt=""/>
                                    </div>
                                @endforeach
                            </div>
                            <img class="index-values-swiper-arrow" src="/home/images/index-swiper-arrow.png" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="index-business d-minWidth">
            <div class="index-sec1400 d-content">
                <p class="newTitle color_f">{{$lan==1?'我们的业务':'OUR BUSINESS'}}</p>
                <div class="index-business-con">
                    @foreach($business as $busine)
                        @if($loop->first)
                            <div class="index-business-item">
                                <img class="d-img"
                                     src="{{\Storage::disk(config('admin.upload.disk'))->url($busine->image)}}" alt=""/>
                                <div class="index-business-item-slide">
                                    {{$busine->description}}
                                </div>
                            </div>
                        @endif
                        @if($loop->last)
                            <div class="index-business-item right">
                                <img class="d-img"
                                     src="{{\Storage::disk(config('admin.upload.disk'))->url($busine->image)}}" alt=""/>
                                <div class="index-business-item-slide">
                                    {{$busine->description}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="index-content">
            <div class="index-sec1400 d-content">
                <p class="newTitle">{{$lan==1?'内容':'CONTENT'}}</p>
                <div class="index-content-con">
                    @foreach($articles as $article)
                        @if($loop->first)
                            <div class="index-content-item">
                                <div class="index-content-item-head">
                                    <div class="index-content-item-date d-middle">
                                        <div class="d-middle-item">
                                            <h4>{{date('d',strtotime($article->time))}}</h4>
                                            <p>{{$lan==1?date('m',strtotime($article->time)):date('M',strtotime($article->time))}}</p>
                                        </div>
                                    </div>
                                    <img class="d-img" src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}" alt=""/>
                                </div>
                                <div class="index-content-body">
                                    <h3 class="index-content-tit">{{$article->title}}</h3>
                                    <div class="index-content-desc">
                                        {{$article->description}}
                                    </div>
                                    <p class="index-content-btn" onclick="location.href='/content_detail/{{$article->id}}'"><img src="/home/images/icon-lock.png" alt=""/>
                                        {{$lan==1?'阅读权限只开放VSP的客户':'Reading permission is only open to VSP customers'}}</p>
                                </div>
                            </div>
                        @endif
                        @if($loop->last)
                            <div class="index-content-item right">
                                <div class="index-content-item-head">
                                    <div class="index-content-item-date d-middle">
                                        <div class="d-middle-item">
                                            <h4>{{date('d',strtotime($article->time))}}</h4>
                                            <p>{{$lan==1?date('m',strtotime($article->time)):date('M',strtotime($article->time))}}</p>
                                        </div>
                                    </div>
                                    <img class="d-img" src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}" alt=""/>
                                </div>
                                <div class="index-content-body">
                                    <h3 class="index-content-tit">{{$article->title}}</h3>
                                    <div class="index-content-desc">
                                       {{$article->description}}
                                    </div>
                                    <p class="index-content-btn"  onclick="location.href='/content_detail/{{$article->id}}'"><img src="/home/images/icon-lock.png" alt=""/>
                                        {{$lan==1?'阅读权限只开放VSP的客户':'Reading permission is only open to VSP customers'}}
                                        </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- alert -->
        <section id="alertView">
            <section id="alert">
                <p class="alertTitle yellow">{{$lan==1?'免责声明':'Disclaimer'}}</p>
                <div class="alertContent">
                    <p class="alertText mb30">
                        {{$lan==1?'的信息在这个网站的目的是在香港的专业投资者或其等价。它不是为了直接使用任何其他类型的投资者。':"The information in this website is aimed at professional investors in Hong Kong 'or' its equivalence elsewhere. It is not intended for direct use by any other type of investor."}}</p>
                    <p class="alertText mb30">{{$lan==1?"非机构投资者,一些基金可能投资在新兴市场或特定市场或行业,在高收益债券,这可能包括更高的风险如流动性、交易对手、市场波动和/或浓度的风险。
投资决策是你的,但你不应该投资于基金,除非中介提供你的基金的基金建议适合你,并解释了为什么,包括投资基金如何将符合您的投资目标。
投资者不应基于本网站作出任何投资决定。":"For Non-Institutional Investors, some of the Funds may invest in emerging
                        markets 'or' a specific market 'or' sector and in high yield bonds, which may involve higher risks
                        such as liquidity, counterparty, market volatility and/'or' concentration risks. The investment
                        decision is yours but you should not invest in the Fund unless the intermediary which offers you
                        the Funds has advised you that the Funds are suitable for you and has explained why, including
                        how investment in the Funds would be consistent with your investment objectives. Investors
                        should not base on this website alone to make any investment decision."}}</p>
                    <p class="alertText mb30">{{$lan==1?'过去的表现不能指导未来的投资结果。你的投资的价值和任何所得以及会上涨,也会下跌。
                    你可能不回到最初投资的全部金额。请注意,与合作伙伴(香港)有限公司,有限公司(“VSPHK”)不建议个人投资者或为个人提供投资建议。':"Past performance is not a guide to future investment results. The value of
                        your investments and any income derived from them can go down as well as up. You may not get
                        back the full amount initially invested. Please be aware that VS Partners (Hong Kong) Co.,
                        Limited (“VSPHK”) does not make recommendations to individual investors 'or' provide investment
                        advice to individuals."}}</p>
                    <p class="alertText yellow mb30 bold">{{$lan==1?'请阅读这一重要信息。
如果您不同意以下部分的任何部分,请不要接受并进入该网站。':"Please read this Important Information. If you do not agree to
                        any part of the following sections, please do not accept and enter into the website."}}</p>
                    <p class="alertText yellow mb30 bold">{{$lan==1?'网站免责声明':'Website disclaimer'}}</p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'使用的网站':'Use of Site.'}}</span>{{$lan==1?'本网站提供的信息并非旨在分布,或使用,任何个人或实体在任何管辖或国家,这样的分配或使用违反法律或法规或主题VSPHK,其他子公司,同事或其他子公司在管辖权或任何监管要求的国家。
任何个人或实体打算回应或依赖本网站的信息必须满足自己,他不受任何本地需求限制或者禁止他这么做。':"The information provided on this site is not intended for distribution to, 'or' use by, any person
                        'or' entity in any jurisdiction 'or' country where such distribution 'or' use would be contrary to law
                        'or' regulation 'or' which would subject VSPHK, fellow subsidiaries, associates 'or' other affiliates
                        to any regulatory requirement within such jurisdiction 'or' country. Any person 'or' entity who
                        intends to respond to 'or' rely upon the information on this site must satisfy himself that he is
                        not subject to any local requirement which restricts 'or' prohibits him from doing so."}}

                    </p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'没有提供':'No Offer.'}}</span>{{$lan==1?'无论是信息还是这个网站中包含的任何观点构成教唆或提供VSPHK购买或出售,是否作为主要或代理,任何证券、期货、期权等金融工具或提供任何投资服务或投资建议。':" Neither the information nor any opinions contained in this site constitutes a solicitation 'or'
                        offer by VSPHK to buy 'or' sell, whether as principal 'or' agent, any securities, futures, options
                        'or' other financial instruments 'or' provide any investment service 'or' investment advice."}}

                    </p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'不保修的':'No Warranty.'}}</span>{{$lan==1?'虽然获得的信息在这个网站或编译来源,我们相信是可靠的,VSPHK不能,不保证准确性、有效性、及时性和完整性的任何此类信息。
VSPHK明确放弃任何保证适销性或健身的一个特定的目的或职责的护理。
所有信息在这个网站上提供了“是”,如有更改,恕不另行通知。':"
                        Although the information on this site is obtained 'or' compiled from sources, we believe to be
                        reliable, VSPHK cannot and does not warrant the accuracy, validity, timeliness 'or' completeness
                        of any such information. VSPHK expressly disclaims any warranties of merchantability 'or' fitness
                        of a particular purpose 'or' duties of care. All information on this site is provided “as is”, and
                        is subject to change without prior notice."}}
                    <p class="alertText">{{$lan==1?'责任限制。
在没有任何事件将VSPHK负责的成员或有任何形式的损害赔偿责任,是否直接、间接、特殊、间接或附带产生的访问或使用,或无法访问或使用本网站或任何与本网站相关的网站或网页,包括(但不限于)造成损害的行为或遗漏任何第三方,即使任何成员VSPHK一直建议的可能性。':"Limitation of Liability. In no event will any member of VSPHK be liable 'or' have
                        any responsibility for damages of any kind, whether direct, indirect, special, consequential 'or'
                        incidental, resulting from access 'or' use of, 'or' inability to access 'or' use, this site 'or' any
                        sites 'or' pages linked to this site, including (without limitation) damages resulting from the
                        act 'or' omission of any third party, even if any member of VSPHK has been advised of the
                        possibility thereof. "}}</p>
                    </p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'版权':'Copyright.'}}</span>{{$lan==1?'这个网站上的信息可能不是复制,分发或发表在任何媒介为任何目的从VSPHK没有事先书面同意。
如果你从本网站下载任何资料或软件,你同意不会复制或删除或掩盖任何版权或其他通知或传说中包含任何此类信息和引用的信息来源”在自己的材料。':"The information on this site may not be reproduced. distributed 'or' published in any medium for
                        any purpose without prior express written consent from VSPHK. If you download any information 'or'
                        software from this site. you agree that you will not copy it 'or' remove 'or' obscure any copyright
                        'or' other notices 'or' legends contained in any such information and quote “source of information”
                        in your own materials."}}

                    </p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'重要的':'Important.'}}</span>{{$lan==1?'通过访问本网站和它的任何页面你同意上面的条款和条件。':" By accessing this site and any of its pages you are agreeing the terms and conditions set out
                        above."}}

                    </p>
                </div>
                <div class="alertBtns">
                    <p class="agree">{{$lan==1?'接受':'Accept'}}</p>
                    <p class="refuse">{{$lan==1?'不接受':'Not accept'}}</p>
                </div>
            </section>

        </section>

        @include("layouts._footer")

    </div>
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function () {
            if (!sessionStorage.getItem("text")) {
                $('.index-body').addClass('fixed')
                $('#alertView').show()
            }
            // 协议
            $('.refuse').click(function () {
                swal("错误!", "请阅读并同意！", "error");
            })
            $('.agree').click(function () {
                sessionStorage.setItem("text", true);
                $('.index-body').removeClass('fixed')
                $('#alertView').hide()
            })

            setNavBg();
            var hasLogin = getLocalStorage('hasLogin');
            new Swiper('.index-swiper', {
                autoplay: 3500,
                autoplayDisableOnInteraction: false,
                loop: true,
//      pagination:'.swiper-pagination'
                onSlideChangeStart: function (swiper) {
//        console.log(swiper)
                    var index = swiper.activeLoopIndex;
                    $('.index-ban-pagination p').eq(index).addClass('on').siblings().removeClass('on');
                }
            })
            var mySwiper = new Swiper('.index-values-swiper', {
//      autoplay:3500,
//      autoplayDisableOnInteraction:false,
                loop: true,
                onlyExternal: true,
//      mode:'vertical',
//      pagination:'.mission-pg'
            })
            $('.index-values-swiper-arrow').on('click', function () {
                mySwiper.swipeNext()
            })

            // 点击 退出
            $('#logout').on('click', function () {
                removeLocalStorage('hasLogin')
            })
        })

        function setBanner(data) {
            var str = '';
            for (var i = 0; i < data.length; ++i) {
                str += '<a href="" class="swiper-slide"><img class="index-swiper-img" src="' + data[i].src + '" alt=""/></a>'
            }
            $('#banner').html(str)
            new Swiper('.index-swiper', {
                autoplay: 3500,
                autoplayDisableOnInteraction: false,
                loop: true,
                pagination: '.swiper-pagination',
                onAutoplayStop: function (swiper) {
                    if (!swiper.support.transitions) { //IE7、IE8
                        swiper.startAutoplay()
                    }
                }
            })
        }

        function setMission(data) {
            var str = '';
            for (var i = 0; i < data.length; ++i) {
                str += '<a href="" class="swiper-slide"><img class="d-img" src="' + data[i].src + '" alt=""/></a>'
            }
            $('#mission').html(str)
            new Swiper('.index-mission-swiper', {
                autoplay: 3500,
                autoplayDisableOnInteraction: false,
                loop: true,
                mode: 'vertical',
                pagination: '.mission-pg',
                onAutoplayStop: function (swiper) {
                    if (!swiper.support.transitions) { //IE7、IE8
                        swiper.startAutoplay()
                    }
                }
            })
        }

        function setPublicPT(data) {
            var str = '';
            for (var i = 0; i < data.length; ++i) {
                str += '<a href="detail.html?id=' + data[i].id + '" class="index-public-item-link"><div><img class="d-img" src="' + data[i].src + '" alt=""/></div><p class="d-ellipsis-multiple">' + data[i].desc + '</p></a><p class="index-public-item-date">' + data[i].hour + ' hours ago</p>'
            }
            $('#publicPT').html(str)
        }

        function setPublicT(data) {
            var str = '';
            for (var i = 0; i < data.length; ++i) {
                str += '<div class="index-public-right-item"><a href="detail.html?id=' + data[i].id + '">' + data[i].desc + '</a><p>' + data[i].hour + ' hours ago</p></div>'
            }
            $('#publicT').html(str)
        }

        function setNavBg() {
            setClass();
            $(window).on('scroll', function () {
                setClass();
            });

            function setClass() {
                var nav = $('.header');
                if ($(window).scrollTop() > 100) {
                    nav.removeClass('transparent');
                } else {
                    nav.addClass('transparent');
                }
            }
        }
    </script>
@endsection