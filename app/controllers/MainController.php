<?php

namespace app\controllers;

class MainController extends AppController
{

    public function indexAction()
    {
        $slides = $this->model->getSlidesForSlider();
        $products = $this->model->getHits(1, 100); //возвращает хитовые (рекомендованные) товары на русском языке
        $this->setData(compact('slides', 'products'));
    }
}