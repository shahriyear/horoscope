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
    @error('year')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        <form method="post" action="{{route('search')}}">
            @csrf
            <input type="number" value="{{old('year',$year)}}" name="year">
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
        <p>Year: <strong>{{$year}}</strong> Sign: <strong>{{$zodiacName}}</strong> </p>
        <p>Best Month for <strong>{{$zodiacName}}</strong> is <strong>{{$bestMonth}}</strong> </p>
    @endisset

    @isset($bestZodiac)
        <p>Best Year for <strong>{{$bestZodiac}}</strong> </p>
    @endisset

    
    @isset($html)
    <div class="score-div">
        @foreach(range(1,10) as $score)
        <span class="score-span score-{{$score}}">{{$score}}</span>
        @endforeach
    </div>
    {!! $html !!}
    @endisset
</div>

</body>
</html>