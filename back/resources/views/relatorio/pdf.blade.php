<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        .roman {
            margin-left: 5%;
        }
    </style>
</head>
<body>
    <h2>
        Lista de Tags
    </h2>

    <ol>
        @foreach ($tags as $tag)
            <li>{{ $tag['name'] }}
                @foreach ($tag['product'] as $key => $product)

                <li class="roman">{{ $product[0]->name }}</li>
                @endforeach
            </li>
        @endforeach

    </ol>
</body>
</html>