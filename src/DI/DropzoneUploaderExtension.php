<?php
/**
 * Copyright (c) 2015 Petr Olišar (http://olisar.eu)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Oli\Form;


/**
 * Description of DropzoneUploader
 *
 * @author Petr Olišar <petr.olisar@gmail.com>
 */
class DropzoneUploaderExtension extends \Nette\DI\CompilerExtension
{

    public $defaults = [
        'wwwDir' => '%wwwDir%',
        'path' => 'gallery',
        'settings' => [
            'maxFiles' => 5,
            'fileSizeLimit' => 100,
            'ajax' => FALSE,
            'onSuccess' => 'refresh!'
        ],
        'photo' => [
            'width' => NULL,
            'height' => NULL,
            'flags' => \Nette\Utils\Image::FIT,
            'quality' => NULL,
            'type' => NULL
        ],
        'isImage' => TRUE,
        'allowType' => NULL,
        'rewriteExistingFiles' => FALSE
    ];


    public function getDefaults()
    {
        return $this->getConfig($this->defaults);
    }


    public function loadConfiguration()
    {
        //dump($this->defaults);die;
        $config = $this->getConfig($this->defaults);
        //dump($config);die;
        $builder = $this->getContainerBuilder();

        $builder->addFactoryDefinition($this->prefix('dropzone'))
            ->setImplement(\Oli\Form\DropzoneUploaderFactory::class)
            ->getResultDefinition()
            ->setFactory(\Oli\Form\DropzoneUploader::class)
            ->addSetup('setWwwDir', [$config['wwwDir'] ?? null])
            ->addSetup('setPath', [$config['path'] ?? null])
            ->addSetup('setSettings', [$config['settings'] ?? null])
            ->addSetup('setPhoto', [$config['photo'] ?? null])
            ->addSetup('isImage', [$config['isImage'] ?? null])
            ->addSetup('setAllowType', [$config['allowType'] ?? null])
            ->addSetup('setRewriteExistingFiles', [$config['rewriteExistingFiles'] ?? null]);

    }

}
