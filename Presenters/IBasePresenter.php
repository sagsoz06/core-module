<?php namespace Modules\Core\Presenters;


interface IBasePresenter
{
    public function url($locale);
    public function meta_title($limit);
    public function meta_description();
    public function og_title();
    public function og_description();
    public function languages();
    public function meta_keywords($limit);
    public function og_image($width=600, $height=600, $mode='fit', $quality=80);
    public function firstImage($width, $height, $mode, $quality, $watermark="");
    public function images($width, $height, $mode, $quality);
}