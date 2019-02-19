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

    /**
     * @param int $limit
     * @return mixed
     */
    public function meta_title($limit=70)
    {
        return $this->entity->meta_title ? $this->entity->meta_title : $this->entity->{$this->titleKey};
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function meta_description($limit=165)
    {
        return $this->entity->meta_description ? $this->entity->meta_description : $this->entity->{$this->descriptionKey};
    }

    /**
     * @param int $limit
     * @return string
     */
    public function og_title($limit=70)
    {
        return $this->entity->og_title ? str_limit($this->entity->og_title, $limit) : str_limit($this->entity->{$this->titleKey}, $limit);
    }

    /**
     * @param int $limit
     * @return string
     */
    public function og_description($limit=165)
    {
        return $this->entity->og_description ? str_limit($this->entity->og_description, $limit) : str_limit($this->entity->{$this->descriptionKey}, $limit);
    }

    /**
     * @param string $langKey
     * @param string $urlKey
     * @param bool $sitemap
     * @return array
     */
    public function languages($langKey='lang', $urlKey='url', $sitemap=false)
    {
        $languages = collect();
        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $supportedLocale)
        {
            if($this->entity->hasTranslation($locale)) {
                $languages->push([$langKey => $locale, $urlKey => $this->url($locale)]);
            }
        }
        if($languages->count()>1) {
            return $languages->toArray();
        }
        return [];
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function meta_keywords($limit=20)
    {
        return $this->entity->tags()->get()->take($limit)->map(function ($tag) {
            return $tag->name;
        })->toArray();
    }

    /**
     * @param int $width
     * @param null $height
     * @param string $mode
     * @param int $quality
     * @return \Illuminate\Contracts\Routing\UrlGenerator|null|string
     */
    public function og_image($width = 600, $height = null, $mode = 'resize', $quality = 80)
    {
        if($file = $this->entity->files()->first()) {
            return url($this->firstImage($width, $height, $mode, $quality));
        }
        return null;
    }

    /**
     * @param string $locale
     * @return false|string
     */
    public function url($locale='')
    {
        if(!empty($locale)) {
            if($this->entity->hasTranslation($locale)) {
                return $this->entity->translate($locale)->url;
            }
        }
        return localize_url($this->routeKey, $this->entity->url);
    }

    /**
     * @param $width
     * @param $height
     * @param $mode
     * @param $quality
     * @param string $watermark
     * @return bool|string
     */
    public function firstImage($width, $height, $mode, $quality, $watermark='')
    {
        if($file = $this->entity->filesByZone($this->zone)->first()) {
            return \Imagy::getImage($file->filename, $this->zone, ['width' => $width, 'height' => $height, 'mode' => $mode, 'quality' => $quality, 'watermark'=>$watermark]);
        }
        return false;
    }

    /**
     * @param $width
     * @param $height
     * @param $mode
     * @param $quality
     * @param string $watermark
     * @return array
     */
    public function images($width, $height, $mode, $quality, $watermark='')
    {
        $productImages = [];
        foreach ($this->entity->filesByZone($this->zone)->get() as $file)
        {
            $productImages[] = \Imagy::getImage($file->filename, $this->zone, ['width' => $width, 'height' => $height, 'mode' => $mode, 'quality' => $quality, 'watermark'=>$watermark]);
        }
        return $productImages;
    }
}
