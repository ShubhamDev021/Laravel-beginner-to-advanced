<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>

    {{-- bootstrap CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- fontawesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="row">
        <div class="col-md-6 offset-3" style="margin-block-start: 40px;">
            <h1 class="text-center">View Post</h1>

            @if ($post)
                <div style="margin-block-start: 30px;">
                    <div class="row">
                        <div class="col-md-4"><strong>Title: </strong></div>
                        <div class="col-md-8">{{ $post->title }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Description: </strong></div>
                        <div class="col-md-8">{{ $post->description }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Active: </strong></div>
                        <div class="col-md-8">@if ($post->is_active) Yes @else No @endif</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Published: </strong></div>
                        <div class="col-md-8">@if ($post->is_active) Yes @else No @endif</div>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary text-light"><< Go Back</a>
                </div>
            @else
                <h3 class="text-center text-danger">No post found!!!</h3>
            @endif
        </div>
    </div>

    {{-- bootstrap JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>