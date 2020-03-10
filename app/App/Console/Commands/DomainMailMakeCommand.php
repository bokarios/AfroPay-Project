<?php

namespace CreatyDev\App\Console\Commands;

use Illuminate\Foundation\Console\MailMakeCommand;

class DomainMailMakeCommand extends MailMakeCommand
{
    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain';
    }
}
