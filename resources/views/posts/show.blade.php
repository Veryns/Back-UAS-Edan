<h1>{{ $post->title }}</h1>

<p>{{ $post->content }}</p>

<div>
    <h2>Tags:</h2>
    @forelse ($post->tags as $tag)
            {{ $tag->name }}
    @empty
        <h2>Tidak ada tag</h2>
    @endforelse
</div>

<a href="{{ route('posts.index') }}">Kembali</a>

<form action="{{ route('comments.store') }}" method="post"> 
    @csrf 
    <input type="hidden" name="post_id" value="{{ $post->id }}"> 
    <label for="content">Tulis komentar anda:</label> 
    <br> 
    <textarea name="content" required></textarea> 
    <br> 
    <button type="submit">Kirim</button> 
</form> 
 
<strong>Comments:</strong> 
<ul> 
@foreach ($post->comments as $comment) 
    <li><em>{{ $comment->content }}</em></li> 
@endforeach 
</ul> 