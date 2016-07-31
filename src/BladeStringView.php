<?php
namespace BladeStringRenderer;

use Exception;
use Illuminate\View\View;
use Throwable;

class BladeStringView extends View
{
    /**
     * Get the string contents of the view.
     *
     * @param  callable|null $callback
     * @return string
     * @throws Exception
     * @throws Throwable
     */
    public function render(callable $callback = null)
    {
        $rendered = parent::render($callback);
        $this->factory->getDispatcher()->fire("tempTemplateRendered", $this->getName());
        return $rendered;
    }
}
