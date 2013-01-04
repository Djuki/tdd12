<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/3/13
 * Time: 6:05 PM
 * To change this template use File | Settings | File Templates.
 */

class Template
{
    /**
     *
     * Render html and translate input data
     *
     * @param $html
     * @param $data
     * @return mixed
     */
    public function render($html, $data)
    {
        $replacements = $this->prepareTemplateData($data);

        return str_replace(array_keys($replacements), $replacements, $html);
    }

    /**
     *
     * Prepare input data for east replacement
     *
     * In real world we can have setVar method to avoid this at rendering
     *
     * @param $data
     * @return array
     */
    private function prepareTemplateData($data)
    {
        $replacements = array();
        foreach ($data as $key => $item)
        {
            $replacements['{$'.$key.'}'] = $item;
        }
        return $replacements;
    }
}