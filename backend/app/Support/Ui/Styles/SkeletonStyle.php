<?php

namespace App\Support\Ui\Styles;

use App\Support\Ui\ClassBuilder;

class SkeletonStyle
{
    public function base(): string
    {
        return ClassBuilder::make()
            ->add('animate-pulse')
            ->add('rounded-md')
            ->add('bg-gray-200')
            ->add('dark:bg-gray-700')
            ->build();
    }
}