<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Blog Publik')</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    body { margin: 0; font-family: "Segoe UI", Arial, sans-serif; background: #f4f6f8; color: #1f2937; line-height: 1.65; }
    a { color: inherit; text-decoration: none; }
    .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; position: sticky; top: 0; z-index: 10; }
    .topbar-inner { max-width: 1120px; margin: 0 auto; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; gap: 16px; }
    .brand { font-size: 20px; font-weight: 800; color: #312e81; }
    .nav-actions { display: flex; gap: 10px; flex-wrap: wrap; justify-content: flex-end; }
    .nav-link { border: 1px solid #c7d2fe; color: #4338ca; padding: 8px 13px; border-radius: 6px; font-size: 13px; font-weight: 700; background: #eef2ff; }
    .hero { background: #111827; color: #fff; }
    .hero-inner { max-width: 1120px; margin: 0 auto; padding: 38px 20px; }
    .hero h1 { margin: 0 0 8px; font-size: 32px; letter-spacing: 0; line-height: 1.2; }
    .hero p { margin: 0; color: #d1d5db; max-width: 680px; }
    .page { max-width: 1120px; margin: 28px auto; padding: 0 20px; display: grid; grid-template-columns: minmax(0, 1fr) 310px; gap: 24px; align-items: start; }
    .section-title { margin: 0 0 18px; font-size: 22px; color: #111827; }
    .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 1px 3px rgba(15, 23, 42, .05); }
    .badge { display: inline-flex; align-items: center; border-radius: 999px; padding: 2px 10px; background: #eef2ff; color: #4338ca; font-weight: 700; font-size: 12px; }
    .meta { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 8px; color: #6b7280; font-size: 13px; }
    .button { display: inline-flex; align-items: center; padding: 9px 14px; border-radius: 6px; background: #4f46e5; color: #fff; font-size: 13px; font-weight: 800; }
    .sidebar-box { padding: 18px; }
    .sidebar-box h2 { margin: 0 0 14px; font-size: 17px; }
    .empty { background: #fff; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 36px; text-align: center; color: #64748b; }
    @media (max-width: 820px) {
      .page { grid-template-columns: 1fr; }
      .hero h1 { font-size: 26px; }
    }
  </style>
  @stack('styles')
</head>
<body>
  <header class="topbar">
    <div class="topbar-inner">
      <a class="brand" href="{{ route('pengunjung.index') }}">Blog Publik</a>
      <nav class="nav-actions">
        <a class="nav-link" href="{{ route('pengunjung.index') }}">Beranda</a>
        <a class="nav-link" href="{{ url('/cms/index.php') }}">CMS Admin</a>
      </nav>
    </div>
  </header>

  @yield('content')
</body>
</html>
