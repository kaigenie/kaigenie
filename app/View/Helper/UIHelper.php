<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/21/13
 * Time: 2:03 PM
 * To change this template use File | Settings | File Templates.
 */

App::uses('HtmlHelper', 'View/Helper');

class UIHelper extends HtmlHelper{

    public function icon($class = null, $text = null, $options = array()) {
        if (!empty($class)) {
            $options['class'] = $class;
        }

        $icon = '<i class="%s"></i>%s';
        return sprintf($icon, $class, $text);

    }


}