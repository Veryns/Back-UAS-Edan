<h1>Ubah Post</h1>

<form method="POST" action="{{ route('posts.update', $post) }}">
    @csrf
    @method('PUT')
    Judul:
    <br>
    <input name="title" value="{{ $post->title }}" required>
    <br><br>
    Konten:
    <br>
    <textarea name="content" rows="8" required>{{ $post->content }}</textarea>
    <br><br>
    <button type="submit">Simpan</button>
</form>
<div>
    <h1>Tags</h1><br>
    @foreach ($tags as $tag)
        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
            {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
        {{ $tag->name }}<br>
    @endforeach
</div>