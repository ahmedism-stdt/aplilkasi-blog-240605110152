@extends('layouts.pengunjung')

@section('title', $artikel->judul)

@push('styles')
<style>
  .article { overflow: hidden; }
  .cover { width: 100%; aspect-ratio: 16 / 7; object-fit: cover; background: #e5e7eb; display: block; }
  .article-content { padding: 28px; }
  .article-title { margin: 0 0 14px; font-size: 34px; line-height: 1.2; letter-spacing: 0; color: #111827; }
  .body-text { color: #374151; font-size: 16px; white-space: pre-line; }
  .back { margin-top: 24px; }
  .related-list { display: grid; gap: 12px; }
  .related-item { display: grid; grid-template-columns: 76px minmax(0, 1fr); gap: 12px; padding-bottom: 12px; border-bottom: 1px solid #eef2f7; }
  .related-item:last-child { border-bottom: 0; padding-bottom: 0; }
  .related-item img { width: 76px; height: 60px; object-fit: cover; border-radius: 6px; background: #e5e7eb; }
  .related-title { display: block; font-weight: 800; font-size: 14px; line-height: 1.35; color: #111827; }
  .related-date { display: block; margin-top: 4px; font-size: 12px; color: #6b7280; line-height: 1.4; }
  .empty-related { color: #64748b; font-size: 14px; margin: 0; }
  @media (max-width: 820px) {
    .article-title { font-size: 27px; }
    .article-content { padding: 22px; }
  }
</style>
@endpush

@section('content')
  <main class="page">
    <article class="card article">
      <img class="cover" src="{{ asset('cms/uploads_artikel/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}">
      <div class="article-content">
        <div class="meta">
          <span class="badge">{{ $artikel->nama_kategori }}</span>
          <span>{{ $artikel->nama_penulis }}</span>
          <span>{{ $artikel->hari_tanggal }}</span>
        </div>
        <h1 class="article-title">{{ $artikel->judul }}</h1>
        <div class="body-text">{{ $artikel->isi }}</div>
        <a class="button back" href="{{ route('pengunjung.index') }}">Kembali ke Beranda</a>
      </div>
    </article>

    <aside class="card sidebar-box">
      <h2>Artikel Terkait</h2>
      @if ($artikelTerkait->isEmpty())
        <p class="empty-related">Belum ada artikel terkait dari kategori yang sama.</p>
      @else
        <div class="related-list">
          @foreach ($artikelTerkait as $item)
            <a class="related-item" href="{{ route('pengunjung.detail', $item->id) }}">
              <img src="{{ asset('cms/uploads_artikel/' . $item->gambar) }}" alt="{{ $item->judul }}">
              <span>
                <span class="related-title">{{ $item->judul }}</span>
                <span class="related-date">{{ $item->hari_tanggal }}</span>
              </span>
            </a>
          @endforeach
        </div>
      @endif
    </aside>
  </main>
@endsection
