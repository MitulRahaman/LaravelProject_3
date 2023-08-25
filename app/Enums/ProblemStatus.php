<?php

namespace App\Enums;

enum ProblemStatus: string
{
    case OPEN = 'open';
    case RESOLVED = 'resolved';
    case REJECTED = 'rejected';
}