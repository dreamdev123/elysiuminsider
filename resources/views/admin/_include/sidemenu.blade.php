<?php $ACTIVE_TAB = Request::path() ?>
      <!-- Sidebar -->
      <nav id="sidebar">
        <ul class="list-unstyled components">
          <li class="{{ isset($ACTIVE_TAB) && ($ACTIVE_TAB !== 'admin/market/get_risk_value') && ($ACTIVE_TAB !== 'admin/equities/infos') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}" ><i class="fa fa-users mr-2"></i> Member Management</a>
          </li>
          <li class="{{ isset($ACTIVE_TAB) && ($ACTIVE_TAB === 'admin/market/get_risk_value') ? 'active' : '' }}">
            <a href="{{ route('admin.market') }}" ><i class="fa fa-chart-bar mr-2"></i> Market Entry Manage </a>
          </li>
          <!-- <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-gears"></i> New Menu</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
              <li><a href="#"><i class="fa fa-line-chart"></i> Menu 1</a></li>
              <li><a href="#"><i class="fa fa-pie-chart"></i> Menu 2</a></li>
              <li><a href="#"><i class="fa fa-sitemap"></i> Menu 3</a></li>
            </ul>
          </li> -->
        </ul>
      </nav>