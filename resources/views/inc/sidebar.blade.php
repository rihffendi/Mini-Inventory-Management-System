<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
  <div class="main-navbar">
    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
      <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
        <div class="d-table m-auto">
          <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{asset('images/shards-dashboards-logo.svg')}}" alt="Shards Dashboard">
          <span class="d-none d-md-inline ml-1">RIHVENTORY</span>
        </div>
      </a>
      <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
        <i class="material-icons">&#xE5C4;</i>
      </a>
    </nav>
  </div>
  <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
    <div class="input-group input-group-seamless ml-3">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fas fa-search"></i>
        </div>
      </div>
      <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
  </form>
  <div class="nav-wrapper">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="{{route('dashboard.index')}}">
          <i class="material-icons">edit</i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " data-toggle="dropdown" aria-expanded="false" href="#" >
          <i class="material-icons"  aria-hidden="true">person</i>
          <span>People</span>
        </a>
        <ul class="dropdown-menu" role="menu">
          <li class=" nav-item dropdown">
            <a href="{{route('people.suppliers.index')}}" class="nav-link pl-5">
              <i class="material-icons"  aria-hidden="true">person</i>
              <span>Suppliers</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="{{route('people.customers.index')}}" class="nav-link pl-5">
               <i class="material-icons"  aria-hidden="true">person</i>
              <span>Customers</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="{{route('people.employees.index')}}" class="nav-link pl-5">
              <i class="fa fa-male" aria-hidden="true"></i>
              <span>Employees</span>
            </a>
          </li>               
        </ul>
      </li>
         <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " data-toggle="dropdown" aria-expanded="false" href="#" >
          <i class="material-icons"  aria-hidden="true">table_chart</i>
          <span>Category</span>
        </a>
        <ul class="dropdown-menu" role="menu">
          <li class=" nav-item dropdown">
            <a href="{{route('category.categories.index')}}" class="nav-link pl-5">
              <i class="material-icons"  aria-hidden="true">person</i>
              <span>Categories</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="{{route('category.sub-categories.index')}}" class="nav-link pl-5">
               <i class="material-icons"  aria-hidden="true">person</i>
              <span>Sub Catergories</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('products.index')}}">
          <i class="material-icons">vertical_split</i>
          <span>Products</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('purchases.index')}}">
          <i class="material-icons">note_add</i>
          <span>Purchases</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('sales.index')}}">
          <i class="material-icons">table_chart</i>
          <span>Sales</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('stocks.index')}}">
          <i class="material-icons">table_chart</i>
          <span>Stock</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " data-toggle="dropdown" aria-expanded="false" href="#" >
          <i class="material-icons"  aria-hidden="true">table_chart</i>
          <span>Accounts</span>
        </a>
        <ul class="dropdown-menu" role="menu">
          <li class=" nav-item dropdown">
            <a href="{{route('accounts.incomes.index')}}" class="nav-link pl-5">
              <i class="material-icons"  aria-hidden="true">person</i>
              <span>Incomes</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="{{route('accounts.expenses.index')}}" class="nav-link pl-5">
               <i class="material-icons"  aria-hidden="true">person</i>
              <span>Expenses</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " data-toggle="dropdown" aria-expanded="false" href="#" >
          <i class="material-icons"  aria-hidden="true">table_chart</i>
          <span>Reports</span>
        </a>
        <ul class="dropdown-menu" role="menu">
          <li class=" nav-item dropdown">
            <a href="{{route('reports.purchases.index')}}" class="nav-link pl-5">
              <i class="material-icons"  aria-hidden="true">person</i>
              <span>Puchase</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="{{route('reports.sales.index')}}" class="nav-link pl-5">
               <i class="material-icons"  aria-hidden="true">person</i>
              <span>Sale</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="{{route('reports.profitloss.index')}}" class="nav-link pl-5">
               <i class="material-icons"  aria-hidden="true">person</i>
              <span>P & L</span>
            </a>
          </li>
        </ul>
      </li>
     {{--  <li class="nav-item">
        <a class="nav-link " href="#">
          <i class="material-icons">error</i>
          <span>Estimate</span>
        </a>
      </li> --}}
    </ul>
  </div>
</aside>