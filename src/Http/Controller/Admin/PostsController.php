<?php namespace Anomaly\PostsModule\Http\Controller\Admin;

use Anomaly\PostsModule\Post\Form\PostFormBuilder;
use Anomaly\PostsModule\Post\Table\PostTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class PostsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PostsModule\Http\Controller\Admin
 */
class PostsController extends AdminController
{

    /**
     * Return an index of existing posts.
     *
     * @param PostTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PostTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return the form for creating a new post.
     *
     * @param PostFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(PostFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Returns the form for an existing post.
     *
     * @param PostFormBuilder $form
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PostFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
