<?php $url = url()->current(); ?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li><a href="{{\Illuminate\Support\Facades\URL::route("admin.dashbord")}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <br><br>
{{--    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>--}}
{{--      <ul <?php if (preg_match("/categor/i",  $url)){ ?> style="display: block;" <?php } ?>>--}}
{{--        <li <?php if (preg_match("/add-category/i",  $url)){ ?> class ="active" <?php } ?>><a href="{{ URL::to('/backend/add-category') }}">Add Category</a></li>--}}
{{--        <li <?php if (preg_match("/view-categories/i",  $url)){ ?> class ="active" <?php } ?>><a href="{{ URL::to('/backend/view-categories') }}">View Categories</a></li>--}}
{{--      </ul>--}}
{{--    </li>--}}

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
      <ul >
        <li><a href="{{ \Illuminate\Support\Facades\URL::route("admin.categories") }}">Categories</a></li>
        <li><a href="{{ \Illuminate\Support\Facades\URL::route("admin.add_category") }}">New Category</a></li>
      </ul>
    </li>


    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admin</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ \Illuminate\Support\Facades\URL::route("admin.admins")}}">Admins</a></li>
{{--        <li><a href="{{ \Illuminate\Support\Facades\URL::route("admin.add_admin")}}">New Admin</a></li>--}}
      </ul>
    </li> 


{{--    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Profit Section</span> <span class="label label-important">1</span></a>--}}
{{--      <ul>--}}
{{--        <li><a href="{{ URL::to('/backend/profit') }}">Profit</a></li>--}}
{{--      </ul>--}}
{{--    </li> --}}


    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Transactions</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ \Illuminate\Support\Facades\URL::route("admin.transactions") }}">List</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Account</span> <span class="label label-important">2</span></a>
      <ul >
        <li><a href="{{ \Illuminate\Support\Facades\URL::route("admin.account") }}">Account</a></li>
        <li><a href="{{ \Illuminate\Support\Facades\URL::route("admin.add_account") }}">Add Account</a></li>
      </ul>
    </li>

{{--    @if(Session::get('name')!='Super Admin')--}}
{{--      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Profit Section</span> <span class="label label-important">1</span></a>--}}
{{--        <ul <?php if (preg_match("/vehicl/i",  $url)){ ?> style="display: block;" <?php } ?>>--}}
{{--          <li<?php if (preg_match("/profit/i",  $url)){ ?> class ="active" <?php } ?>><a href="{{ URL::to('/backend/profit') }}">Profit</a></li>--}}
{{--        </ul>--}}
{{--      </li>--}}
{{--  @endif--}}
    <!--<li> <a href="charts.html"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>
    <li> <a href="widgets.html"><i class="icon icon-inbox"></i> <span>Widgets</span></a> </li>
    <li><a href="tables.html"><i class="icon icon-th"></i> <span>Tables</span></a></li>
    <li><a href="grid.html"><i class="icon icon-fullscreen"></i> <span>Full width</span></a></li>
    
    <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
    <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">5</span></a>
      <ul>
        <li><a href="index2.html">Dashboard2</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="calendar.html">Calendar</a></li>
        <li><a href="invoice.html">Invoice</a></li>
        <li><a href="chat.html">Chat option</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Error</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="error403.html">Error 403</a></li>
        <li><a href="error404.html">Error 404</a></li>
        <li><a href="error405.html">Error 405</a></li>
        <li><a href="error500.html">Error 500</a></li>
      </ul>
    </li>
    <li class="content"> <span>Monthly Bandwidth Transfer</span>
      <div class="progress progress-mini progress-danger active progress-striped">
        <div style="width: 77%;" class="bar"></div>
      </div>
      <span class="percent">77%</span>
      <div class="stat">21419.94 / 14000 MB</div>
    </li>
    <li class="content"> <span>Disk Space Usage</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: 87%;" class="bar"></div>
      </div>
      <span class="percent">87%</span>
      <div class="stat">604.44 / 4000 MB</div>
    </li>-->
  </ul>
</div>
<!--sidebar-menu-->