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

    public function getCategory($lang) : array
    {
        $categories = R::getAll(sql: "SELECT c.* , cd.* FROM category c JOIN category_description cd on c.id = cd.category_id 
                  WHERE cd.language_id = ? ", bindings: [$lang]);

        $result =[];
        for ($i=0; $i<count($categories); $i++) {
            $result[$categories[$i]['id']] = $categories[$i];
        }
        foreach ($categories as $category) {
            if ($category['parent_id']>0) {
                $result[$category['parent_id']]['children'][]= $category;
                unset($result[$category['id']]);
            }
        }
        return $result;
    }

}