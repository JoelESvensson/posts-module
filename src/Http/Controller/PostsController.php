<?php namespace Anomaly\PostsModule\Http\Controller;

use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Http\Request;

/**
 * Class PostsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PostsModule\Http\Controller
 */
class PostsController extends PublicController
{

    /**
     * Display recent posts.
     *
     * @param PostRepositoryInterface $posts
     * @return \Illuminate\View\View
     */
    public function index(PostRepositoryInterface $posts)
    {
        $posts = $posts->getRecent();

        return view('anomaly.module.posts::posts/index', compact('posts'));
    }

    /**
     * Show an existing post.
     *
     * @param PostRepositoryInterface    $posts
     * @param Request                    $request
     * @param SettingRepositoryInterface $settings
     * @return \Illuminate\View\View
     */
    public function show(PostRepositoryInterface $posts, Request $request, SettingRepositoryInterface $settings)
    {
        $base      = $settings->get('anomaly.module.posts::module_base', 'posts');
        $structure = $base . '/' . $settings->get(
                'anomaly.module.posts::permalink_structure',
                '{year}/{month}/{day}/{post}'
            );

        $post = $posts->findBySlug($request->segment(array_search('{post}', explode('/', $structure)) + 1));

        return view('anomaly.module.posts::posts/show', compact('post'));
    }
}
