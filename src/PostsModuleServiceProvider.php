<?php namespace Anomaly\PostsModule;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class PostsModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PostsModule
 */
class PostsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/posts'                        => 'Anomaly\PostsModule\Http\Controller\Admin\PostsController@index',
        'admin/posts/create'                 => 'Anomaly\PostsModule\Http\Controller\Admin\PostsController@create',
        'admin/posts/edit/{id}'              => 'Anomaly\PostsModule\Http\Controller\Admin\PostsController@edit',
        'admin/posts/categories'             => 'Anomaly\PostsModule\Http\Controller\Admin\CategoriesController@index',
        'admin/posts/categories/create'      => 'Anomaly\PostsModule\Http\Controller\Admin\CategoriesController@create',
        'admin/posts/categories/edit/{id}'   => 'Anomaly\PostsModule\Http\Controller\Admin\CategoriesController@edit',
        'admin/posts/types'                  => 'Anomaly\PostsModule\Http\Controller\Admin\TypesController@index',
        'admin/posts/types/create'           => 'Anomaly\PostsModule\Http\Controller\Admin\TypesController@create',
        'admin/posts/types/edit/{id}'        => 'Anomaly\PostsModule\Http\Controller\Admin\TypesController@edit',
        'admin/posts/ajax/choose_type'       => 'Anomaly\PostsModule\Http\Controller\Admin\AjaxController@chooseType',
        'admin/posts/ajax/choose_field/{id}' => 'Anomaly\PostsModule\Http\Controller\Admin\AjaxController@chooseField',
        'admin/posts/settings'               => 'Anomaly\PostsModule\Http\Controller\Admin\SettingsController@edit'
    ];

    /**
     * Class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\PostsModule\Post\PostModel'         => 'Anomaly\PostsModule\Post\PostModel',
        'Anomaly\PostsModule\Type\TypeModel'         => 'Anomaly\PostsModule\Type\TypeModel',
        'Anomaly\PostsModule\Category\CategoryModel' => 'Anomaly\PostsModule\Category\CategoryModel'
    ];

    /**
     * Singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\PostsModule\Post\Contract\PostRepositoryInterface'         => 'Anomaly\PostsModule\Post\PostRepository',
        'Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface'         => 'Anomaly\PostsModule\Type\TypeRepository',
        'Anomaly\PostsModule\Category\Contract\CategoryRepositoryInterface' => 'Anomaly\PostsModule\Category\CategoryRepository'
    ];

    /**
     * Get the routes.
     *
     * @return array
     */
    public function getRoutes()
    {
        /* @var SettingRepositoryInterface $settings */
        $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');

        /**
         * Route base URI.
         */
        $this->routes[$base = $settings->get(
            $this->addon->getNamespace('module_base'),
            'posts'
        )] = 'Anomaly\PostsModule\Http\Controller\PostsController@index';

        /**
         * Route base category URI.
         */
        $this->routes[$base . '/' . $settings->get(
            $this->addon->getNamespace('category_base'),
            'category'
        ) . '/{category}'] = 'Anomaly\PostsModule\Http\Controller\CategoriesController@posts';

        /**
         * Route base tag URI.
         */
        $this->routes[$base . '/' . $settings->get(
            $this->addon->getNamespace('tag_base'),
            'tag'
        ) . '/{tag}'] = 'Anomaly\PostsModule\Http\Controller\TagsController@posts';

        /**
         * Route post URIs.
         */
        $this->routes[$base . '/' . $settings->get(
            $this->addon->getNamespace('permalink_structure'),
            '{year}/{month}/{day}/{post}'
        )] = 'Anomaly\PostsModule\Http\Controller\PostsController@show';

        return parent::getRoutes();
    }
}
