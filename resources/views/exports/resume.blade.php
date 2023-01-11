<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $user->name }} • Resume</title>

    <style>
        body {
            font-family: sans-serif;
        }
    </style>
</head>

<body>

    <div style="display: inline-flex;background-color:#bde0fe93;width:100%;padding:2rem;border-radius:1rem">
        @if ($user->photo)
            <img style="border-radius: 50%;width:6rem;height:6rem;display:inline" src="storage/{{ $user->photo }}"
                alt="">
        @endif

        <div style="display: inline-flex;margin-left:2rem">
            <div style="font-size: 2rem;font-weight:550">{{ $user->name }}</div>
            <div>{{ $user->profile->job }}. ({{ $user->profile->experience_years }} expe)</div>
        </div>
    </div>

    <div>
        <div style="padding:1rem;font-size: 1.2rem;border-bottom:1px solid #bde0fe">
            Profile
        </div>
        <div style="padding-left: 2rem;padding-top:1rem">
            <div>
                <span style="font-size: 12px;color:gray">location:</span>
                <span style="font-size:14px">{{ $user->profile->country }},{{ $user->profile->city }}</span>
            </div>
            <div>
                <span style="font-size: 12px;color:gray">email:</span>
                <span style="font-size:14px">{{ $user->email }}</span>
            </div>

            @if ($user->phone)
                <div>
                    <span style="font-size: 12px;color:gray">phone:</span>
                    <span>12563256478</span>
                </div>
            @endif
        </div>
    </div>

    @if ($user->profile->bio)
        <div>
            <div style="padding:1rem;font-size: 1.2rem;border-bottom:1px solid #bde0fe">
                Bio
            </div>
            <p style="font-size:14px;padding:1rem">{{ $user->profile->bio }} </p>
        </div>
    @endif

    <div>
        <div style="padding:1rem;font-size: 1.2rem;border-bottom:1px solid #bde0fe">
            Education
        </div>
        <div style="padding: 1rem">
            <div style="font-size: 20px">{{ $user->profile->degree }}</div>
            <div style="font-size: 14px;color:gray">{{ $user->profile->school }} •
                <span>{{ $user->profile->degree_year }}</span>
            </div>
        </div>
    </div>

    <div>
        <div style="padding:1rem;font-size: 1.2rem;border-bottom:1px solid #bde0fe">
            Skills
        </div>
        <div style="padding: 1rem">
            @foreach ($user->skills as $skill)
                <div
                    style="display:inline-block;margin:5px;background-color: rgba(189, 189, 189, 0.356);border-radius:.5rem;padding-left:10pxpx;padding-right:10px;padding:5px;letter-spacing:1px">
                    {{ $skill->name }}
                </div>
            @endforeach
        </div>
    </div>


</body>

</html>
