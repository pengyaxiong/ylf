<div class="index-contact d-minWidth">
    <div class="index-sec1400 d-content">
        <p class="newTitle yellow">{{$lan==1?'联系我们':'Contact Us'}} </p>
        <div class="index-contact-con">
            <p class="index-contact-company">{{$lan==1?$config->name_cn:$config->name_en}} </p>
            <p>{{$lan==1?$config->address_cn:$config->address_en}}</p>
            <p>{{$config->tel}}</p>
            <p>{{$config->email}}</p>
        </div>
    </div>
</div>