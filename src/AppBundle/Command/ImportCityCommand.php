<?php

namespace AppBundle\Command;

use AppBundle\Entity\Region;
use AppBundle\Entity\Department;
use AppBundle\Entity\City;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCityCommand extends ContainerAwareCommand
{
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('app:import:city')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $em EntityManager */
        $em = $this->getContainer()->get('doctrine')->getManager();

        // yolo
        ini_set("memory_limit", "-1");

        // On vide les 3 tables
        $connection = $em->getConnection();
//        $platform = $connection->getDatabasePlatform();
//        $connection->executeUpdate($platform->getTruncateTableSQL('city', true /* whether to cascade */));
//        $connection->executeUpdate($platform->getTruncateTableSQL('region', true /* whether to cascade */));
//        $connection->executeUpdate($platform->getTruncateTableSQL('department', true /* whether to cascade */));

        $csv = dirname($this->getContainer()->get('kernel')->getRootDir()) . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'cities.csv';
        $lines = explode("\n", file_get_contents($csv));
        $regions = [];
        $departements = [];
        $villes = [];

        foreach ($lines as $k => $line) {

            $line = explode(';', $line);
            if (count($line) > 10 && $k > 0) {
                // On sauvegarde la region
                if (!key_exists($line[1], $regions)) {
                    $region = new Region();
                    $region->setCode($line[1]);
                    $region->setName($line[2]);
                    $output->writeln('Region : ' . $region->getName());

                    $regions[$line[1]] = $region;
                    $em->persist($region);
                } else {
                    $region = $regions[$line[1]];
                }

                // On sauvegarde le departement
                if (!key_exists($line[4], $departements)) {
                    $departement = new Department();
                    $departement->setName($line[5]);
                    $departement->setCode($line[4]);
                    $departement->setRegion($region);
                    $departements[$line[4]] = $departement;
                    $em->persist($departement);
                    $output->writeln('Dept : ' . $departement->getName());

                } else {
                    $departement = $departements[$line[4]];
                }

                // On sauvegarde la ville
                $ville = new City();
                $ville->setName($line[8]);
                $ville->setCode($line[9]);
                $ville->setDepartment($departement);
                $villes[] = $line[8];
                $em->persist($ville);
                $output->writeln('N°: '.$k.' ==> ' . $ville->getName());

            }

            if ($k % 20 == 0)
                $em->flush();
        }
        $em->flush();
        $output->writeln(count($villes) . ' villes importées');

    }
}
