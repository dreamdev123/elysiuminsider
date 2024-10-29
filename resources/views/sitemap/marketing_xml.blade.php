{!! '<'.'?'.'xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($routes as $route)
        <url>
            <loc>{{ $route['loc'] }}</loc>
            @foreach($route['alternatives'] ?? [] as $locale => $url)
                <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}"/>
            @endforeach
        </url>
    @endforeach
</urlset>
