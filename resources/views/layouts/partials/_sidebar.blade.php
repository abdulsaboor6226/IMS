<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Vendor</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}"> Listing </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="brand">
                <i class="fa fa-certificate menu-icon"></i>
                <span class="menu-title">Brand</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="brand">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('brand.index')}}"> Listing </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product-type" aria-expanded="false" aria-controls="product-type">
                <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
                <span class="menu-title">Product Type</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product-type">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('product-type.index')}}"> Listing </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
                <i class="mdi mdi-reproduction menu-icon"></i>
                <span class="menu-title">Product</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('product.index')}}"> Listing </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#stock-out" aria-expanded="false" aria-controls="stock-out">
                <i class="mdi mdi-logout-variant menu-icon"></i>
                <span class="menu-title">Stock Out</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="stock-out">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('stock-out.index')}}"> Listing </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#branch" aria-expanded="false" aria-controls="branch">
                <i class="mdi mdi-source-branch menu-icon"></i>
                <span class="menu-title">Branch</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="branch">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('branch.index')}}"> Listing </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
