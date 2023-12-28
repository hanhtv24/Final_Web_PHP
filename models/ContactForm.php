<?php

namespace app\models;

use app\core\Model;

class ContactForm extends Model
{

    public string $subject = '';
    public string $email = '';
    public string $addInformation = '';
    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'addInformation' => [self::RULE_REQUIRED]
        ];
    }

    public function labels() : array
    {
        return [
          'subject' => 'Enter your subject',
          'email' => 'Your email',
          'addInformation' => 'Add Information'
        ];
    }

    public function send()
    {
        return true;
    }
}