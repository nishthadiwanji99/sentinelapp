Total Earnings 99999

<form action="/logout" method="POST" id="logout-form">
    {{csrf_field()}}
    <a href="#" onclick="document.getElementById('logout-form').submit()">Logout</a>
</form>