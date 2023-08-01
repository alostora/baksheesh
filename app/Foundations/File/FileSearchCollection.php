<?php

namespace App\Foundations\File;

use App\Constants\SystemDefault;

class FileSearchCollection

{
    public static function searchFiles(
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $users = FileQueryCollection::searchAllFiles();

        return $users->paginate($per_page);
    }
}
