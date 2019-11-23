@if(isset($expert_profile))
    <?php $profile_details = $expert_profile->profile_details;?>
    @if(!empty($profile_details))
<header class="header" style="<?php if(!empty($profile_details->image)){?>background-image:url({{ $profile_details->web_image }});<?php }else {?>background-color:black;<?php }?>">
            <div class="container profile-content">
                <div class="row">
                    <div class="col-12">
                        <h2>Welcome, {{$profile_details->name}} <img src="{{ url('/img/verified.png') }}" alt=""></h2>
                        <ul class="profile-detail">
                            <li><img src="{{ url('/img/map.png') }}" alt=""><span>{{$profile_details->country}}</span></li>
                            <li><strong>{{ number_format($profile_details->trophies)}}</strong><span>Trophies</span></li>
                            <li><strong>{{$profile_details->ranking}}</strong><span>Ranking</span></li>
                            <li><strong><sup>$</sup>{{number_format($profile_details->price,2)}}</strong><span>Per Hour</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    @endif
@endif