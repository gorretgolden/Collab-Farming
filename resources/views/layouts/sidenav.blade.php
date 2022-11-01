<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading d-flex justify-content-center">
        <a href="" class="d-contents">
            <img src="{{asset("images/logo_white.png")}}" >
        </a>
    </div>
    <div class="list-group list-group-flush mt-2">

        <a href="" class="list-group-item list-group-item-action @if(URL::current() == '/' || str_contains(URL::current(), 'cooperatives/cooperative-member-create')  ) active @endif">

            <div class="row">
                <div class="col-sm-1">
                    <i class="fas fa-home"></i>
                </div>
                <div class="col-sm-9">
                    <span>Home</span>
                </div>
            </div>
        </a>
        
        <a href="" class="list-group-item list-group-item-action @if(str_contains(URL::current(), 'cooperatives') && !str_contains(URL::current(), '/cooperatives/categories')) active @endif">
            <div class="row">
                <div class="col-sm-1">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="col-sm-9">
                    <span>Cooperatives</span>
                </div>
            </div>
        </a>
        <a href="" class="list-group-item list-group-item-action @if(str_contains(URL::current(), 'members') || str_contains(URL::current(), 'cooperative-group-create')) active @endif">
            <div class="row">
                <div class="col-sm-1">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="col-sm-9">
                    <span>Members</span>
                </div>
            </div>
        </a>
        <a href="" class="list-group-item list-group-item-action @if(str_contains(URL::current(), 'partner')) active @endif">
            <div class="row">
                <div class="col-sm-1">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="col-sm-9">
                    <span>Partners</span>
                </div>
            </div>
        </a>
        <a href="" class="list-group-item list-group-item-action @if(str_contains(URL::current(), '/admin/analytics')) active @endif">
            <div class="row">
                <div class="col-sm-1">
                    <i class="far fa-life-ring"></i>
                </div>
                <div class="col-sm-9">
                    <span>Analytics</span>
                </div>
            </div>
        </a>
        <a href="" class="list-group-item list-group-item-action @if(str_contains(URL::current(), 'admin/settings') || str_contains(URL::current(), '/cooperatives/categories') ) active @endif">
            <div class="row">
                <div class="col-sm-1">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="col-sm-8">
                    <span>Settings</span>
                </div>
            </div>
        </a>

    </div>
</div>