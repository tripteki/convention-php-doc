<?php

namespace Tripteki\Docs\Console\Commands;

use Illuminate\Console\Command;

class UnGenerateDocsCommand extends Command
{
    /**
     * @var bool
     */
    protected $hidden = true;

    /**
     * @var string
     */
    protected $signature = "l5-swagger:generate {documentation?} {--all}";

    /**
     * @var string
     */
    protected $description = "Regenerate swagger docs";
};
