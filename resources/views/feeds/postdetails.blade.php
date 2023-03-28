
    <div class="main-container">
        <header class="header">
            <img class="header-img" src="./image/logo.png">
            <ul class="manu">
                <li>Login</li>
                <li>About Us</li>
                <li>Contact</li>
            </ul>
        </header>

        <div class="banner-box">
            <h1 class="heading">Welcome Monika!</h1>


            <div class="monika">
                <div class="feeds">
                    <h3 class="title">Your Feeds</h3>
                    <a href="#" class="botton"> + Add Post</a>
                </div>
                <div class="feeds-box">
                    {{-- @php
                   print_r($singaldetails);
                   die;
                   @endphp --}}
                    <div class="feeds">
                        <h4>{{$singaldetails->email}}</h4>
                        <p>6 hours ago</p>
                    </div>
                    <h3 class="sub-heading">{{$singaldetails->title}}</h3>
                    <p class="text">{{$singaldetails->description}}</p>

                    <p class="read-more">Read more
                    <img class="img" src="{{ asset('feedsimage/'.$singaldetails->file) }}">

                    <div class="container-fluid p-0">
                        <div class="row pt-2">
                            <div class="col-md-3">
                                <div class="like-box">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    <p><b>568</b> Likes</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="like-box">
                                    <i class="fa fa-commenting" aria-hidden="true"></i>
                                    <p><b>347</b> Comments</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="like-box">
                                    <i class="fa fa-share" aria-hidden="true"></i>
                                    <p><b>251</b> Share</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="robert">
                        <div class="feeds">
                            <h4>@Robert Scoble</h4>
                            <p>6 hours ago</p>
                        </div>

                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.</p>

                        <p class="read-more" style="text-align: start;">2+ comments</p>
                        <div class="input-box">
                            <input type="text" placeholder="Add comment">
                            <i class="fa fa-play play" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                    
        <footer class="footer-box">
            <div class="footer">
                <h3>Quick Links</h3>
                <p>Login</p>
                <p>About Us</p>
                <p>Contact</p>
            </div>

            <div class="footer-center">
                <img class="footer-img" src="./image/logo.png">
                <div class="footer-icon">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                </div>
            </div>

            <div class="footer">
                <h3>Contact</h3>
                <div class="footer-right">
                    <i class="fa fa-envelope-o icon" aria-hidden="true"></i>
                    <p>info@xoli.com</p>
                </div>
                <div class="footer-right">
                    <i class="fa fa-volume-control-phone icon" aria-hidden="true"></i>
                    <p>+11-25895886</p>
                </div>
                <div class="footer-right">
                    <i class="fa fa-map-marker icon" aria-hidden="true"></i>
                    <p>Lorem ipsum dolor sit amet</p>
                </div>
            </div>
        </footer>
    </div>
