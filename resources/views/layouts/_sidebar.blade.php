<aside id="sidebar-wrapper">
	<div class="sidebar-brand">
		{{-- <a href="{{ route('dashboard') }}">CODING SELECTION TEST</a> --}}
		<a href="#">CODING SELECTION TEST</a>
	</div>
	<div class="sidebar-brand sidebar-brand-sm">
		{{-- <a href="{{ route('dashboard') }}">RT</a> --}}
		<a href="#">RT</a>
	</div>
	<ul class="sidebar-menu">
		{{-- <li class="menu-header">List Menu</li> --}}
		{{-- <li class="{{ Request::is('todo*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('todo.index') }}"><i class="fas fa-tachometer-alt"></i> <span>Todo</span></a></li>
		<li class="{{ Request::is('item*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('item.index') }}"><i class="fas fa-layer-group"></i> <span>Item</span></a></li> --}}
		{{-- <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li> --}}

		<li class="menu-header">Master</li>
		<li class="{{ Request::is('*master-quiz*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.master.index') }}"><i class="fas fa-book"></i> <span>Master Quiz</span></a></li>
		<li class="{{ Request::is('*leaderboard*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.leaderboard.index') }}"><i class="fas fa-clipboard-list"></i> <span>Leaderboard</span></a></li>
		
		{{-- <li class="menu-header">Master Data</li>
		<li class="{{ Request::is('item-category*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('item-category.index') }}"><i class="fas fa-layer-group"></i> <span>Kategori Barang</span></a></li>
		<li class="{{ Request::is('item') || Request::is('item/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('item.index') }}"><i class="fas fa-tachometer-alt"></i> <span>Barang</span></a></li>

		<li class="menu-header">Transaction</li>
		<li class="{{ Request::is('sales/item') || Request::is('sales/item/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sales.item.index') }}"><i class="fas fa-cash-register"></i> <span>Item Sales</span></a></li>
		<li class="{{ Request::is('sales/item/laporan-penjualan') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sales.item.laporan-penjualan') }}"><i class="fas fa-chart-line"></i> <span>Laporan Penjualan</span></a></li> --}}
		

		{{-- <li class="menu-header">Soal 2</li>
		<li class="{{ Request::is('soal-2-process') ? 'active' : '' }}"><a class="nav-link" href="{{ route('soal2-process') }}"><i class="fas fa-hourglass-start"></i> <span>Perhitungan Huruf</span></a></li> --}}
	</ul>
</aside>
