<?php

namespace BladeStringRenderer;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\Writer;

class TempTemplateRenderedEventListener implements ShouldQueue
{
    /**
     * @var Writer
     */
    protected $writer;

    /**
     * Create the event listener.
     */
    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    /**
     * Handle the event.
     *
     * @param $fileName
     */
    public function handle($fileName)
    {
        if(!file_exists($fileName) || false === @unlink($fileName))
        {
            $this->writer->error("Could not delete {$fileName} temporary blade template");
        }
    }
}
