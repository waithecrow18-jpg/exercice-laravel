<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('public.home', ['locale' => 'fr']) }}</loc>
    </url>
    <url>
        <loc>{{ route('public.home', ['locale' => 'en']) }}</loc>
    </url>
    @foreach ($trainings as $training)
        <url>
            <loc>{{ route('public.trainings.show.fr', ['locale' => 'fr', 'slug' => $training->slug_fr]) }}</loc>
        </url>
        <url>
            <loc>{{ route('public.trainings.show.en', ['locale' => 'en', 'slug' => $training->slug_en]) }}</loc>
        </url>
    @endforeach
    @foreach ($posts as $post)
        <url>
            <loc>{{ route('public.blog.show', ['locale' => 'fr', 'slug' => $post->slug_fr]) }}</loc>
        </url>
        <url>
            <loc>{{ route('public.blog.show', ['locale' => 'en', 'slug' => $post->slug_en]) }}</loc>
        </url>
    @endforeach
</urlset>
