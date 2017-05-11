<?php namespace Modules\Core\Presenters;

use Laracasts\Presenter\Presenter;

abstract class BasePresenter extends Presenter implements IBasePresenter
{
    protected $zone = '';
    protected $slug = '';
    protected $transKey = '';
    protected $routeKey = '';
    protected $slugKey = 'slug';
    protected $titleKey = 'title';
    protected $descriptionKey = 'intro';

    public function meta_title($limit=70)
    {
        return $this->entity->meta_title ? $this->entity->meta_title : $this->entity->{$this->titleKey};
    }

    public function meta_description($limit=165)
    {
        return $this->entity->meta_description ? $this->entity->meta_description : $this->entity->{$this->descriptionKey};
    }

    public function og_title($limit=70)
    {
        return $this->entity->og_title ? str_limit($this->entity->og_title, $limit) : str_limit($this->entity->{$this->titleKey}, $limit);
    }

    public function og_description($limit=165)
    {
        return $this->entity->og_description ? str_limit($this->entity->og_description, $limit) : str_limit($this->entity->{$this->descriptionKey}, $limit);
    }

    public function languages($langKey='lang', $urlKey='url')
    {
        $languages = collect();
        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $supportedLocale)
        {
            $languages->push([$langKey=>$locale, $urlKey=>$this->url($locale)]);
        }
        return $languages->toArray();
    }

    public function meta_keywords($limit=20)
    {
        return $this->entity->tags()->get()->take($limit)->map(function ($tag) {
            return $tag->name;
        })->toArray();
    }

    public function og_image($width = 600, $height = 600, $mode = 'fit', $quality = 80)
    {
        if($file = $this->entity->files()->first()) {
            return url($this->firstImage($width, $height, $mode, $quality));
        }
        return null;
    }

    public function url($locale='')
    {
        if(!empty($locale)) {
            if($this->transKey == 'page') {
                if($this->entity->hasTranslation($locale)) {
                    return \LaravelLocalization::getLocalizedURL($locale, $this->entity->translate($locale)->{$this->slugKey});
                }
            } else {
                if($this->entity->hasTranslation($locale)) {
                    if(isset($this->entity->translate($locale)->{$this->slugKey})) {
                        return \LaravelLocalization::getURLFromRouteNameTranslated($locale, $this->transKey, [$this->slug => $this->entity->translate($locale)->{$this->slugKey}]);
                    } else {
                        return \LaravelLocalization::getURLFromRouteNameTranslated($locale, $this->transKey, [$this->slug => $this->entity->{$this->slugKey}]);
                    }
                }
            }
        }
        return route($this->routeKey, $this->entity->{$this->slugKey});
    }

    public function firstImage($width, $height, $mode, $quality, $return=true)
    {
        if($file = $this->entity->files()->where('zone', $this->zone)->first()) {
            return \Imagy::getImage($file->filename, $this->zone, ['width' => $width, 'height' => $height, 'mode' => $mode, 'quality' => $quality]);
        }
        return false;
    }

    public function images($width, $height, $mode, $quality)
    {
        $productImages = [];
        foreach ($this->entity->files()->where('zone', $this->zone)->get() as $file)
        {
            $productImages[] = \Imagy::getImage($file->filename, $this->zone, ['width' => $width, 'height' => $height, 'mode' => $mode, 'quality' => $quality]);
        }
        return $productImages;
    }
}