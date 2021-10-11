<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>

							<li class="{{ (Route::currentRouteName()=='admin.dashboard')? 'active' : '' }}">
								<a href="{{ route('admin.dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>


							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Blog </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="{{ (Route::currentRouteName()=='post.index')? 'ok' :'' }}"><a href="{{ route('post.index') }}"> Posts </a></li>
									<li class="{{ (Route::currentRouteName()=='post.create')? 'ok' :'' }}"><a href="{{ route('post.create') }}">Add new Post </a></li>
									<li class="{{ (Route::currentRouteName()=='category.index')? 'ok' :'' }}"><a href="{{ route('category.index') }}"> Category </a></li>
									<li class="{{ (Route::currentRouteName()=='tag.index')? 'ok' :'' }}"><a href="{{ route('tag.index') }}"> Tag </a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-warning"></i> <span> Order </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="error-404.html"> Orders </a></li>
									<li><a href="error-500.html"> Reports </a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Product </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href=""> products </a></li>
									<li><a href="{{ route('product-category.index') }}"> Category </a></li>
									<li><a href="{{ route('product-tag.index') }}"> Tag </a></li>
									<li><a href="{{ route('brand.index') }}"> Brand </a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Page </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="login.html"> Login </a></li>
									<li><a href="register.html"> Register </a></li>
									<li><a href="forgot-password.html"> Forgot Password </a></li>
									<li><a href="lock-screen.html"> Lock Screen </a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="fe fe-user"></i> <span> User </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="login.html"> users </a></li>
									<li><a href="register.html"> Role </a></li>
									<li><a href="forgot-password.html"> permission </a></li>
								</ul>
							</li>
                            <li class="">
								<a href="#"><i class="fe fe-vector"></i> <span>Setting</span></a>
							</li>

						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->

