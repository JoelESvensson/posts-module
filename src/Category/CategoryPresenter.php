<?php namespace Anomaly\PostsModule\Category;

use Anomaly\PostsModule\Category\Command\GetCategoryPath;
use Anomaly\PostsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CategoryPresenter
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PostsModule\Category
 */
class CategoryPresenter extends EntryPresenter
{

    use DispatchesJobs;

    /**
     * The presented object.
     * This is for IDE support.
     *
     * @var CategoryInterface
     */
    protected $object;

    /**
     * Return the category path.
     *
     * @return string
     */
    public function path()
    {
        return $this->dispatch(new GetCategoryPath($this->object));
    }

    /**
     * Return the view link.
     *
     * @return string
     */
    public function viewLink()
    {
        return app('html')->link(
            $this->dispatch(new GetCategoryPath($this->object)),
            $this->object->getName(),
            ['target' => '_blank']
        );
    }
}
