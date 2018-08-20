<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="/home">Ankit's Sweet Stall</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="/home">Home</a></li>
        <li class="{{ Request::is('products') ? 'active' : '' }}"><a href="/products">Products</a></li>
        <li class="{{ Request::is('sales') ? 'active' : '' }}"><a href="/sales">Sales</a></li>
        <li class="{{ Request::is('employees') ? 'active' : '' }}"><a href="/employees">Employees</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="/profile"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a></li>
        <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>