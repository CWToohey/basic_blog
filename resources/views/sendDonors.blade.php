<html>
    <body>
    @foreach($donors as $key => $donor)
        {{ $donor['dollarAmt'] }}<br>
        {{ $donor['fullName'] }}<br>
        {{ $donor['email'] }}<br>
        {{ $donor['address'] }}<br>
        {{ $donor['occupation'] }}<br>
        {{ $donor['created_at'] }}<br>
        <br>
    @endforeach
    </body>
</html>
