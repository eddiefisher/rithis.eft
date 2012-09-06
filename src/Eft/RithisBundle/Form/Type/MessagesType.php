<?php
namespace Eft\RithisBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MessagesType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('mail_to', 'email');
    $builder->add('mail_subject', 'text');
    $builder->add('mail_content', 'textarea');
  }

  public function getName()
  {
    return 'messages';
  }
}
