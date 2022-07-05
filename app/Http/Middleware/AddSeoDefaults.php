<?php
namespace App\Http\Middleware;

use Closure;
use romanzipp\Seo\Structs\Link;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Script;

class AddSeoDefaults
{
    public function handle($request, Closure $next)
    {
        seo()->charset();
        seo()->viewport();

        seo()->title('Corsati');
        seo()->description('يمكنك الان حجز درس خصوصي رياضيات وأنجليزي وفيزياء وكيمياء وايضا القيام بأختبار قدرات وتحصيلي .. أحجز الأن حصة جماعي وتدرب مع زملائك واصدقائك!');

        seo()->csrfToken();

        seo()->addMany([

            Meta::make()->name('copyright')->content('Corsati'),

            Meta::make()->name('mobile-web-app-capable')->content('yes'),
            Meta::make()->name('theme-color')->content('#f03a17'),
            Link::make()->rel('icon')->href(url('website/img/seo.png')),

            OpenGraph::make()->property('title')->content('Corsati'),
            OpenGraph::make()->property('site_name')->content('Corsati'),
            OpenGraph::make()->property('locale')->content('ar_SA'),

            Twitter::make()->name('card')->content(url('website/img/seo.png')),
            Twitter::make()->name('site')->content('@corsati'),
            Twitter::make()->name('creator')->content('@corsati'),
            Twitter::make()->name('image')->content(url('website/img/seo.png'), false)

        ]);

//        seo('body')->add(
//         //   Script::make()->attr('src', '/js/app.js')
//        );

        return $next($request);
    }
}
