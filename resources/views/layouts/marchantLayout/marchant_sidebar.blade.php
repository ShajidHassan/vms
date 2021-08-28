<!--sidebar-menu-->
<div id="sidebar">
  <a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li>
      <a href="{{\Illuminate\Support\Facades\URL::route("marchant.dashbord")}}">
        <i class="icon icon-home"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <br>
    <li class="submenu">
      <a href="#"><i class="icon icon-th-list"></i>
        <span>Transactions</span>
        <span class="label label-important">2</span>
      </a>
      <ul>
        <li><a href="{{ \Illuminate\Support\Facades\URL::to('/marchant/transactions') }}">List</a></li>
      </ul>
    </li>

    <li class="submenu">
      <a href="#"><i class="icon icon-th-list"></i>
        <span>Account</span>
        <span class="label label-important">2</span>
      </a>
      <ul >
        <li><a href="{{ \Illuminate\Support\Facades\URL::to('/marchant/account') }}">Account</a></li>
        <li><a href="{{ \Illuminate\Support\Facades\URL::to('/marchant/add-account') }}">Add Account</a></li>
      </ul>
    </li>

    <li class="submenu">
      <a href="#"><i class="icon icon-th-list"></i>
        <span>Vehicles</span>
        <span class="label label-important">2</span>
      </a>
      <ul>
        <li><a href="{{ \Illuminate\Support\Facades\URL::to('/marchant/view-vehicles') }}">Vehicles</a></li>
      </ul>
    </li>

    <li class="submenu">
      <a href="#"><i class="icon icon-th-list"></i>
        <span>Purchases</span>
        <span class="label label-important">2</span>
      </a>
      <ul>
        <li><a href="{{ \Illuminate\Support\Facades\URL::to('/marchant/add-vehicle') }}">New Purchases</a></li>
      </ul>
    </li>

  </ul>
</div>
<!--sidebar-menu-->