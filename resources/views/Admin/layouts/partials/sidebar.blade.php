 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset("/admin/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->

    <div class="sidebar" style="direction: ltr">
      <div style="direction: rtl">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{auth()->user()->name}}</a>


          </div>
        </div>
        <?php $user=Auth()->user() ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
              <li class="nav-item">
                  <a href="{{route('profile.index')}}" class="nav-link {{$parent_menu_active=='profile'? ' active':''}}">
                      <i class="nav-icon fa fa-user"></i>
                      <p>
                         پروفایل

                      </p>
                  </a>
              </li>

              @can('isAdmin')
              <li class="nav-item">
                  <a href="{{route('roles.index')}}" class="nav-link {{$parent_menu_active=='roles'? ' active':''}}">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                          نقش ها

                      </p>
                  </a>
              </li>
              @endcan
            @cannot('isUser')
              <li class="nav-item has-treeview menu-open">
{{--                @can('view',$user)--}}
              <a href="#" class="nav-link {{$parent_menu_active=='lessons'? ' active':''}}">
                <i class="nav-icon fa fa-book"></i>
                <p>
                 درس
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('lessons.index')}}" class="nav-link {{$menu_active=='create_lesson'? ' active':''}}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>نمایش دروس</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('lessons.create')}}" class="nav-link {{$menu_active=='create_lesson1'? ' active':''}}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>ایجاد درس</p>
                  </a>
                </li>

              </ul>
            </li>
              @endcan
              @cannot('isUser')
              <li class="nav-item has-treeview menu-open">
                  <a href="#" class="nav-link {{$parent_menu_active=='session'? ' active':''}}">
                      <i class="nav-icon fa fa-book"></i>
                      <p>
                          فصل درسی
                          <i class="right fa fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{route('sessions.index')}}" class="nav-link {{$menu_active=='create_session'? ' active':''}}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>نمایش فصول درسی</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('sessions.create')}}" class="nav-link {{$menu_active=='create_session1'? ' active':''}}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>ایجاد فصل درسی</p>
                          </a>
                      </li>

                  </ul>
              </li>
              @endcan
              @cannot('isUser')
              <li class="nav-item has-treeview menu-open">
                  <a href="#" class="nav-link {{$parent_menu_active=='exam_info'? ' active':''}}">
                      <i class="nav-icon fa fa-question"></i>
                      <p>
                            آزمون
                          <i class="right fa fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{route('exam_infos.index')}}" class="nav-link {{$menu_active=='exam_info'? ' active':''}}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>نمایش آزمون</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('exam_infos.create')}}" class="nav-link {{$menu_active=='exam_info1'? ' active':''}}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>ایجادآزمون</p>
                          </a>
                      </li>

                  </ul>
              </li>
              @endcan
              @cannot('isUser')
              <li class="nav-item">
                  <a href="{{route('workbooks.index')}}" class="nav-link {{$parent_menu_active=='workbook'? ' active':''}}">
                      <i class="fa fa-address-book"></i>
                      <p>
                         کارنامه داوطلب

                      </p>
                  </a>
              </li>
              @endcan
              @cannot('isUser')
            <li class="nav-item">
              <a href="{{route('response_forums.index')}}" class="nav-link {{$parent_menu_active=='forum'? ' active':''}}">
                <i class="nav-icon fa fa-th"></i>
                <p>
                    تالار گفتمان

                </p>
              </a>
            </li>
              @endcan

          </ul>
        </nav>

        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>
