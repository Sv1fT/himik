<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    @foreach($url as $item)
    
        <url>
            <loc>{{$item}}</loc>
            <lastmod>{{date('c',time())}}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>