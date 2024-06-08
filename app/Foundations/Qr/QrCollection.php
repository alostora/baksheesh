<?php

namespace App\Foundations\Qr;


use App\Constants\CompanyModuleType;
use App\Models\Company;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;


class QrCollection
{
    public static function createCompanyQr($company_qr_png)
    {

        $manager = ImageManager::gd();

        $img = $manager->read(file_get_contents('user2-160x160.png'));
        // $img = $manager->read($company_qr_png);

        // $img->place(public_path('user2-160x160.png'));

        // $img->place(
        //     public_path('user2-160x160.png'),
        //     'bottom-right',
        //     10,
        //     10,
        //     25
        // );

        return $img;
    }
}
