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
                        {{$lan==1?'本网站或微信小程序中涉及的所有信息都仅为服务香港专业投资者或其他地区同等投资者，并不是提供给其他类型投资者直接使用。':"The information in this website 'or' Wechat Mini Programs is aimed at professional investors in Hong Kong 'or' its equivalence elsewhere. It is not intended for direct use by any other type of investor."}}</p>
                    <p class="alertText mb30">{{$lan==1?"对于非机构投资者，部分投资于新兴市场、特定市场板块、或者高收益债券的资金，将可能涉及流通、交易对手、市场波动、及/或集中风险等高投资风险。如果为您推荐基金的中介已经向您明确解释了这款基金，并且该基金符合您的投资目标，您可以进行投资，但是您不应该投资任何不明确的基金。本网站提供的内容仅供参考，请投资者勿以本网站作为投资依据。":"For Non-Institutional Investors, some of the Funds may invest in emerging markets 'or' a specific market 'or' sector and in high yield bonds, which may involve higher risks such as liquidity, counterparty, market volatility and/'or' concentration risks. The investment decision is yours but you should not invest in the Fund unless the intermediary which offers you the Funds has advised you that the Funds are suitable for you and has explained why, including how investment in the Funds would be consistent with your investment objectives. Investors should not base on this website alone to make any investment decision."}}</p>
                    <p class="alertText mb30">{{$lan==1?'过去的表现并不能代表未来的投资回报。您的投资价值以及任何投资回报有可能上升或者下降。您也可能无法收回最初投资的全部金额。请注意，维世资产管理（香港）有限公司（下称“维世香港”）不会向任何个人投资者提供投资建议。':"Past performance is not a guide to future investment results. The value of your investments and any income derived from them can go down as well as up. You may not get back the full amount initially invested. Please be aware that VS Partners (Hong Kong) Co., Limited (“VSPHK”) does not make recommendations to individual investors 'or' provide investment advice to individuals. "}}</p>
                    <p class="alertText yellow mb30 bold">{{$lan==1?'请仔细阅读以下重要条款。如果您对以下条款有任何异议，请勿同意声明和进入网站。':"Please read this Important Information. If you do not agree to any part of the following sections, please do not accept and enter into the website."}}</p>
                    <p class="alertText yellow mb30 bold">{{$lan==1?'网站免责声明':'Website disclaimer'}}</p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'使用网站':'Use of Site.'}}</span>{{$lan==1?'本网站提供的所有信息，若不能在个别司法管辖区或国家合法分销，或导致维世香港或其母公司或其附属公司或联属公司须遵照该司法管辖区或国家的规定的监管，则网站不提供予该等人士或机构进行使用。任何个人或者公司如要回应或者参考本网站的内容，必须确保自身不受当地任何机关限制或者禁止此行为。':"The information provided on this site is not intended for distribution to, 'or' use by, any person 'or' entity in any jurisdiction 'or' country where such distribution 'or' use would be contrary to law 'or' regulation 'or' which would subject VSPHK, fellow subsidiaries, associates 'or' other affiliates to any regulatory requirement within such jurisdiction 'or' country. Any person 'or' entity who intends to respond to 'or' rely upon the information on this site must satisfy himself that he is not subject to any local requirement which restricts 'or' prohibits him from doing so. "}}
                    </p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'不提供任何投资建议':'No Offer.'}}</span>{{$lan==1?'维世香港网站上的任何信息或者观点都不构成任何投资买卖的建议。无论是主理人或者其他代理人都不会针对任何证券，期货，期权或者其他金融工具提供投资建议。':" Neither the information nor any opinions contained in this site constitutes a solicitation 'or' offer by VSPHK to buy 'or' sell, whether as principal 'or' agent, any securities, futures, options 'or' other financial instruments 'or' provide any investment service 'or' investment advice."}}
                    </p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'不提供保证':'No Warranty.'}}</span>{{$lan==1?'虽然本网站提供予阁下的信息均来自我们认为可靠的来源资料，但是维世香港不能亦不会就任何内容的准确性，有效性，及时性或者完整性做出任何保证。维世香港明确否认对于任何适销性或者某一特定用途的适用性的担保。本网站上的内容仅按当时情况提供，如有任何变更，恕不预先通知。':"Although the information on this site is obtained 'or' compiled from sources, we believe to be reliable, VSPHK cannot and does not warrant the accuracy, validity, timeliness 'or' completeness of any such information. VSPHK expressly disclaims any warranties of merchantability 'or' fitness of a particular purpose 'or' duties of care. All information on this site is provided “as is”, and is subject to change without prior notice. "}}
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'责任限制。':'Limitation of Liability. '}}</span>{{$lan==1?'在任何情况下，维世香港的任何成员都不会对导致阁下不能访问或者使用网站及其他页面上的网站链接而导致的任何直接、间接、特殊、惩罚性、或者意外性损失，承担任何责任。此等损失包括由任何第三章提及的行为或者疏忽所导致，即使维世香港任何成员事先获悉有招致此等损失的可能。':"In no event will any member of VSPHK be liable 'or' have any responsibility for damages of any kind, whether direct, indirect, special, consequential 'or' incidental, resulting from access 'or' use of, 'or' inability to access 'or' use, this site 'or' any sites 'or' pages linked to this site, including (without limitation) damages resulting from the act 'or' omission of any third party, even if any member of VSPHK has been advised of the possibility thereof. "}}</p>
                    </p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'版权。':'Copyright.'}}</span>{{$lan==1?'未经维世香港事先书面同意，不得以任何形式和目的修改、复制、传播和发布本网站上的任何内容。如果阁下由本网址下载任何信息或软件，即表示阁下同意不会复制该等资料或软件，或除去、隐藏该等数据所载的任何版权或其它通告或标题，并且在你的材料中引用信息来源。':"The information on this site may not be reproduced, distributed 'or' published in any medium for any purpose without prior express written consent from VSPHK. If you download any information 'or' software from this site, you agree that you will not copy it 'or' remove 'or' obscure any copyright 'or' other notices 'or' legends contained in any such information and quote “source of information” in your own materials. "}}
                    </p>
                    <p class="alertText">
                        <span class="yellow">{{$lan==1?'重要事项。':'Important.'}}</span>{{$lan==1?'阁下于浏览本网站的任何内页，即表示阁下同意上述的合约条款。':"By accessing this site and any of its pages you are agreeing the terms and conditions set out above."}}
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