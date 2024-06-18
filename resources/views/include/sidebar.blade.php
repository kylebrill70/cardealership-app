<!-- ======= Mobile nav toggle button ======= -->
<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

<!-- ======= Header ======= -->
<header id="header">
    <div class="d-flex flex-column">
        <div class="profile">
            <img src="{{ asset('img/logo/bg.png') }}" style="width: 180px;height:180px"> 
        </div>
        <!-- .nav-menu -->
        <nav id="navbar" class="nav-menu navbar">
            <ul>
              <ul>
                <li><a href="/userstable"><img src="{{ asset('img/icons/user.png') }}"  style="width: 30px;height:30px;margin-right:10px;"><span>User Accounts</span></a></li>
                <li><a href="/partstable"><img src="{{ asset('img/icons/car-parts.png') }}"style="width: 30px;height:30px;margin-right:10px;"><span>Parts Inventory</span></a></li>
                <li><a href="/carstable"><img src="{{ asset('img/icons/electric-car.png') }}"style="width: 30px;height:30px;margin-right:10px;" ><span>Cars Inventory</span></a></li>
                <li><a href="/sales"><img src="{{ asset('img/icons/increase.png') }}"style="width: 30px;height:30px;margin-right:10px;" ><span>Sales</span></a></li>
                <li><a href="/delusers"><img src="{{ asset('img/icons/recycle-bin.png') }}"style="width: 30px;height:30px;margin-right:10px;" ><span>Deleted Accounts</span></a></li>
                <li><a href="/logout"><img src="{{ asset('img/icons/power-off.png') }}"style="width: 30px;height:30px;margin-right:10px;" ><span>Logout</span></a></li>
            </ul>
            
            </ul>
        </nav>
    </div>
</header>
<!-- End Header -->