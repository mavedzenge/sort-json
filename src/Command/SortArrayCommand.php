<?php

namespace App\Command;

use App\Service\LoftDigitalManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SortArrayCommand extends Command
{
    private $loftDigitalManager;

    public function __construct(LoftDigitalManager $loftDigitalManager)
    {
        $this->loftDigitalManager = $loftDigitalManager;

        parent::__construct();
    }

    protected static $defaultName = 'app:array-sort';

    protected function configure()
    {
        $this->setDescription('Sort Delivery Root for Loft Digital Monkeys')
            ->setHelp('This command will sort the route the bananas take to get to Loft Digital');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $json = '[
    {
		"from": "Adolfo Suárez Madrid–Barajas Airport, Spain",
		"to": "London Heathrow, UK"
	},
	{
		"from": "Fazenda São Francisco Citros, Brazil",
		"to": "São Paulo–Guarulhos International Airport, Brazil"
	},
	{
		"from": "London Heathrow, UK",
		"to": "Loft Digital, Loft, UK"
	},
	{
		"from": "Porto International Airport, Portugal",
		"to": "Adolfo Suárez Madrid–Barajas Airport, Spain"
	},
	{
		"from": "São Paulo–Guarulhos International Airport, Brazil",
		"to": "Porto International Airport, Portugal"
	}
    ]';

        $io = new SymfonyStyle($input, $output);

        $io->title('Loft Digital Banana Delivery');

        $io->section('Sorting Delivery Route');

        $io->progressStart(100);

        if ($sortedArray = $this->loftDigitalManager->sortRouteArray($json))
        {

            $io->progressFinish();

            $io->section('Printing out Sorted Route');

            $io->text([
                print_r($sortedArray)
            ]);

            $io->success('Route sorting was successful');
        } else {
            $io->error('Failed to successfully sort delivery route');
        }


        return 0;
    }
}
