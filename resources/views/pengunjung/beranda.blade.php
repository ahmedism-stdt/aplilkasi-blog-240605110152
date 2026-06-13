@extends('layouts.pengunjung')

@section('title', 'Beranda Blog')

@push('styles')
<style>
  .article-card { margin-bottom: 18px; overflow: hidden; }
  .article-grid { display: grid; grid-template-columns: 220px minmax(0, 1fr); min-height: 170px; }
  .article-image { width: 100%; height: 100%; min-height: 170px; object-fit: cover; background: #e5e7eb; }
  .article-body { padding: 20px; }
  .article-title { margin: 0 0 8px; font-size: 21px; color: #111827; line-height: 1.35; }
  .article-excerpt { margin: 0 0 16px; color: #4b5563; }
  .category-list { display: grid; gap: 8px; }
  .category-item { display: flex; justify-content: space-between; gap: 12px; padding: 10px 12px; border-radius: 6px; background: #f9fafb; color: #374151; font-size: 14px; }
  .category-item:hover, .category-item.active { background: #eef2ff; color: #3730a3; font-weight: 700; }
  .count { color: #6b7280; font-weight: 700; }
  @media (max-width: 820px) {
    .article-grid { grid-template-columns: 1fr; }
    .article-image { aspect-ratio: 16 / 9; }
  }
</style>
@endpush

@section('content')
  <section class="hero">
    <div class="hero-inner">
      <h1>Artikel Pilihan Terbaru</h1>
      <p>Baca artikel terbaru dari CMS blog dan temukan tulisan berdasarkan kategori yang tersedia.</p>
    </div>
  </section>

  <main class="page">
    <section>
      <h2 class="section-title">
        {{ $kategoriAktif ? 'Kategori: ' . $kategoriAktif->nama_kategori : 'Artikel Terbaru' }}
      </h2>

      @forelse ($artikel as $item)
        <article class="card article-card">
          <div class="article-grid">
            <img class="article-image" src="{{ asset('cms/uploads_artikel/' . $item->gambar) }}" alt="{{ $item->judul }}">
            <div class="article-body">
              <div class="meta">
                <span class="badge">{{ $item->nama_kategori }}</span>
                <span>{{ $item->nama_penulis }}</span>
                <span>{{ $item->hari_tanggal }}</span>
              </div>
              <h3 class="article-title">{{ $item->judul }}</h3>
              <p class="article-excerpt">{{ Str::limit(strip_tags($item->isi), 220) }}</p>
              <a class="button" href="{{ route('pengunjung.detail', $item->id) }}">Kelanjutannya</a>
            </div>
          </div>
        </article>
      @empty
        <div class="empty">Belum ada artikel yang dapat ditampilkan.</div>
      @endforelse
    </section>

    <aside class="card sidebar-box">
      <h2>Kategori Artikel</h2>
      <div class="category-list">
        <a class="category-item {{ !$kategoriAktif ? 'active' : '' }}" href="{{ route('pengunjung.index') }}">
          <span>Semua Kategori</span>
          <span class="count"></span>
        </a>
        @foreach ($kategoriList as $kategori)
          <a class="category-item {{ $kategoriAktif && $kategoriAktif->id === $kategori->id ? 'active' : '' }}" href="{{ route('pengunjung.kategori', $kategori->id) }}">
            <span>{{ $kategori->nama_kategori }}</span>
            <span class="count">{{ $kategori->jumlah_artikel }}</span>
          </a>
        @endforeach
      </div>
    </aside>
  </main>
@endsection
