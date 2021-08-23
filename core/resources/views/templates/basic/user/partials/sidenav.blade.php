
<div class="sidebar capsule--rounded bg_img overlay--dark"
     data-background="{{asset('assets/admin/images/sidebar/2.jpg')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('user.home')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('user.home')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>
        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('user.home')}}">
                    <a href="{{route('user.home')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('user.plan.index')}}">
                    <a href="{{route('user.plan.index')}}" class="nav-link ">
                        <i class="menu-icon las la-lightbulb"></i>
                        <span class="menu-title">@lang('Plan')</span>
                    </a>
                </li>



                <li class="sidebar-menu-item {{ menuActive('user.bv.log') }}">
                    <a href="{{ route('user.bv.log') }}" class="nav-link">
                        <i class="menu-icon las la-sitemap"></i>
                        <span class="menu-title">@lang('BV Log')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.my.ref') }}">
                    <a href="{{ route('user.my.ref') }}" class="nav-link">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('My Referrals')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.my.tree') }}">
                    <a href="{{ route('user.my.tree') }}" class="nav-link">
                        <i class="menu-icon las la-tree"></i>
                        <span class="menu-title">@lang('My Tree')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.binary.summery') }}">
                    <a href="{{ route('user.binary.summery') }}" class="nav-link">
                        <i class=" menu-icon las la-chart-area"></i>
                        <span class="menu-title">@lang('Binary Summery')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.deposit') }}">
                    <a href="{{ route('user.deposit') }}" class="nav-link">
                        <i class=" menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Deposit Now')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.withdraw') }}">
                    <a href="{{ route('user.withdraw') }}" class="nav-link">
                        <i class="menu-icon las la-cloud-download-alt"></i>
                        <span class="menu-title">@lang('Withdraw Now')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.balance.transfer') }}">
                    <a href="{{ route('user.balance.transfer') }}" class="nav-link">
                        <i class="menu-icon las la-hand-holding-usd"></i>
                        <span class="menu-title">@lang('Balance Transfer')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('user.report*',3)}} my-2">
                        <i class="menu-icon las la-exchange-alt"></i>
                        <span class="menu-title">@lang('Reports') / @lang('Logs')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('user.report*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('user.report.transactions')}} ">
                                <a href="{{route('user.report.transactions')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Transactions Log')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('user.report.deposit')}}">
                                <a href="{{route('user.report.deposit')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Deposit Log')</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item {{menuActive('user.report.commission')}}">
                                <a href="{{route('user.report.commission')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Commission Log')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('user.report.withdraw')}}">
                                <a href="{{route('user.report.withdraw')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Withdraw Log')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('user.report.invest')}}">
                                <a href="{{route('user.report.invest')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Invest Log')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('user.report.refCom')}}">
                                <a href="{{route('user.report.refCom')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Referral Commissions')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('user.report.binaryCom')}}">
                                <a href="{{route('user.report.binaryCom')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Binary Commission')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                
                
                
                
                
                
                
                
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="my-2">
                        <i class="menu-icon las la-exchange-alt"></i>
                        <span class="menu-title">@lang('Informations') / @lang('Info')</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li class="sidebar-menu-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#reffer">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Reffer & Binary')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#investment">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Investment Profit')</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#monthly">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Monthly  Leadership')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#rank">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Rank Requirement')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#royalty">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Royalty')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <li class="sidebar-menu-item {{ menuActive('user.twofactor') }}">
                    <a href="{{ route('user.twofactor') }}" class="nav-link">
                        <i class="menu-icon las la-shield-alt"></i>
                        <span class="menu-title">@lang('2FA Security')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('ticket') }}">
                    <a href="{{ route('ticket') }}" class="nav-link">
                        <i class="menu-icon las la-ticket-alt"></i>
                        <span class="menu-title">@lang('Support')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('user.profile-setting') }}">
                    <a href="{{ route('user.profile-setting') }}" class="nav-link">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Profile')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.login.history') }}">
                    <a href="{{ route('user.login.history') }}" class="nav-link">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Login History')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('user.logout') }}" class="nav-link">
                        <i class="menu-icon las la-sign-out-alt"></i>
                        <span class="menu-title">@lang('Logout')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="reffer" tabindex="-1" role="dialog" aria-labelledby="reffer" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reffer & Binary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{asset('assets/images/reffer.jpeg')}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="investment" tabindex="-1" role="dialog" aria-labelledby="investment" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Investment Profit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{asset('assets/images/invesment.jpeg')}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="monthly" tabindex="-1" role="dialog" aria-labelledby="monthly" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Monthly Leadership</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{asset('assets/images/monthly.jpeg')}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rank" tabindex="-1" role="dialog" aria-labelledby="rank" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rank Requirement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{asset('assets/images/rank.jpeg')}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="royalty" tabindex="-1" role="dialog" aria-labelledby="royalty" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Royalty</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{asset('assets/images/royalty.jpeg')}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>