<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;

class SitemapController extends Controller
{
    // public function generate()
    // {
    //     SitemapGenerator::create(config('app.url'))
    //         ->writeToFile(public_path('sitemap.xml'));

    //     return response()->view('sitemap');
    // }

    public function generate()

    {
        // Get inventory URLs from the database (assuming Inventory is an Eloquent model)
        $inventory_urls = Inventory::select('id','make','model','body','year','vin','stock')->get();
    
        // Define static URLs
        $static_urls = [
            'https://localcarz.com/',
            'https://localcarz.com/car-news',
            'https://localcarz.com/recently-added',
            'https://localcarz.com/favorite/listing',
            'https://localcarz.com/contact-us',
        ];
    
        // Combine static URLs with inventory URLs
        $sitemap_urls = [];
        foreach ($inventory_urls as $url) {
            $modifiedBodyString = str_replace(' ', '+', $url->body);
            $modifiedMakeString = str_replace(' ', '+', $url->model);
    
            $dynamic_url = 'https://localcarz.com/used-cars-for-sale/' . $url->vin . '/listing/' . $url->year . '-' . $url->make . '-' . $modifiedMakeString . '-' . $modifiedBodyString . '-' . $url->stock;
    
            $sitemap_urls[] = [
                'url'       => $dynamic_url,
                'lastmod'   => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority'  => $dynamic_url === 'https://localcarz.com/' ? '1.0' : '0.8000',
            ];
        }
    
        // Merge static URLs with dynamic URLs
        $all_urls = array_merge($static_urls, array_column($sitemap_urls, 'url'));
    
        // Generate the sitemap URLs array
        $sitemap_urls = [];
        foreach ($all_urls as $url) {
            $sitemap_urls[] = [
                'url'       => $url,
                'lastmod'   => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority'  => $url === 'https://localcarz.com/' ? '1.0' : '0.8000',
            ];
        }
    
        // Return the sitemap as an XML response
        return response()->view('sitemap', ['urls' => $sitemap_urls])->header('Content-Type', 'text/xml');
    }


    
    // {
    //     $inventory_url = Inventory::get();
    //     // dd($inventory_url);


    //     $urls = [
    //         ['url' => 'https://localcarz.com/', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '1.0'],
    //         ['url' => 'https://localcarz.com/car-news', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '1.0'],
    //         ['url' => 'https://localcarz.com/recently-added', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '1.0'],
    //         ['url' => 'https://localcarz.com/favorite/listing', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '1.0'],
    //         ['url' => 'https://localcarz.com/contact-us', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '1.0'],


