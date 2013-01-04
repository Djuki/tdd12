<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/3/13
 * Time: 6:05 PM
 * To change this template use File | Settings | File Templates.
 */


include __DIR__.'/../src/template.php';

class TemplateTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test for template
     */
    public function testTemplateRender()
    {
        $template = new Template();

        $this->assertEquals('Hello Cenk', $template->render('Hello {$name}', array('name' => 'Cenk')));

        $this->assertEquals('Hello Peter I am Cenk', $template->render('Hello {$you} I am {$name}', array('name' => 'Cenk', 'you' => 'Peter')));
    }
}