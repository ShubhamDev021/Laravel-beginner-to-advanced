<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Posts</title>
    {{-- bootstrap CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <div class="row">
        <div class="col-md-6 offset-3" style="margin-block-start: 40px;">
            <h1 class="text-center">Edit Post</h1>

            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form method="POST" action="{{ route('posts.update', $post->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $post->id) }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" required>{{ old('description', $post->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">Active</label>
                    <select class="form-control" name="is_active" id="is_active" required>
                        <option value="" selected disabled>----Choose option----</option>
                        <option @selected(old('is_active', $post->is_active) == '1') value="1">Yes</option>
                        <option @selected(old('is_active', $post->is_active) == '0') value="0">No</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="is_published" class="form-label">Published</label>
                    <select class="form-control" name="is_published" id="is_published" required>
                        <option value="" selected disabled>----Choose option----</option>
                        <option @selected(old('is_published', $post->is_published) == '1') value="1">Yes</option>
                        <option @selected(old('is_published', $post->is_published) == '0') value="0">No</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ url()->previous() }}" class="btn btn-danger text-light">Cancel</a>
            </form>
        </div>
    </div>
    
    {{-- bootstrap JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>