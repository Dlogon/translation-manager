<?php

namespace Dlogon\TranslationManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dlogon\TranslationManager\TranslationManager
 */
class TranslationManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'translation-manager';
    }
}
