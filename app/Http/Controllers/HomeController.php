<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;

class HomeController extends Controller
{
    public function index()
    {
        $metabaseSiteUrl = 'https://metabase.mesquita.rj.gov.br';
        $metabaseSecretKey = env('METABASE_SECRET_KEY', '');
        
        $signer = new Sha256();
        $builder = new Builder();

        $token = $builder
            ->setIssuer($metabaseSiteUrl) 
            ->setAudience($metabaseSiteUrl) 
            ->setId($metabaseSecretKey, true)
            ->setIssuedAt(time()) 
            ->set('resource', ['dashboard' => 25])
            ->set('params', (object)[])
            ->sign($signer, $metabaseSecretKey) 
            ->getToken();

        $iframeUrl = "{$metabaseSiteUrl}/embed/dashboard/{$token}#bordered=true&titled=false";

        return view('pages.dashboard', compact('iframeUrl'));
    }
}
