<?php

namespace Qbitz\FreshmailBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class QueryCommand extends ContainerAwareCommand {

  protected function configure() {
    $this
      ->setName('qbitz:freshmail:query')
      ->setDescription('Send single query to freshmail service')
      ->addArgument('url', InputArgument::REQUIRED, 'URL to execute, ie. subscriber/add')
      ->addOption('vars', null, InputOption::VALUE_REQUIRED, 'Sets post argument in json format')
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $browser = $this->getContainer()->get('qbitz.freshmail');

    $url = $input->getArgument('url');

    $data = array();
    if ($vars = $input->getOption('vars')) {
      $data = json_decode($vars, true);
    }

    $response = $browser->doRequest($url, $data);

    $output->writeln( print_r($response, true) );
  }
}