    //         foreach ($inventory_url as $item) {
    //             echo $item . '<br>';
    //         }


    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCBKC8FR525421/listing/2015-Chevrolet-Tahoe-Sport+Utility-D254211', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1HGCV1F32JA233817/listing/2018-Honda-Accord%20Sedan-4dr+Car-T33817', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPE34AF0JH653102/listing/2018-Hyundai-Sonata-4dr+Car-T53102', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/2C3CCAAG2MH609263/listing/2021-Chrysler-300-4dr+Car-609263', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1C4BJWDG3GL302262/listing/2016-Jeep-Wrangler%20Unlimited-Convertible-302262', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GCGSCEN3J1317250/listing/2018-Chevrolet-Colorado-Crew+Cab+Pickup-D17250', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/2G1125S34J9149742/listing/2018-Chevrolet-Impala-4dr+Car-149742', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPDH4AE5FH591305/listing/2015-Hyundai-Elantra-4dr+Car-T91305', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3N1CE2CP4JL352203/listing/2018-Nissan-Versa%20Note-Hatchback-352203', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4BV0LC234079/listing/2020-Nissan-Altima-4dr+Car-234079', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4BV4LC251743/listing/2020-Nissan-Altima-4dr+Car-251743', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCAKC2GR445334/listing/2016-Chevrolet-Tahoe-Sport+Utility-445334', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3KPFK4A79HE062751/listing/2017-Kia-Forte-4dr+Car-062751', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N6AD0ER0FN719497/listing/2015-Nissan-Frontier-Crew+Cab+Pickup-T19497', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/55SWF4JB4FU071453/listing/2015-Mercedes-Benz-C-Class-4dr+Car-071453', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPE34AF4JH677709/listing/2018-Hyundai-Sonata-4dr+Car-677709', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3N1CN8EV9ML924823/listing/2021-Nissan-Versa-4dr+Car-924823', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4CVXMN363757/listing/2021-Nissan-Altima-4dr+Car-363757', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GKKNPLS7MZ151651/listing/2021-GMC-Acadia-Sport+Utility-151651', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5N1DR3AC5NC252832/listing/2022-Nissan-Pathfinder-Sport+Utility-252832', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/4T1BF1FK1HU672638/listing/2017-Toyota-Camry-4dr+Car-672638', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3GKALMEV2JL211135/listing/2018-GMC-Terrain-Sport+Utility-211135', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/2G61M5S30E9170369/listing/2014-Cadillac-XTS-4dr+Car-170369', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3GNAXKEV8NL226823/listing/2022-Chevrolet-Equinox-Sport+Utility-226823', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4AA6AP8HC429886/listing/2017-Nissan-Maxima-4dr+Car-429886', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N6BD0CT4HN767011/listing/2017-Nissan-Frontier-Extended+Cab+Pickup-767011', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/JTHBK1GG9G2222593/listing/2016-Lexus-ES%20350-4dr+Car-222593', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCBKC8FR525421/listing/2016-Chevrolet-Tahoe-Sport+Utility-445334', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCBKC8GR459793/listing/2016-Chevrolet-Tahoe-Sport+Utility-459793', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCBKC8FR525421/listing/2016-Chevrolet-Tahoe-Sport+Utility-459793', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCBKCXFR512587/listing/2015-Chevrolet-Tahoe-Sport+Utility-512587', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCBKC8FR525421/listing/2015-Chevrolet-Tahoe-Sport+Utility-512587', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3GCPWDEK6MG196879/listing/2021-Chevrolet-Silverado%201500-Crew+Cab+Pickup-196879', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3GCUKSEC8HG464395/listing/2017-Chevrolet-Silverado%201500-Crew+Cab+Pickup-464395', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1C6RR6TT1KS653781/listing/2019-Ram-1500%20Classic-Crew+Cab+Pickup-653781', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1HGCV1F38JA203320/listing/2018-Honda-Accord%20Sedan-4dr+Car-203320', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1HGCV1F32JA233817/listing/2018-Honda-Accord%20Sedan-4dr+Car-203320', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1HGCR2F56HA217190/listing/2017-Honda-Accord%20Sedan-4dr+Car-217190', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1HGCV1F32JA233817/listing/2017-Honda-Accord%20Sedan-4dr+Car-217190', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPE34ABXFH109937/listing/2015-Hyundai-Sonata-4dr+Car-D09937', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPE34AF0JH653102/listing/2015-Hyundai-Sonata-4dr+Car-D09937', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPE34AF3KH806332/listing/2019-Hyundai-Sonata-4dr+Car-806332', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPE34AF0JH653102/listing/2019-Hyundai-Sonata-4dr+Car-806332', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPE34AF0JH653102/listing/2018-Hyundai-Sonata-4dr+Car-6777092', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1C4HJXDG4JW112430/listing/2018-Jeep-Wrangler%20Unlimited-Convertible-D12430', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1C4BJWDG3GL302262/listing/2018-Jeep-Wrangler%20Unlimited-Convertible-D12430', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GCHSBEA0H1276596/listing/2017-Chevrolet-Colorado-Extended+Cab+Pickup-276596', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GCGTCEN3J1274848/listing/2018-Chevrolet-Colorado-Crew+Cab+Pickup-274848', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GCGSCEN3J1317250/listing/2018-Chevrolet-Colorado-Crew+Cab+Pickup-274848', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
            
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/2G1125S34J9149742/listing/2018-Chevrolet-Impala-4dr+Car-137866', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
            
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/2G1105S39J9137866/listing/2018-Chevrolet-Impala-4dr+Car-137866', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPDH4AE0GH735540/listing/2016-Hyundai-Elantra-4dr+Car-735540', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3N1CE2CP8JL353242/listing/2018-Nissan-Versa%20Note-Hatchback-353242', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GCGSCEN3J1317250/listing/2018-Chevrolet-Colorado-Crew+Cab+Pickup-274848', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/5NPDH4AE5FH591305/listing/2016-Hyundai-Elantra-4dr+Car-735540', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/3N1CE2CP4JL352203/listing/2018-Nissan-Versa%20Note-Hatchback-353242', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4BV6MN356578/listing/2021-Nissan-Altima-4dr+Car-356578', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4BV0LC234079/listing/2021-Nissan-Altima-4dr+Car-356578', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4DV5MN365818/listing/2021-Nissan-Altima-4dr+Car-365818', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4BV0LC234079/listing/2020-Nissan-Altima-4dr+Car-251743', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4BV0LC234079/listing/2021-Nissan-Altima-4dr+Car-365818', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4BV4LC251743/listing/2020-Nissan-Altima-4dr+Car-234079', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1N4BL4BV4LC251743/listing/2021-Nissan-Altima-4dr+Car-356578', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
            
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCAKC2GR445334/listing/2016-Chevrolet-Tahoe-Sport+Utility-459793', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCAKC2GR445334/listing/2015-Chevrolet-Tahoe-Sport+Utility-512587', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         ['url' => 'https://localcarz.com/used-cars-for-sale/1GNSCAKC2GR445334/listing/2015-Chevrolet-Tahoe-Sport+Utility-D25421', 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8000'],
    //         // Add more URLs as needed

    //     ];        

    //     return response()->view('sitemap', ['urls' => $urls])->header('Content-Type', 'text/xml');
    // }
}











