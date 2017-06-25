<?php
namespace Admin\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use RuntimeException;


class MailFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        
        $transport = new Smtp();
        
        if (isset($config['mail']['transport']['options']))
        {
            $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));

        }else{
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d', $codEmpleo
            ));
        }
        
        return $transport;
    }
}