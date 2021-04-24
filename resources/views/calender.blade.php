<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horoscope</title>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form method="post" action="{{route('search')}}">
            @csrf
            <input required min="1000" maxlength="9999" type="number" value="{{old('year',$year)}}" name="year">
            <select name="zodiac_id">
            @foreach($zodiacs as $zodiac)
            <option value="{{$zodiac->id}}">{{$zodiac->name }}</option>
            @endforeach
            </select>
            <button type="submit">Search</button>
        </form>
    </div>
<hr/>

 

<div class="container">

    
    @isset($bestMonth)
        <h1>Results For Year: {{$year}} Sign: {{$zodiacName}} </h1>
        <h1>Best Month for {{$zodiacName}} is {{$bestMonth}} </h1>
    @endisset

    @isset($bestZodiac)
        <h1>Best Year for {{$bestZodiac}} </h1>
    @endisset

    @isset($html)
    {!! $html !!}
    @endisset
</div>

</body>
</html>