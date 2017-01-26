<?php namespace Dmandrade\FormBuilder;

use Collective\Html\FormBuilder as LaravelForm;
use Collective\Html\HtmlBuilder;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('Dmandrade\FormBuilder\Console\FormMakeCommand');

        $this->registerHtmlIfNeeded();
        $this->registerFormIfNeeded();

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php',
            'form-builder'
        );

        $this->registerFormHelper();

        $this->app->singleton('form-builder', function ($app) {

            return new FormBuilder($app, $app['form-helper']);
        });

        $this->commands('Dmandrade\FormBuilder\Console\FormMakeCommand');
        $this->app->alias('form-builder', 'Dmandrade\FormBuilder\FormBuilder');
    }

    protected function registerFormHelper()
    {
        $this->app->singleton('form-helper', function ($app) {

            $configuration = $app['config']->get('form-builder');

            return new FormHelper($app['view'], $app['translator'], $configuration);
        });

        $this->app->alias('form-helper', 'Dmandrade\FormBuilder\FormHelper');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'form-builder');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'form-builder');

        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/form-builder'),
            __DIR__ . '/../config/config.php' => config_path('form-builder.php')
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php',
            'form-builder'
        );
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return ['form-builder'];
    }

    /**
     * Add Laravel Form to container if not already set
     */
    private function registerFormIfNeeded()
    {
        if (!$this->app->offsetExists('form')) {

            $this->app->singleton('form', function ($app) {

                // LaravelCollective\HtmlBuilder 5.2 is not backward compatible and will throw an exception
                $version = substr(Application::VERSION, 0, 3);

                if (str_is('5.0', $version) || str_is('5.1', $version)) {
                    $form = new LaravelForm($app['html'], $app['url'], $app['session.store']->getToken());
                } else {
                    $form = new LaravelForm($app['html'], $app['url'], $app['view'], $app['session.store']->getToken());
                }

                return $form->setSessionStore($app['session.store']);
            });

            if (!$this->aliasExists('Form')) {

                AliasLoader::getInstance()->alias(
                    'Form',
                    'Collective\Html\FormFacade'
                );
            }
        }
    }

    /**
     * Add Laravel Html to container if not already set
     */
    private function registerHtmlIfNeeded()
    {
        if (!$this->app->offsetExists('html')) {

            $this->app->singleton('html', function ($app) {
                return new HtmlBuilder($app['url'], $app['view']);
            });

            if (!$this->aliasExists('Html')) {

                AliasLoader::getInstance()->alias(
                    'Html',
                    'Collective\Html\HtmlFacade'
                );
            }
        }
    }

    /**
     * Check if an alias already exists in the IOC
     * @param $alias
     * @return bool
     */
    private function aliasExists($alias)
    {
        return array_key_exists($alias, AliasLoader::getInstance()->getAliases());
    }

}
