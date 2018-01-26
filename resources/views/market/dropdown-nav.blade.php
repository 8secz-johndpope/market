
<ul class="nav navbar-nav navbar-right">
    <li><a href="#">Help</a></li>
    <li><a href="#">Store</a></li>
    @if (Auth::guest())
        <li><a href="/login">Login</a></li>
        <li><a href="/register">Sign Up</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                Hello, {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu options-user" role="menu">
                <div class="list-menu-common">
                    <div class="title-list">
                        <span class="nav-link nav-color">Your account</span>
                    </div>
                    <ul>
                        <li><a class="nav-link nav-color" href="/user/manage/ads"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Manage My Ads</a> </li>
                        <li><a class="nav-link nav-color" href="/user/ad/create"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Post an Ad</a> </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Orders</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;My Details</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/favorites"><span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;Favorites</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Search Alerts</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/business/manage/support"><span class="fa fa-envelope"></span> &nbsp;&nbsp; Support</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                               <span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp; Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="list-menu-common">
                    <div class="title-list">
                        <span class="nav-link nav-color">Jobs/Profile</span>
                        <ul>
                            <li>
                                <a class="nav-link nav-color" href="/job/profile/edit"><span class="glyphicon glyphicon-open-file"></span>&nbsp;&nbsp;Private Profile</a>
                            </li>
                            <li>
                                <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-open-file"></span>&nbsp;&nbsp;Public Profile</a>
                            </li>
                            <li>
                                <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-open-file"></span>&nbsp;&nbsp;Candidate Portal</a>
                            </li>
                            <li>
                                <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-open-file"></span>&nbsp;&nbsp;Recommended Jobs</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="list-menu-common">
                    <div class="title-list">
                        <span class="nav-link nav-color">Invoices</span>
                    </div>
                    <ul>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/contacts"><span class="glyphicon glyphicon-open-file"></span>&nbsp;&nbsp;Send Invoice</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/invoices"><span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;Unpaid Invoice</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/invoices"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Paid Invoice</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/invoices"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Pending Invoices</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="fa fa-cloud-download"></span>&nbsp;&nbsp;Download Invoice CSV/Excel</a>
                        </li>
                    </ul>
                </div>
                @if(Auth::user()->contract!==null)
                <div class="list-menu-common">
                    <div class="title-list">
                        <span>Your business</span>
                    </div>
                    <ul>
                        <li>
                            <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Company</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp;Financials</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp;Metrics</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/applications"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;&nbsp;Recruitment Portal</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/motors"><span class="fa fa-car"></span> &nbsp;&nbsp;Motors Portal</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="fa fa-building"></span> &nbsp;&nbsp;Properties Portal</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-tag"></span> &nbsp;&nbsp;For Sales Portal</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-tag"></span> &nbsp;&nbsp;Services Portal</a>
                        </li>
                    </ul>
                </div>
                @endif
                <div class="list-menu-common">
                    <div class="title-list">
                        <span class="nav-link nav-color">sWallet</span>
                    </div>
                    <ul>
                        <li>
                            <a class="nav-link nav-color" href="#">Balance</a>
                        </li>
                    </ul>
                </div>
                <div class="list-menu-common">
                    <div class="title-list">
                        <span class="nav-link nav-color">Chat Centre</span>
                    </div>
                    <ul>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/messages"><span class="fa fa-commenting"></span> &nbsp;&nbsp;Messages</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/manage/contacts"><span class="fa fa-address-book"></span> &nbsp;&nbsp;Contacts</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="/user/groups/create"><span class="fa fa-users"></span> &nbsp;&nbsp;New Group</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="fa fa-reply-all"></span> &nbsp;&nbsp;New Broadcast</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="fa fa-comments-o"></span> &nbsp;&nbsp;New Conversation</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="fa fa-money"></span> &nbsp;&nbsp;Share your Balance</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="fa fa-paperclip"></span> &nbsp;&nbsp;Attachment</a>
                        </li>
                        <li>
                            <a class="nav-link nav-color" href="#"><span class="fa fa-cog"></span> &nbsp;&nbsp;Settings</a>
                        </li>
                         <li>
                            <a class="nav-link nav-color" href="#"><span class="fa fa-user-circle"></span> &nbsp;&nbsp;Profile</a>
                        </li>
                    </ul>
                </div>
                <div class="list-menu-common">
                    <div class="title-list">
                        <span class="nav-link nav-color">Our Offers</span>
                    </div>
                    <ul>
                        <li>
                            <span class="nav-link nav-offer">We do not have offers at the moment</span>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

    @endif
    @if (!Auth::guest())
        <li class="dropdown messages-nav"><a href="/user/manage/messages"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span > <span  class="glyphicon glyphicon-envelope"></span>    <span class="button__badge" style="display: none" id="message-notification">1</span></span><span class="caret"></span></a>
            <ul class="dropdown-menu all-menu-messages list-group" role="menu">
                @foreach(Auth::user()->rooms as $room)
                    <li class="list-group-item">
                        @if($room->last_message())
                        <a href="/user/manage/messages/{{$room->id}}">
                            <div class="message-inside">
                                <span class="message-username">{{$room->last_message()->user->name}}</span>
                                <span class="title-advert">{{$room->title}}</span>
                                <p class="@if($room->unread===1) unread-message @endif">{{$room->last_message()->message}}</p>
                                
                            </div>
                        </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
    @endif
    <li>
        <a class="post-advert" href="/user/ad/create">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Post an Ad
        </a>
    </li>
</ul>
        