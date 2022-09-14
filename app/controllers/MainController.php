<?php

namespace app\controllers;

class MainController extends AppController
{

    public function indexAction()
    {
        $slides = $this->model->getSlidesForSlider();
        $products = $this->model->getHits(1, 100); //возвращает хитовые (рекомендованные) товары на русском языке
        $categories = $this->model->getCategory(1);
        $this->setData(compact('slides', 'products', 'categories'));
    }
}