<?php

namespace Tripteki\Docs\Console\Commands;

use L5Swagger\Console\GenerateDocsCommand as Command;

class GenerateDocsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = "swagger:generate {documentation?} {--all}";

    /**
     * @var string
     */
    protected $description = "Regenerate swagger docs";
};
