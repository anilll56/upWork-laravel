<?php
?>

<!DOCTYPE html>
<html>
    <head>
    <title><?php echo $title; ?></title>
    </head>
    <body>
        <h1>{{$title}}</h1>
        <p>{{$data}}</p>
     <p>
     {{ $result->name ?? '' }}
     </p>
     <p>
        {{ $result->email ?? '' }}
        </p>
        <p>
            {{ $result['work-type'] ?? '' }}
        </p>
        <p>
            {{ $result['work-description'] ?? '' }}
        </p>
    </body>
</html>
