# Blade-string-renderer

Blade templating engine is effective and easy to use, but lacks flexibility. It 
is impossible with blade to render a template from string. The idea behing the
way it was engineered is that every template has to be a physical file on a 
file system, and if the template is coming from DB database or wherever else, 
then there is pretty much nothing non-hacky that can be done.

## How it works

This works quite simply. Blade-string-renderer extends Laravel's View Factory and can
be used in exacly the same way as standard view. The main difference is that it has 
an additional method that makes a view from temlate string as opposed to template
file.

Blade-string-renderer is totally unintrusive. Instead of fiddling with Blade/Laravel's 
View Factory internals, the library provides the easiest and probably future-proof way of 
handling this case. Just before the view is rendered, the template contents 
(passed as a string) get saved to a temporary directory on a local filesystem. The 
renderer then proceeds to work as usual by using blade template stored in a temporary
location. After the template is rendered, temporary file is deleted. This approach,
while being primitive, makes sure that Laravel View Factory and Blade internals are tweaked
as little as possible, providing robust and loose solution for such a common problem

## Usage
```php
/**
 * @param BladeStringRenderer\BladeStringFactory $viewFactory
 */
public function __construct(BladeStringRenderer\BladeStringFactory $viewFactory)
{
    $this->viewFactory = $viewFactory;
}

/**
 * Render the template from the template string
 *
 * @param string $templateString
 * @param array $data
 *
 * @return string rendered template
 */
protected function buildFromTemplateString(string $templateString, array $data)
{
    return $this->viewFactory->makeFromTemplateString($templateString, $data)->render();
}
```
## There are no tests as of yet

They are coming soon. Blade-string-renderer was needed urgently, and it is not yet tested.
