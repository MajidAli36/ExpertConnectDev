<footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3>Contact us</h3>
                            <p><span>Expert Connect</span><br>
                            The realtime Experience of a Lifetime</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#"><img src="{{ url('/homepage/images/location.png') }}" alt="#">1800 US-206,
                                    Skillman, NJ 08558</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3>Connect with us</h3>
                            <p>&copy; <span class="year">{{date('Y')}}</span> Forge Ahead LLC.  All rights reserved</p>
                            <ul class="list-inline social">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/Expertconnecttennis/"><img src="{{ url('/homepage/images/fb.png') }}"  style="width:32px;" alt="#"></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/_expertconnect"><img src="{{ url('/homepage/images/tw.png') }}"  style="width:32px;" alt="#"></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.instagram.com/expertconnectteam/"><img src="{{ url('/homepage/images/insta.png') }}"  style="width:32px;" alt="#"></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.youtube.com/channel/UCwM4bYcosh-Yp4HZkAAPfXQ"><img src="{{ url('/homepage/images/youtube.png') }}" style="width:32px;" alt="#"></a>
                                </li>
                            </ul>
                        </div>
                        <!--
                        <div class="col-12 col-sm-6">
                            <h3>Leave a message</h3>
                            <form>
                                <input type="text" placeholder="Your name*">
                                <input type="text" placeholder="Email address*">
                                <input type="text" placeholder="Type your message*">
                                <button class="btn_yellow" value="submit" type="submit"><span>SEND</span></button>
                            </form>
                        </div>
                    -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <ul class="list-inline">
                        <hr/>
                        <li class="list-inline-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                         <li class="list-inline-item">
                            <a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ url('experts') }}">Browse Experts</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ url('videolibrary') }}">Video Library</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ url('terms-conditions')}}">Terms & Conditions</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ url('privacy-policy') }}">Privacy Policy</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </footer>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <button type="button" class="close" data-dismiss="modal"><img src="{{ url('/homepage/images/close_icon2.png')}}" alt="#"></button>
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="input_form">
                    <input type="text" placeholder="What are you looking for?">
                    <a href="#"><img src="{{ url('/homepage/images/search_icon.png')}}" alt="#"></a>
                </div>
            </div>
        </div>
    </div>
</div>