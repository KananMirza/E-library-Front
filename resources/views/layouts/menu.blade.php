<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="menu-title" key="t-apps">Apps</li>

                <li>
                    <a href="{{route('getAllAuthor')}}" class="waves-effect">
                        <i class="fas fa-book-reader"></i>
                        <span key="t-chat">Authors</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('getAllCategory')}}" class="waves-effect">
                        <i class="fas fa-fire-alt"></i>
                        <span key="t-chat">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('getAllPublisher')}}" class="waves-effect">
                        <i class="fas fa-money-bill"></i>
                        <span key="t-chat">Publisher</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('getAllShelf')}}" class="waves-effect">
                        <i class="fas fa-network-wired"></i>
                        <span key="t-chat">Shelves</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('getAllUser')}}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span key="t-chat">Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('getAllLeaseStatus')}}" class="waves-effect">
                        <i class="fas fa-chair"></i>
                        <span key="t-chat">Lease Statuses</span>
                    </a>
                </li>
                <li>
                    <a href="chat.html" class="waves-effect">
                        <i class="fas fa-dollar-sign"></i>
                        <span key="t-chat">Penalty</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('getAllPenaltyType')}}" class="waves-effect">
                        <i class="fas fa-bullhorn"></i>
                        <span key="t-chat">Penalty Types</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('getAllLease')}}" class="waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">Lease</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-book"></i>
                        <span key="t-ecommerce">Books</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('getAllBook')}}" key="t-products">List books</a></li>
                        <li><a href="{{route('createBookPage')}}" key="t-products">Add book</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
