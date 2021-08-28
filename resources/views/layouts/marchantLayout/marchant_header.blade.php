<br>
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle" style="font-size: 16px; color: black; background: #FF0000 ;"><i class="icon icon-user"></i>  <strong><span class="text" >{{ \Illuminate\Support\Facades\Session::get('user_name') }}</</span> </strong><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
            <a onclick="window.confirm('Are You Sure ?') && document.getElementById('logout').submit(); return false;" style="font-size:16px;color:red;background: black">
                <i class="icon-key"></i> Sign Out
            </a>
        </li>
      </ul>
    </li>
     <li class="" style="font-size: 15px; color: #CACFD2; background: #000080;">
         <a title="" href="{{ url('/')}}" target="_blank">
             <i class="icon icon-home"></i>
             <span class="text" style="font-size: 16px; color: white; background: #000080;">
                 <strong>Home Page </strong>
             </span>
         </a>
     </li>
  </ul>
    <form id="logout" method="post" action="{{ \Illuminate\Support\Facades\URL::route('marcahant.signout') }}">
        {{csrf_field()}}
    </form>
</div>
{{--<div class="modal fade" id="logout_Modal" role="dialog">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">--}}
{{--                    <strong><i>Ready to Leave?</i></strong></h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}

{{--            <div class="modal-body">--}}
{{--                <strong><i>Click Signout below if you are ready to end your current session.</i></strong>--}}
{{--            </div>--}}

{{--            <div class="modal-footer">--}}
{{--                <button class="btn btn-secondary" type="button" data-dismiss="modal"><strong>Cancel</strong></button>--}}
{{--                <a onclick="document.getElementById('logout').submit(); return true;" class="btn btn-primary"><strong>Signout</strong></a>--}}
{{--                <form id="logout" method="post" action="{{ \Illuminate\Support\Facades\URL::route('marcahant.signout') }}">--}}
{{--                    {{csrf_field()}}--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}



    
    