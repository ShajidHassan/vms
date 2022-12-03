<br>
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle" style="font-size: 16px; color: black; background: #FF0000 ;"><i class="icon icon-user"></i>  <strong><span class="text" >{{ Session::get('admin_name') }}</</span> </strong><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a onclick="window.confirm('Are You Sure ?') && document.getElementById('logout').submit(); return false;" class="" style="font-size: 16px; color: red; background: black;" href="#"><i class="icon-key"></i> Sign Out</a></li>
      </ul>
    </li>
    
    
    <!-- <li class=""><a title="" href="#"><i class="icon icon-share-alt"></i>
     <span class="text" href="#" data-toggle="modal" data-target="#logoutModal">Signout</span></a></li> -->
     <li class="" align="right" style="font-size: 15px; color: #CACFD2; background: #000080;"><a title="" href="{{ url('/')}}" target="_blank"><i class="icon icon-home"></i>
     <span class="text" style="font-size: 16px; color: white; background: #000080;" href="{{ url('/')}}" target="_blank"><strong>Home Page </strong></span></a></li>
  </ul>
    <form id="logout" method="post" action="{{ \Illuminate\Support\Facades\URL::route('admin.signout') }}">
        {{csrf_field()}}
    </form>
</div>


    
    