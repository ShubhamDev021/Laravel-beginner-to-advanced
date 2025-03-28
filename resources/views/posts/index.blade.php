<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>

    {{-- bootstrap CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #outer{
            text-align: center;
        }
        .inner{
            display: inline-block;
        }
    </style>

    {{-- fontawesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- toastr CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
</head>
<body>
    <div class="row">
        <div class="col-md-6 offset-3" style="margin-block-start: 40px;">
            <h1 class="text-center">Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary" style="float: right; margin-bottom: 10px;">Create Post</a>
            @if (count($posts))

                {{-- showing message using bootstrap --}}
                {{-- @if(Session::has('alert-success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session::get('alert-success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Active</th>
                            <th scope="col">Published</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->description }}</td>
                                <td>@if($post->is_active) Yes @else No @endif</td>
                                <td>@if($post->is_published) Yes @else No @endif</td>
                                <td id="outer">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success inner"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info inner"><i class="fa-solid fa-edit"></i></a>
                                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="inner">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    @if ($post->trashed())
                                    <a href="{{ route('posts.undo-soft-delete', $post->id) }}" class="btn btn-warning inner"><i class="fa-solid fa-undo"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $posts->render() }}
            @else
                <h3 class="text-center text-danger">No post found!!!</h3>
            @endif            
        </div>
    </div>

    {{-- bootstrap JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- toastr Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- toastr JS --}}
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {{-- toastr options --}}
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

    {{-- showing message using Toastr Jquery --}}
    <script>
        @if(Session::has('alert-success'))
            toastr["success"]("{{ session::get('alert-success') }}");
        @endif
    </script>
</body>
</html>