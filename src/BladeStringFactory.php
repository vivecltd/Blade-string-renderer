<?php
namespace BladeStringRenderer;

use Illuminate\View\Factory;
use RuntimeException;

class BladeStringFactory extends Factory
{
    public function makeFromTemplateString($templateString, $data = [], $mergeData = [])
    {
	// This is to allow the factory to be used in a queue - without the check event listeners
        // will get stacked on each other firing more than once
        if(!$this->events->hasListeners("tempTemplateRendered"))
        {
            $this->addEventListener("tempTemplateRendered", TempTemplateRenderedEventListener::class);
        }

        $file = tempnam(sys_get_temp_dir(), "blade_");

        if(false === file_put_contents($file, $templateString))
        {
            throw new RuntimeException("Could not save template to a temp file");
        }

        $engine = $this->getEngineResolver()->resolve('blade');

        $data = array_merge($mergeData, $this->parseData($data));

        $this->callCreator($view = new BladeStringView($this, $engine, $file, $file, $data));
        
        return $view;
    }
}
