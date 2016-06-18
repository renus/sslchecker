<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SSLCheckCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ssl:check')
            ->setDescription('Check the state of all doomain added')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em    = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $model = $this->getContainer()->get('model.domain');

        $domains = $em->getRepository('AppBundle:Domain')->findAll();

        foreach ($domains as $domain) {

            $model->check($domain);
            $output->writeln(sprintf("Domain %s verified", $domain->getUrl()));
        }
    }
}