<ul>
    <li>
        <a href="{{ route('admin.list-links') }}">List Urls</a>
    </li>
    <li>
        <a href="{{ route('admin.search-links') }}">Search Urls</a>
    </li>
    <li>
        <a href="{{ route('home') }}">Website</a>
    </li>
    <li>
        <a href="#" onclick="event.preventDefault();
        document.getElementById('logoutForm').submit();">Logout</a>
    </li>


    <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logoutForm">
        @csrf
    </form>
</ul>