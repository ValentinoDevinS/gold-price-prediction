<?php

namespace App\Enums;

enum ModelType: string
{
    case LSTM = 'LSTM';
    case CNN = 'CNN';
    case ANN = 'ANN';
}