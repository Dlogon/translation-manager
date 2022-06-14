<?php

namespace Dlogon\TranslationManager;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Dlogon\TranslationManager\Commands\TranslationManagerCommand;

class TranslationManagerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('translation-manager')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_translation-manager_table')
            ->hasCommand(TranslationManagerCommand::class);
    }
}
