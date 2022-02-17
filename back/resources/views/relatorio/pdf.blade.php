<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório de Tags</title>
    <style>
        .roman{
            color:red;
        }
    </style>
</head>
<body>
    <h2>
        Lista de Tags e seus produtos
    </h2>

    <ol>
        @foreach ($tags as $tag)
            <li>{{ $tag['name'] }}
                @foreach ($tag['product'] as $key => $product)
                    <dl class="roman">{{ $product[0]->name }}</dl>
                @endforeach
            </li>
        @endforeach

    </ol>
</body>
</html>