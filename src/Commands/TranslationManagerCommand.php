<?php

namespace Dlogon\TranslationManager\Commands;

use Illuminate\Console\Command;

class TranslationManagerCommand extends Command
{
    public $signature = 'translation-manager';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
