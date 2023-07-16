<?php

namespace Dlogon\TranslationManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languaje extends Model
{
    use HasFactory;

    public function getTable()
    {
        $routePrefixName = config("translation-manager.db_prefix", "translations");

        return $routePrefixName . "_languajes";
    }
}
