<?php

namespace app\models;

use RedBeanPHP\R;

class Main extends AppModel
{
    /**
     * Возвращает все слайды из таблицы слайдов
     * @return array
     */
    public function getSlidesForSlider()
    {
        return R::findAll('slider');
    }

    /**
     * возвращает хитовые (рекомендованные) товары на русском языке
     * @param $lang
     * @param $limit
     * @return array
     */
    public function getHits($lang, $limit) : array
    {
        return R::getAll(sql: "SELECT p.* , pd.* FROM product p JOIN product_description pd on p.id = pd.product_id 
                  WHERE p.status = 1 AND p.hit = 1 AND pd.language_id = ? LIMIT ? ", bindings: [$lang, $limit]);
    }
}