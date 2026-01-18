<?php

namespace App\Traits;

trait HasHoneypot
{
    public $honeypot = '';

    protected function validateHoneypot()
    {
        if (!empty($this->honeypot)) {
            abort(403, 'Bot detected.');
        }
    }
}
